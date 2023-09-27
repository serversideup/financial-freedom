FROM php:8.2-apache as base
LABEL maintainer="Server Side Up <@serversideup>"

# Copy the application with the correct permissions
FROM base as deploy
COPY --chown=9999:9999 . /var/www/html