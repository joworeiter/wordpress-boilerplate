# WordPress Boilerplate Project

- Author: Johannes Reiter 
- Contact: [send me a message](johannes@reiter.work)

## Basic Usage


### setup.sh
`bin/setup.sh` creates staging and production wordpress instances based on the credentials given in the .env file.
- create a .env-File with the needed credentials
`cp .env-example .env`
  
- upload the `.env` and the `bin`-Directory to your webspace.

- optional make the `setup.sh` executable with `chmod +x bin/setup.sh`

- run `bin/setup.sh` and see the magic happen

