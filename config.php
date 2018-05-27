
<?php
/* Database credentials.*/


define('DB_SERVER', 'localhost'); 			//host name(most often than not it should be localhost)
define('DB_USERNAME', 'akshit');   			//DB username(root by default)
define('DB_PASSWORD', 'akshyan1'); 			//DB password(nothing by default. '')
define('DB_NAME', 'sherlocked');					//The name of the DB you created
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>