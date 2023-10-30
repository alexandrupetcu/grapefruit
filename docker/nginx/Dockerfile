FROM nginx:latest

RUN apt-get update && apt-get install -y \
        git \
        vim \
        wget \
        curl \
        openssh-server

COPY sites-available/api.grapefruit.local.conf /etc/nginx/conf.d/api.grapefruit.local.conf

