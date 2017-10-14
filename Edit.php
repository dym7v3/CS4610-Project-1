<?php

$databaseHost = "localhost";
$databaseUsername = "root";
$databasePassword = "";
$databaseName = "mathprobdb";

//Try to make the connnection with the database. 
$connection = mysql_connect($databaseHost, $databaseUsername, $databasePassword);

//If the connection is not made then it will exit with an error. 
if (!$connection) {
    die('Error: Could not connect for reason "' . mysql_error() . '"!');
}

//After the connection to the DB is made then we need to select a table. 
mysql_select_db($databaseName, $connection);

//Closes the connection and redirects the page to go back to the index page. 
//mysql_close($connection);
//header('Location: index.php');

?>