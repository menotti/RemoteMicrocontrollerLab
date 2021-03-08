# RemoteMicrocontrollerLab
A set of PHP files, scripts and database to allow remote users to edit programs, upload code and access the serial port of real microcontrollers.

Features
- Fully web based solution
- Online web editor
- Examples
- Real time access to the device LEDs, surrounds using a webcam available with motion
- Usage control with scheduling / with / without authorization
- Real time access (full duplex) to the device's serial port using a web-base remote terminal (connected to the device's serial port)
- Transparent remote code upload using avrdude or esptool from the web-browser

Tested with Arduino and ESP8266 boards (Rafael Aroca)


Prof. Ricardo Menotti adapted it to work with FPGA devices, allowing synthesis, upload and test of FPGA devices remotely
