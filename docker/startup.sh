#!/bin/bash

composer install -d /app
npm install
symfony server:start --listen-ip=0.0.0.0 --no-tls & npm run dev-server
