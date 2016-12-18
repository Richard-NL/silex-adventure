#!/bin/sh

docker build -t silex_adventure .
docker run --name silex_adventure_1  -i -t silex_adventure  
