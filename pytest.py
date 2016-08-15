#!/usr/bin/python
 
import spidev
import time
import os
import MySQLdb

 
# Open SPI buss
spi = spidev.SpiDev()
spi.open(0,0)

# connect to the MySQL database
conn = MySQLdb.connect(host= "localhost",
                  user="root",
                  passwd="football12",
                  db="readings")
x = conn.cursor()

# Function to read SPI data from MCP3008 chip
# Channel must be an integer 0-7
def ReadChannel(channel):
  adc = spi.xfer2([1,(8+channel)<<4,0])
  data = ((adc[1]&3) << 8) + adc[2]
  return data
 
# Function to convert data to voltage level,
# rounded to specified number of decimal places.
def ConvertVolts(data,places):
  volts = (data * 3.3) / float(1023)
  volts = round(volts,places)
  return volts
 
# Function to calculate temperature from
# TMP36 data, rounded to specified
# number of decimal places.
def ConvertTemp(data,places):
 
  # ADC Value
  # (approx)    Volts
  #    0         0.00
  #   78         0.25
  #  155         0.50
  #  233         0.75
  #  310         1.00
  #  465         1.50
  #  775         2.50
  # 1023         3.30
 
  temp = ((data * 330)/float(1023))-50
  temp = round(temp,places)
  return temp
 
# Define sensor channels
light_channel = 0
temp_channel  = 0

 
# Define delay between readings
delay = 5
 
while True:
 
  # Read the light sensor data
  light_level = ReadChannel(light_channel)
  light_volts = ConvertVolts(light_level,2)
 
   
  # Print out results
  print("({}V)".format(light_volts))
  date_time = time.time()
  print("({})".format(date_time))
  x.execute (" INSERT INTO data VALUES (%s,%s)", (light_volts,date_time))
  conn.commit()
 
  # Wait before repeating loop
  time.sleep(delay)
