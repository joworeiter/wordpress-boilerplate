# wp-boilerplate
WordPress Boilerplate 2024

## setup new project:

1. set the project name in `.ddev/config.yaml`
   1. the project name should be the customers live url, without umlauts and no tld e.g. "bestattung-hüttner.at" -> "bestattung-huettner"
   2. do not use underscores in the project name!
2. update the `.env` file with the production credentials
3. (update .hosts.yaml file) not implemented yet
4. update wp-cli.yaml @staging and @production
5. run the following commands (for ddev):
   ```
   ddev start
   ddev get ddev/ddev-phpmyadmin 
   ddev composer install
   ddev auth ssh 
   ddev ssh 
   ddev wp @boilerplate db-export - | wp db-import -
   ddev wp search-replace "" "{DDEV_URL}"
   ```
   
Happy coding! 

## setup the production server for deployment

1. Log into https://konsoleh.hetzner.com/
   2. create Account for Customer
   3. activate and add ssh-key(s) as needed (in the future it should be the jumpserver ssh key)
   4. ssh into the production server and run the following command inside `public_html`
      ```shell
      mkdir staging production
      software install wp-cli
      software install composer
      software install node
      wp user create wpcli void@e-p.at --role=administrator
      wp user create elektronikprinting webdesign@e-p.at --role=administrator
      # create an new entry in onePassword for the production site with the password 
      
      # if deployer is setup
      mkdir shared
      # copy/create the dirs like stated in the deploy.php section "shared files"
      
      # if no deployer is setup
      # clone the repo from git
      composer install
      
      #change to your local dev env and run the following
      ddev exec wp db-export - | wp @production db-import - && wp search-replace "{DDEV_URL}" "{PRODUCTION_URL}"
      
      Thats it: you should be good to go!
      
      ```


## ToDos/Improvements

- setup deployer for new projects
- update EP Plugins and make them available via git for installing via composer
- move plugin installs form GUI to composer
- ...