FROM mysql/mysql-server:8.0

ENV MYSQL_DATABASE=workshop \
  MYSQL_USER=ws_user \
  MYSQL_PASSWORD=5Jn7AN<QMd \
  MYSQL_ROOT_PASSWORD=5Jn7AN<QMd \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf
