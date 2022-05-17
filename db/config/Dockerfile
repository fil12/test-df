FROM mariadb:10.1

RUN apt-get -y update && apt-get -y install vim


# RUN apt-get -y install mariadb-tokudb-engine-10.0

#COPY transparent_hugepage /sys/kernel/mm/transparent_hugepage/enabled
#COPY transparent_hugepage /sys/kernel/mm/transparent_hugepage/defrag
#RUN echo never >  /sys/kernel/mm/transparent_hugepage/enabled

#RUN echo "plugin-load-add=ha_tokudb.so" >> /etc/mysql/conf.d/tokudb.cnf

ENV TERM xterm-256color

COPY ./docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]

EXPOSE 3306
CMD ["mysqld"]