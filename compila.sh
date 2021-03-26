#!/bin/sh
echo "Welcome do DC-UFSCar compilation service. Trying..."
date

echo "Stopping WebREPL Serial Server..."
P=`ps ax | grep serverSeri | grep -v colo | awk '{ print $1 }'`

echo "PID = $P"

kill $P
kill $P
sleep 1
kill -9 $P
kill -9 $P

echo "TARGET = $1"

D=`date +%d-%m-%Y-%H-%M-%S`

cp /var/www/html/code.ino /home/rafael/DataComRemoteLab/Arduino-Makefile/examples/Blink/
cp /var/www/html/code.ino /home/rafael/DataComRemoteLab/build_history/$D
cd /home/rafael/DataComRemoteLab/Arduino-Makefile/examples/Blink

source env.sh

make $1

echo
date


echo "Restaring WebREPL Serial Server..."
cd /home/rafael/DataComRemoteLab/SerialWebSocketServer
python serverSerial.py &

sleep 10

exit
