#!bin/bash

sudo systemctl start rabbitmq-server
echo "Started"
sudo systemctl status rabbitmq-server