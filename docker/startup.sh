#!/bin/bash

composer install -d /app
symfony server:start --listen-ip=0.0.0.0 --no-tls
