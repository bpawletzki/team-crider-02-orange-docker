#!/usr/bin/bash

### cd to the correct dir
cd /home/ec2-user/code/team-crider-02-orange-docker/

### Pull latest GIT
(date;git checkout main;git pull origin) 2>&1 >> /tmp/git_updates.log

### Is there a new SQL update?
## We'll assume that each update file will have a unique md5sum
sqlUpdateMD5=$(md5sum ./docker/mariadb/update/databaseUpdate.sql | cut -d " " -f 1)

## If there is no /tmp file with the current md5sum update file, run the sql script.
if [[ ! -f /tmp/${sqlUpdateMD5}_databaseUpdate.log ]] 
then
  docker-compose exec  mariadb mysql --force -pwelcome1 love_you_a_latte < ./docker/mariadb/update/databaseUpdate.sql 2>&1 >> /tmp/${sqlUpdateMD5}_databaseUpdate.log
fi
