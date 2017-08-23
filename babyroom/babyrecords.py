from gpiozero import MCP3008, MotionSensor, LED, Button
from time import sleep, time, gmtime, strftime
import sys
import Adafruit_DHT
import RPi.GPIO as GPIO
from signal import pause
import picamera
from threading import Thread
from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTClient
import json
import uuid

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
my_rpi.subscribe("baby/sensors", 1, customCallback)


mcp3008 = MCP3008(channel=0) # light
pir = MotionSensor(26, sample_rate=5,queue_len=1) # motion
pin = 4 #tem & humidity
humidity, temperature = Adafruit_DHT.read_retry(11,pin)

update = True
while update: 
  print("MCP3008 raw value={}".format(mcp3008.value))
  sensor_value = (1024/mcp3008.value)%1024
  sensor_value = str(round(sensor_value))
  print(sensor_value)
  dbuuid = uuid.uuid1()
  DATE = strftime("%Y-%m-%d",gmtime())
  TIME = strftime("%H:%M:%S",gmtime())
  TEMP = "{:.1f}".format(temperature)
  HUMI = "{:.1f}".format(humidity) 
  send_msg = '{"babyID": "' + str(dbuuid) + '","Date": "' + DATE + '","Time": "' + TIME + '","Temperature": "' + TEMP + '","Humidity": "' + HUMI + '","Light":"' + sensor_value + '"}'
  my_rpi.publish("baby/sensors",send_msg,1)
  sleep(5)
