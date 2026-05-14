#!/bin/sh

if [ "$HTTPS_ENABLED" = "true" ]; then
echo "HTTPS is enabled. Using laravels.conf template.------"
    cp /etc/nginx/templates/laravels.conf.template /etc/nginx/conf.d/default.conf
else
echo "HTTPS is not enabled. Using laravel.conf template.------"
    cp /etc/nginx/templates/laravel.conf.template /etc/nginx/conf.d/default.conf
fi

nginx -g "daemon off;"