<?php
// Here is an example configuration for Skyfallen Development Container
define("dbHost","tes_dbserver");
define("dbName","database");
define("dbUser","root");
define("dbPassword","password");

//stop editing
//Only MySQL is supported
/* Attempt to connect to MySQL database */
$link = mysqli_connect(dbHost, dbUser, dbPassword, dbName);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}