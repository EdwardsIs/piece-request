<?php
    // This file contains the code neccesary to
    // establish a connection to the MySQL database at localhost

    // Setting the access info as constants
    define('DB_USER', 'basicUser');
    define('DB_PASSWORD', '&G3ner@l1');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'technical_assessment');

    // Making connection
    $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());

    // Setting encoding
    mysqli_set_charset($dbc, 'utf8');
?>