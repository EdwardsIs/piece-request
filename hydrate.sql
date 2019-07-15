CREATE USER 'basicUser'@'localhost' IDENTIFIED WITH mysql_native_password BY '&G3ner@l1';
GRANT ALL PRIVILEGES ON * . * TO 'basicUser'@'localhost';
CREATE DATABASE technical_assessment;
CREATE TABLE technical_assessment.request_header(header_id int primary key auto_increment, 
customer_number VARCHAR(45), customer_name VARCHAR(100), customer_email VARCHAR(100), customer_phone VARCHAR(100));
CREATE TABLE technical_assessment.request_detail(detail_id int primary key auto_increment, header_id int, 
piece_type VARCHAR(100), patter_name VARCHAR(100), quantity int, foreign key (header_id) references request_header(header_id));