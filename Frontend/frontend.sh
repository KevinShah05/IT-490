#!/bin/bash

sudo systemctl start apache2.service
echo "Apache Started"
sudo systemctl status apache2.service
