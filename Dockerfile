FROM serversideup/php:8.0-fpm-nginx
LABEL maintainer="Server Side Up <@serversideup>"

# Copy the application
COPY --chown=9999:9999 . /var/www/html