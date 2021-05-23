FROM serversideup/php:8.0-fpm-nginx
LABEL maintainer="Server Side Up <hello@serversideup.net>"

RUN apt-get -y update \
    && apt-get install -y php8.0-redis \
    && apt-get -y autoremove \
    && apt-get autoclean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*