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

//If didn't get element from the GET method it will crash. 
if (isset($_GET['QuestionPid']))
{
    $QuestionOrderNum = $_GET['QuestionPid'];
} 
else 
{
    die('Error: Element not found in the GET Method');
}
//If didn't get element from the GET method it will crash. 
if (isset($_GET['UpOrDown']))
{
    $MovingUpOrDown = $_GET['UpOrDown'];
} 
else 
{
    die('Error: Element not found in the GET Method');
}

//Now if the MovingUpOrDown variable is one then it will move the order down one.
//If the MovingUpOrDown variable is zero it will move it down one. Of course if it is possible.
if($MovingUpOrDown == "1")
{ //This will move the order of the element up. Unless its the highest element
    $query = "SELECT `ordering` FROM `problem` WHERE `ordering`='$QuestionOrderNum';";
    $result = mysql_query($query);
    while ($row = mysql_fetch_assoc($result)) 
    {
       $order=$row['ordering'];
    }
    
    $QuestionOrderNum+=1;
    
    $sql = "UPDATE `problem` SET `ordering`='-1' WHERE `ordering`='$QuestionOrderNum';";
    $result= mysql_query($sql);
   
    $order+=1;
    $QuestionOrderNum-=1;
    $sql = "UPDATE `problem` SET `ordering`='$order' WHERE `ordering`='$QuestionOrderNum';";
    $result= mysql_query($sql);
    
   $sql = "UPDATE `problem` SET `ordering`='$QuestionOrderNum' WHERE `ordering`='-1';";
    $result= mysql_query($sql);
      


}
else
{ //This will move the order of the element down. Unless its the lowest element. 
    $query = "SELECT `ordering` FROM `problem` WHERE `ordering`='$QuestionOrderNum';";
    $result = mysql_query($query);
    while ($row = mysql_fetch_assoc($result)) 
    {
       $order=$row['ordering'];
    }
    
    $QuestionOrderNum-=1;
    
    $sql = "UPDATE `problem` SET `ordering`='-1' WHERE `ordering`='$QuestionOrderNum';";
    $result= mysql_query($sql);
   
    $order-=1;
    $QuestionOrderNum+=1;
    $sql = "UPDATE `problem` SET `ordering`='$order' WHERE `ordering`='$QuestionOrderNum';";
    $result= mysql_query($sql);
    
   $sql = "UPDATE `problem` SET `ordering`='$QuestionOrderNum' WHERE `ordering`='-1';";
    $result= mysql_query($sql);
    
    
}
mysql_close($connection);
header('Location: index.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Math Question Bank</title>
        
    <script type="text/javascript">
            //window.location.href = "http://localhost/Project1/index.php"
    </script>
    </head>
    <body>

                
        <a href='http://localhost/Project1/index.php'>link to example</a>
    </body>
</html>