FROM tomsik68/xampp:5
WORKDIR /opt/lampp/htdocs
COPY database/mock.sql .
RUN echo 'sh /startup.sh &' > /lampp
RUN chmod +x /lampp
RUN echo 'CREATE DATABASE IF NOT EXISTS `secitif_demo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;' > db.sql
RUN echo 'USE `secitif_demo`;' >> db.sql
RUN cat db.sql mock.sql > dbfull.sql
RUN /lampp && sleep 15 && /opt/lampp/bin/mysql -h localhost -u root -P 3306 < dbfull.sql
RUN rm -rf mock.sql db.sql dbfull.sql