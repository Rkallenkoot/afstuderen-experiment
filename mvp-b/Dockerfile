FROM gcr.io/google-appengine/php72

# Allow customizing some composer flags
ARG COMPOSER_FLAGS='--no-scripts --no-dev --prefer-dist'
ENV COMPOSER_FLAGS=${COMPOSER_FLAGS}

# Copy the app and change the owner
COPY . $APP_DIR
RUN chown -R www-data.www-data $APP_DIR

RUN /build-scripts/composer.sh

ENV DOCUMENT_ROOT=${APP_DIR}/public

# Make the app readable by www-data
# RUN chown -R www-data.www-data $APP_DIR
RUN chmod -R 550 $APP_DIR
