#!/usr/bin/env bash
echo ">>>>  Setting the Laravel project environment <<<<"
cd /var/www/Astrocaster
if [ -d "./vendor" ]
then
    echo ">>>> Already initialized <<<<"
else
    echo ">>>>  Updating\installing composer dependencies <<<<"
    composer update
    echo ">>>>  Done <<<<"
    echo ">>>>  Linking storage folders <<<<"
    php artisan storage:link
    echo ">>>>  Done <<<<"
    echo ">>>>  Running migrations <<<<"
    php artisan migrate
    echo ">>>>  Done <<<<"
    echo ">>>>  Seeding database with faker values <<<<"
    php artisan db:seed
    echo ">>>>  Done <<<<"
    echo ">>>>  Publishing config for the  PulkitJalan\Google\GoogleServiceProvider <<<<"
    php artisan vendor:publish --provider="PulkitJalan\Google\GoogleServiceProvider" --tag="config"
    echo ">>>>  Done <<<<"
fi

supervisord

