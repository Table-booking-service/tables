#!/bin/bash

# Define environment variables
export APP_PORT=80
export FORWARD_DB_PORT=5433
export DB_DATABASE=tables
export DB_USERNAME=miet
export DB_PASSWORD=password

# Create a network for the containers
docker network create tables-network

# Run the PostgresSQL container
docker run -d \
  --name postgres \
  --network tables-network \
  -p ${FORWARD_DB_PORT}:5432 \
  -e POSTGRES_DB=${DB_DATABASE} \
  -e POSTGRES_USER=${DB_USERNAME} \
  -e POSTGRES_PASSWORD=${DB_PASSWORD} \
  postgres:15

# Run the application container
docker run -d \
  --pull missing \
  --name app \
  --network tables-network \
  -p ${APP_PORT}:80 \
  zzvampirzz/tables:latest
