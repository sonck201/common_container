FROM mysql:8

MAINTAINER Iamck

RUN apt-get update && apt-get install -y

RUN mysql -uroot -p${MYSQL_ROOT_PASSWORD} -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;"
RUN mysql -uroot -p${MYSQL_ROOT_PASSWORD} -e "ALTER USER 'root'@'%' identified with mysql_native_password by '${MYSQL_ROOT_PASSWORD}';"
RUN mysql -uroot -p${MYSQL_ROOT_PASSWORD} -e "CREATE USER '${MYSQL_USER}'@'%' IDENTIFIED BY '${MYSQL_PASSWORD}';"
RUN mysql -uroot -p${MYSQL_ROOT_PASSWORD} -e "GRANT ALL PRIVILEGES ON *.* TO '${MYSQL_USER}'@'%' WITH GRANT OPTION;"

CMD mysqld --default-authentication-plugin=mysql_native_password