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

//This checks if the content from the question box was recieved and if it was
//then it will set a string variable containing that content.
$insertContent=null;
if(isset($_GET['QuestionContent']))
    $insertContent=$_GET['QuestionContent'];
else
    die("Error: Did't get question content ");
   

$sql = "SELECT MAX(ordering) FROM `problem` WHERE del='0';";
$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)) 
    {
       $order=$row['MAX(ordering)'];
    }
print $order;
//Makes a new order by adding plus one.
$order+=1;


//This adds the content of the question to the question bank and makes it have the correct order number. 
$sql = "INSERT INTO `problem`(`content`, `ordering`) VALUES ('$insertContent','$order')";
$result = mysql_query($sql);

//Closes the connection and redirects the page to go back to the index page. 
mysql_close($connection);
header('Location: index.php');


