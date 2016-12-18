# Silex console adventure game
Create the map for my text adventure and expose it as thrift service

## Requirements
PHP 7


## starting this using docker
### get the docker image running
```
docker build -t silex_adventure .
docker run --name silex_adventure_1  -i -t silex_adventure  
```
### find the docker image id to get in there (usually the first)
```
docker ps
```

### get in that container
```
# example <ID> djangoscenes_web_1 ususally under the NAMES column as previous output
docker exec -it <ID> bash
```

### Start the app 
```
./console adventure
```
