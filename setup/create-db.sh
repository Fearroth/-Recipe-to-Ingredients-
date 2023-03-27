#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS recipes;
    GRANT ALL PRIVILEGES ON \`recipes\`.* TO '$MYSQL_USER'@'%';
EOSQL
