FROM gcr.io/google-appengine/php:2018-04-16-14-10

# Add our NGINX and php.ini config
ENV DOCUMENT_ROOT=${APP_DIR}/web

# Workaround for AUFS-related permission issue:
# See https://github.com/docker/docker/issues/783#issuecomment-56013588
RUN cp -R ${APP_DIR} ${APP_DIR}-copy; rm -r ${APP_DIR}; mv ${APP_DIR}-copy ${APP_DIR}; chmod -R 550 ${APP_DIR}; chown -R root.www-data ${APP_DIR}
