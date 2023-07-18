#!/usr/bin/env sh
set -eu

# Defaults to 'fpm' for use in Docker-Compose networks. In other settings, this may be a private IP address or a full domain name
export API_HOST=${API_HOST:-'fpm'}

envsubst '${API_HOST}' < /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf

exec "$@"
