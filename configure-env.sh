#!/bin/bash

echo "Configuring local development environment for local.site..."

# Change directory to the webroot.
cd /var/www/cristina/web

# Sanitize the database.
drush sql-sanitize -y

# Disable modules.
#drush dis -y ldap_authentication

# Enable modules.
drush en devel -y
drush en devel_generate -y
#drush en reroute_email -y
drush en stage_file_proxy -y
drush en environment_indicator -y

# Clear Drupal caches.
drush cc all

echo "Environment configuration complete."