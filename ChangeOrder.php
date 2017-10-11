<?php
$databaseHost = "localhost";
$databaseUsername = "root";
$databasePassword = "";
$databaseName = "mathprobdb";

$connection = mysql_connect($databaseHost, $databaseUsername, $databasePassword);

if (!$connection) {
    die('Error: Could not connect for reason "' . mysql_error() . '"!');
}

mysql_select_db($databaseName, $connection);


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
        <?php print $_GET['QuestionPid'] ?>
        <?php print $_GET['UpOrDown'] ?>
        <a href='http://localhost/Project1/index.php'>link to example</a>
    </body>
</html>