FROM 659106128818.dkr.ecr.us-east-1.amazonaws.com/emp-core-container-registry:php-8-2-latest
ARG token

ENV COMPOSER_AUTH='{"github-oauth": {"github.com": "'${token}'"}}'

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip

COPY . /www

RUN mkdir -p /www/var/log

# RUN ln -sf /dev/stdout /www/var/log/prod.log
# RUN ln -sf /dev/stdout /www/var/log/prod_database.log

# # install dependencies
RUN cd /www && composer install

# # file permissions
RUN chown -R www-data:www-data /www
