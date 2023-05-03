FROM nginx:alpine
ADD nginx/default.conf /etc/nginx/conf.d

WORKDIR /var/www/html

RUN apk update
RUN apk add npm
RUN npm install jquery
