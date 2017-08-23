# Import SDK packages
import sys
import Adafruit_DHT
from time import sleep, time, gmtime, strftime
from rpi_lcd import LCD
import RPi.GPIO as GPIO
import MFRC522
import signal
from signal import pause
from picamera import PiCamera
from gpiozero import LED, Button, MotionSensor, MCP3008
from threading import Thread
from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTClient
import json
import uuid
import boto3
import botocore
from datetime import datetime,date

# Custom MQTT message callback
def customCallback(client, userdata, message):
  print("Received a new message: ")
  print(message.payload)
  print("from topic: ")
  print(message.topic)
  print("--------------\n\n")

host = ""
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

my_rpi.connect()
my_rpi.subscribe("living/sensors", 1, customCallback)
sleep(2)


pin = 4

bucket_name = '' # replace  with your own unique bucket name
location={'LocationConstraint':'us-east-2'}
pir = MotionSensor(26, sample_rate=5,queue_len=1)

def takePhoto(file_path,file_name):

  with PiCamera() as camera:
   full_path = file_path+'/'+file_name
   camera.capture(full_path)

def uploadToS3(file_path,file_name,bucket_name,location):
  # Create an S3 resource manually
  s3 = boto3.resource('s3',
     aws_access_key_id='',
     aws_secret_access_key='')
  exists=True

  try: 
    s3.meta.client.head_bucket(Bucket=bucket_name) 
  except botocore.exceptions.ClientError as e: 
    error_code = int(e.response['Error']['Code']) 
    if error_code == 404: 
       exists = False

  if exists == False:
     s3.create_bucket(Bucket=bucket_name,CreateBucketConfiguration=location)

  # Upload a new file
  full_path=file_path+"/"+file_name
  s3.Object(bucket_name, file_name).put(Body=open(full_path,'rb'))
  
  object_acl = s3.ObjectAcl('iotlivingroom',file_name)
  response=object_acl.put(ACL='public-read')
  print("File uploaded")
  #s3.upload_file(full_path,  bucket_name, file_name)

while True:
     
	timestring = strftime("%Y-%m-%dT%H:%M:%S",gmtime())
   	file_path = '/home/pi/labs/livingroom/images'
   	file_name = 'photo_'+timestring+'.jpg'
        takePhoto(file_path,file_name)
    	uploadToS3(file_path,file_name,bucket_name,location)
    	
	humidity, temperature = Adafruit_DHT.read_retry(11, pin)
      
	dbuuid = uuid.uuid1()
	DATE = strftime("%Y-%m-%d",gmtime())
	TIME = strftime("%H:%M:%S",gmtime())
	TEMP = "{:.1f}".format(temperature)
	HUMI = "{:.1f}".format(humidity)

       
	send_msg = '{"livingID": "' + str(dbuuid) + '","Date": "' + DATE + '","Time": "' + TIME + '","Temperature": "' + TEMP + '","Humidity": "' + HUMI + '"}'
	my_rpi.publish("living/sensors",send_msg,1)

	PiCamera().close()
	sleep(5)
