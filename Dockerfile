# Axternal image to use found on (originally used but had too much stuff in there)
# FROM silintl/php7:latest

# shamelessly cut paste content of image and remove what i do not need
FROM silintl/ubuntu:16.04

# install OS packages
RUN apt-get update && apt-get install -y \
    curl \
    git \
    php \
    php-cli \
    php-curl \
    php-dom \
    php-intl \
    php-json \
    php-ldap \
    php-mbstring \
    php-mcrypt \
    php-zip \
    && phpenmod mcrypt \
    && apt-get clean

# install ping
RUN apt-get install iputils-ping -y

# Install extra utils
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod a+x /usr/local/bin/composer \
    && composer global require fxp/composer-asset-plugin:^1.1.4 \
    && curl -o /usr/local/bin/whenavail https://bitbucket.org/silintl/docker-whenavail/raw/master/whenavail \
    && chmod a+x /usr/local/bin/whenavail

# create dir in container named code
RUN mkdir /code

# When connected to the container go to the /code folder
WORKDIR /code

# add the current contents to code
ADD . /code

#CMD composer install