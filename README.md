
# Technical Challenge for SEAT:CODE Backend Developer

SEAT:CODE has been asked for a really important project. We need to develop an
application that helps in controlling brand new mowers from the SEAT Martorell Factory.
SEAT has rolled out brand new robotic mowers that are able to cut the grass and to inspect
the terrain with their cameras to identify problems in the green areas.




## Technical Requirements

To install this project you will need a enviroment with:
- PHP => 8.1
- Symfony installed (https://symfony.com/download)
- Composer to install the package (https://getcomposer.org/)
- PHPUnit https://phpunit.de/


## Installation


Download the repository from github using
```bash
  git clone https://github.com/alberto-lobo/seat_mobility_test.git
```
once the repository is downloaded you have to execute the command
```bash
  composer install
```
To run the command to move the mowers execute, the file orders.txt has the movements for the mowers
```bash
  bin/console mower:send-movement orders.txt
```
    
## Running Tests

To run tests, run the following command

```bash
  bin/phpunit 
```

## Some assumtions

- I Assumed the bottom-left coordinates for grid are 0,0, then coordinates cannot be a negative value.
- Only valid values for movements will be: L,R,M. An exception will be thrown
- Only valid values for orientation will be: N,S,E,W. An exception will be thrown
- Exception will be thrown if a mower tries to move out of the plateau size

## Explications:
- I decided to test from outside to inside because like that I dont have to test every single class that i already tests in the acceptance test
- I decide to use the hexagonal architecture to separate every component 

## next steps
- WIP: add docker to execute application without install everythin on your systems. I had some problems with docker in my computer so I couldn't test if containers are up correctly.
- Make file to simplify installation with just some commands
