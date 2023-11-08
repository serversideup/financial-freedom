FROM serversideup/php:beta-8.2.12-unit-bookworm as base
LABEL maintainer="Server Side Up <@serversideup>"

# Copy the application with the correct permissions
FROM base as deploy
COPY --chown=9999:9999 . /var/www/html