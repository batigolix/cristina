#!/bin/bash

HOST_PATH="/home/boris"
PROJECT_DIR="$HOST_PATH/Sites/cristina"
BUILD_DIR="$HOST_PATH/Sites/cristina-build"
GUEST_BUILD_DIR="$GUEST_PATH/cristina-build"
DRUSH="docker-compose exec --user 1000 php drush --root=/var/www/html"

function show_help {
  echo "$0 -s <site> [-fd]"
  echo " options:"
  echo " -t provide a tag e.g. ./deploy.sh -t v1.2"
}

while getopts "h?t:" opt; do
  case "$opt" in
  h|\?)
    show_help
    exit 1
    ;;
  t)  TAG=$OPTARG
    ;;
  esac
done

if [ "$TAG" = '' ] ; then
	show_help
	exit 1
fi

echo $TAG

echo "Building ..."

if [ ! -d "$PROJECT_DIR" ]; then
  echo "Fail. Project folder $PROJECT_DIR doesnt exist"
  exit 1 # terminate and indicate error
fi

if [ ! -d "$BUILD_DIR" ]; then
  echo "Fail. Project folder $BUILD_DIR doesnt exist"
  exit 1 # terminate and indicate error
fi

if [ -d "$BUILD_DIR" ]; then
 cd $BUILD_DIR
  docker-compose down
  echo "cd into $BUILD_DIR"
  echo "Checkout and pull master branch"
  git fetch --tags
  git checkout -f $TAG
  echo "Composer install"
  docker-compose exec --user 1000 php composer install --no-dev --ignore-platform-reqs
  echo "Update database and clear cache"
  $DRUSH updb --y
  $DRUSH cim --y
  $DRUSH cr
#  docker-compose exec --user 1000 php chmod -R 777 web/sites/default/files
  docker-compose up -d

fi
