import sys
from gpiozero import LED, Button, MotionSensor, MCP3008
from signal import pause
from threading import Thread
import Adafruit_DHT
from time import sleep, time, gmtime, strftime
from rpi_lcd import LCD
import RPi.GPIO as GPIO
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

def ledON():
 led.on()
 
 send_msg = '{"LEDID": "master","currstat":"ON"}'
 
 my_rpi.publish("sensors/led",send_msg,1)
 


 
def ledOFF():
 led.off()

 send_msg = '{"LEDID": "master","currstat":"OFF"}'
 
 my_rpi.publish("sensors/led",send_msg,1)
 
 
def detectOFF():
 led.off()


def detectON():
 led.on()


dynamodb = boto3.resource("dynamodb",aws_access_key_id='AKIAJ54LBWTUCE5PH4HQ',
         aws_secret_access_key='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', region_name='us-east-2')

table = dynamodb.Table('LED')

LEDID = "master"



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
        
	try:
	    response = table.get_item(
	        Key={
	            'LEDID': LEDID
	            
	        }
	    )
	except ClientError as e:
	    print(e.response['Error']['Message'])
	else:
	    living = str(response['Item']['currstat'])
	    print("GetItem succeeded:")
	    

	if living == "OFF":
     		detectOFF()
  	else: 
    	 	detectON()
