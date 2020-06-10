FROM php:7.4-fpm

RUN apt-get update \
&& docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install cron
RUN apt-get -y install cron

# # Create the log file to be able to run tail
# RUN touch /var/log/cron.log

# # Setup cron job
# RUN (crontab -l ; echo "* * * * * echo "Hello world" >> /var/log/cron.log") | crontab

# ADD crontab /etc/cron.d/hello-cron
# # Give execution rights on the cron job
# RUN chmod 0644 /etc/cron.d/hello-cron
# # Apply cron job
# RUN crontab /etc/cron.d/hello-cron
# # Create the log file to be able to run tail
# RUN touch /var/log/cron.log



# RUN chown -R www-data:www-data /var/www/html
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html

# Change current user to www
USER www

# # Run the command on container startup
# CMD cron && tail -f /var/log/cron.log

# # Run the command on container startup
# CMD cron && tail -f /var/log/cron.log
