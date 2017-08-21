# Import SDK packages
import sys
import Adafruit_DHT
from time import sleep, time, gmtime, strftime
from rpi_lcd import LCD
import RPi.GPIO as GPIO
import MFRC522
import signal
from signal import pause
import picamera
from gpiozero import LED, Button, MotionSensor, MCP3008
from threading import Thread
from AWSIoTPythonSDK.MQTTLib import AWSIoTMQTTClient
import json
import uuid

loopCount = 0
pin = 4


lcd = LCD()

prev_uid = None
continue_reading = True

def end_read(signal,frame):
 	global continue_reading
 	print ("Ctrl+C captured, ending read.")
 	continue_reading = False
 	GPIO.cleanup()


signal.signal(signal.SIGINT, end_read)

mfrc522 = MFRC522.MFRC522()

print "Welcome to the MFRC522 data read example"
print "Press Ctrl-C to stop."

lcd.text('Welcome to ', 1)
lcd.text('Smart Home', 2)

OwnerOne = [136, 4, 100, 38, 206]
OwnerTwo = [136, 4, 133, 233, 224]

Roomstatus = 0
entry = []

def checkAuth(uid):
    global Roomstatus
    if uid == OwnerOne:
        owner = "xuchao"
        if "xuchao" in entry:
            entry.remove(owner)
            Roomstatus -= 1
            lcd.text('Good bye', 1)
            lcd.text('Take care!', 2)
        else:

            entry.append(owner)
            Roomstatus += 1
            lcd.text('Welcome home', 1)
            lcd.text('Xu Chao', 2)
    elif uid == OwnerTwo:
        owner2 = "kaiyuan"
        if "kaiyuan" in entry:
            entry.remove(owner2)
            Roomstatus -= 1
            lcd.text('Good bye', 1)
            lcd.text('Take care!', 2)
        else:

            entry.append(owner2)
            Roomstatus += 1
            lcd.text('Welcome home', 1)
            lcd.text('Kai Yuan', 2)
    print(Roomstatus)
    print("owner inside smart home")
    print(entry)



        

while continue_reading:
  (status, TagType) = mfrc522.MFRC522_Request(mfrc522.PICC_REQIDL)

  if status == mfrc522.MI_OK:
    (status, uid) = mfrc522.MFRC522_Anticoll()
    if uid != prev_uid:
        
        if uid == OwnerOne or uid ==OwnerTwo:
            
            checkAuth(uid)
        sleep(2)
        lcd.text('Welcome to ', 1)
        lcd.text('Smart Home', 2)
	








