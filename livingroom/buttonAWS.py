import sys
import MySQLdb
from gpiozero import LED, Button, MotionSensor, MCP3008
from signal import pause
from threading import Thread
import Adafruit_DHT
from time import sleep, time, gmtime, strftime
from rpi_lcd import LCD
import RPi.GPIO as GPIO
import MFRC522
import signal
from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTClient
import json
import uuid
import boto3
from boto3.dynamodb.conditions import Key, Attr
from botocore.exceptions import ClientError
# Custom MQTT message callback
def customCallback(client, userdata, message):
  print("Received a new message: ")
  print(message.payload)
  print("from topic: ")
  print(message.topic)
  print("--------------\n\n")


host = "a229305f378i8s.iot.us-east-2.amazonaws.com"
rootCAPath = "rootca.pem"
certificatePath = "certificate.pem.crt"
privateKeyPath = "private.pem.key"


my_rpi = AWSIoTMQTTClient("basicPubSub")
my_rpi.configureEndpoint(host, 8883)
my_rpi.configureCredentials(rootCAPath, privateKeyPath, certificatePath)


my_rpi.configureOfflinePublishQueueing(-1) # Infinite offline Publish queueing
my_rpi.configureDrainingFrequency(2)  # Draining: 2 Hz
my_rpi.configureConnectDisconnectTimeout(10)  # 10 sec
my_rpi.configureMQTTOperationTimeout(5)  # 5 sec


# Connect and subscribe to AWS IoT
my_rpi.connect()
my_rpi.subscribe("sensors/led", 1, customCallback)
sleep(2)

button = Button(27, pull_up=False)
led = LED(18)
led2 = LED(21)
led3 = LED(20)
def ledON():
 led.on()
 led2.on()
 led3.on()
 send_msg = '{"LEDID": "living","currstat":"ON"}'
 send_msg1 = '{"LEDID": "living1","currstat":"ON"}'
 send_msg2 = '{"LEDID": "living2","currstat":"ON"}'
 send_msg3 = '{"LEDID": "living3","currstat":"ON"}'
 my_rpi.publish("sensors/led",send_msg,1)
 my_rpi.publish("sensors/led",send_msg1,1)
 my_rpi.publish("sensors/led",send_msg2,1)
 my_rpi.publish("sensors/led",send_msg3,1)


 
def ledOFF():
 led.off()
 led2.off()
 led3.off()
 send_msg = '{"LEDID": "living","currstat":"OFF"}'
 send_msg1 = '{"LEDID": "living1","currstat":"OFF"}'
 send_msg2 = '{"LEDID": "living2","currstat":"OFF"}'
 send_msg3 = '{"LEDID": "living3","currstat":"OFF"}'
 my_rpi.publish("sensors/led",send_msg,1)
 my_rpi.publish("sensors/led",send_msg1,1)
 my_rpi.publish("sensors/led",send_msg2,1)
 my_rpi.publish("sensors/led",send_msg3,1)
 
def detectOFF():
 led.off()
 led2.off()
 led3.off()

def detectON():
 led.on()
 led2.on()
 led3.on()

dynamodb = boto3.resource("dynamodb",aws_access_key_id='AKIAJ54LBWTUCE5PH4HQ',
         aws_secret_access_key='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', region_name='us-east-2')

table = dynamodb.Table('LED')

LEDID = "living"
LEDID1 = "living1"
LEDID2 = "living2"
LEDID3 = "living3"


# Publish to the same topic in a loop forever
loopCount = 0
while True:
	dbuuid = str(uuid.uuid1())
	DATE = strftime("%Y-%m-%d",gmtime())
	TIME = strftime("%H:%M:%S",gmtime())
	status= led.is_lit
    	if status == True:
  	   button.when_pressed = ledOFF
	
	if status == False:
  	   button.when_pressed = ledON
        
#	try:
#	    response = table.get_item(
#	        Key={
#	            'LEDID': LEDID
#	            
#	        }
#	    )
#	except ClientError as e:
#	    print(e.response['Error']['Message'])
#	else:
#	    living = str(response['Item']['currstat'])
#	    print("GetItem succeeded:")
	    

#	if living == "OFF":
 #    		detectOFF()
 # 	else: 
  #  	 	detectON()

 # ----------------------------------------------------- #
    	try:
	    response1 = table.get_item(
	        Key={
	            'LEDID': LEDID1
	            
	        }
	    )
	except ClientError as e:
	    print(e.response1['Error']['Message'])
	else:
	    living1 = str(response1['Item']['currstat'])
	    print("GetItem succeeded:")
	    
	
	if living1 == "OFF":
     		led.off()
  	else: 
    	 	led.on()

# ----------------------------------------------------- #
    	try:
	    response2 = table.get_item(
	        Key={
	            'LEDID': LEDID2
	            
	        }
	    )
	except ClientError as e:
	    print(e.response2['Error']['Message'])
	else:
	    living2 = str(response2['Item']['currstat'])
	    print("GetItem succeeded:")

	if living2 == "OFF":
     		led2.off()
  	else: 
    	 	led2.on()
    
# ----------------------------------------------------- #
    	try:
	    response3 = table.get_item(
	        Key={
	            'LEDID': LEDID3
	            
	        }
	    )
	except ClientError as e:
	    print(e.response3['Error']['Message'])
	else:
	    living3 = str(response3['Item']['currstat'])
	    print("GetItem succeeded:")

	if living3 == "OFF":
     		led3.off()
  	else: 
    	 	led3.on()

