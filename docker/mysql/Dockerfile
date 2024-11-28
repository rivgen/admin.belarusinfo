FROM mysql:5.7

COPY ./conf.d/* /etc/mysql/conf.d/
RUN chmod 644 /etc/mysql/conf.d/mgd.cnf

RUN ln -sf /usr/share/zoneinfo/Europe/Moscow /etc/localtime