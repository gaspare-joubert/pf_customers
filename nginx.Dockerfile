FROM nginx:1.25-bullseye

COPY docker/nginx/default.conf.template /etc/nginx/conf.d/default.conf.template
COPY docker/nginx/docker-entrypoint.sh /usr/local/bin

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["nginx", "-g", "daemon off;"]
