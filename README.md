File Overview
-------------------
The html directory of this repo contains a copy of the html directory running on my apache server, which contains the entire source.  Also, the program imports the neccesary code for bootstrap from some CDNs, so an internet connection will be neccesary while running the application.  The hydrate.sql file contains all the SQL statements neccesary to prepare a MySQL database to
run the application locally.

Input Assumptions
-------------------
When developing the interface for this application, I assumed that the user would be entering their information for the first time,
and having it saved, or possibly checked against previously entered information in another database.  Also, it is assumed that 
customer number would be completely numeric, (no dashes, dots, or letters), and that email would have to contain both an @ 
symbol, and a period, (to signify the address included a domain.)  Lastly, the phone input expects a purely numerical entry as 
well, and doesn't accept any characters aside from 0-9.  For the piece requests, the application simply accepts strings for 
the pattern name and piece type, but takes only a non-negative integer for the quantity.

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
