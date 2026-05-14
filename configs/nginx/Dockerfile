# Use an official PHP image as the base image
FROM nginx:latest
COPY ./configs/nginx/laravel.conf /etc/nginx/templates/laravel.conf.template    
COPY ./configs/nginx/laravels.conf /etc/nginx/templates/laravels.conf.template
COPY ./configs/nginx/start.sh /start.sh

RUN chmod +x /start.sh

WORKDIR /var/www/html

CMD ["/start.sh"]