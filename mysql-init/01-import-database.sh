#!/bin/bash
set -e

echo "Waiting for MySQL to be ready..."
until mysql -u root -proot -e "SELECT 1" &> /dev/null; do
  sleep 1
done

echo "Importing WordPress database..."

# The database 'wordpress' is already created by MySQL container
# Import the SQL file into the wordpress database
# Both script and SQL file are in /docker-entrypoint-initdb.d
mysql -u root -proot wordpress < /docker-entrypoint-initdb.d/kqhfawgrhosting_wp572.sql

echo "Database import completed successfully!"
