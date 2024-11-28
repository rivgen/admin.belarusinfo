FROM nginx:stable-alpine

#ADD ./ssl/portal.dev.crt /etc/nginx/ssl/portal.dev.crt
#ADD ./ssl/portal.dev.key /etc/nginx/ssl/portal.dev.key

ADD ./config/conf.d/* /etc/nginx/conf.d/
ADD ./config/nginx.conf /etc/nginx

RUN rm /etc/nginx/conf.d/default.conf