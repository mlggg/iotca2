import boto3
import botocore
from picamera import PiCamera
from time import sleep,time
import time
from gpiozero import MotionSensor
from datetime import datetime, date
from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTClient

def customCallback(client, userdata, message):
  print("Received a new message: ")
  print(message.payload)
  print("from topic: ")
  print(message.topic)
  print("--------------\n\n")

host = "#"
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
my_rpi.subscribe("baby/alert", 1, customCallback)

bucket_name = 'babyroom' # replace  with your own unique bucket name
location={'LocationConstraint':'us-east-2'}
pir = MotionSensor(26, sample_rate=5,queue_len=1)

def takePhoto(file_path,file_name):

  with PiCamera() as camera:
   full_path = file_path+'/'+file_name
   camera.capture(full_path)

def uploadToS3(file_path,file_name,bucket_name,location):
  # Create an S3 resource manually
  s3 = boto3.resource('s3',
     aws_access_key_id='#',
     aws_secret_access_key='#')
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
  object_acl = s3.ObjectAcl('babyroom',file_name)
  response=object_acl.put(ACL='public-read')
  print("File uploaded")
  #s3.upload_file(full_path,  bucket_name, file_name)

while True:
   timestring = time.strftime("%Y-%m-%dT%H:%M:%S",time.gmtime())
   file_path = '/home/pi/labs/babyroom/images'
   file_name = 'photo_'+timestring+'.jpg'
   if pir.wait_for_motion():
    print("Motion detected... take photo")
    takePhoto(file_path,file_name)
    uploadToS3(file_path,file_name,bucket_name,location)
    send_msg =  'A heavy motion detected in baby room'
    my_rpi.publish("baby/alert",send_msg,1)
    sleep(3)

   else:
    print("Room is quiet now...Baby sleeping")
    sleep(5)
