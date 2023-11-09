FROM serversideup/php:beta-8.2.12-unit-bookworm as base

### Development
FROM base as development
ARG USER_ID

RUN usermod -u $USER_ID www-data

### Deploy
FROM base as deploy
LABEL maintainer="Server Side Up <@serversideup>"
COPY --chown=9999:9999 . /var/www/html