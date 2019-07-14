Database Assumptions
--------------------
The application assumes a MySQL database named technical_assessment, with two tables named request_header, and request_detail, 
with a one-to-many relationship between the two tables.  (Each request detail record has a foreign key referencing the relevant
request header.)

Database User:

This application expects a MySQL user with the name 'basicUser' at localhost.  This user must also be identified with
'mysql_native_password', due to a compatibility problem between MySQL's new version of authentication, and the way the
mysqli connector handles passwords.

Database Structure:

request_header: 
header_id (int primary key)
customer_number (varchar(45))
customer_name (varchar(100))
customer_email (varchar(100))
customer_phone (varchar(100))

request_detail:
detail_id (int primary key)
header_id (int foreign key references request_header(header_id))
piece_type (varchar(100))
patter_name (varchar(100))
quantity (int)
