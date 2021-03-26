#!/bin/sh
echo "Welcome do DC-UFSCar remote packet capture"
date

echo "Running tshark for 60 seconds:"
echo ""

echo "$ timeout 60 tshark -V -x port not 80 and port not 8266 and port not 22 and port not 8081 " 

echo ""

sudo timeout 60 tshark -V -x port not 80 and port not 8266 and port not 22 and port not 8081 &


