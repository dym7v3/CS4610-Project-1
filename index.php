<?php

$mn = intval(filter_input(INPUT_GET, "mn"));

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "universitydb";

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (!$conn) {
  die('Could not connect: ' . mysqli_connect_error());
}

$tblArr = array();
$tblArr[] = "student";
$tblArr[] = "course";
$tblArr[] = "section";
$tblArr[] = "grade_report";
$tblArr[] = "prerequisite";

$table_name = $tblArr[$mn];

$sql = "SHOW COLUMNS FROM $table_name";
$result1 = mysqli_query($conn, $sql);

while ($record = mysqli_fetch_array($result1)) {
    $fields[] = $record['0'];
}

$optArr = array();
$optArr[] = "Student";
$optArr[] = "Course";
$optArr[] = "Section";
$optArr[] = "Grade Report";
$optArr[] = "Prerequisite";

$data2dArr = array();

$query = "SELECT * FROM  $table_name";
$result2 = mysqli_query($conn, $query);

while ($line = mysqli_fetch_array($result2, MYSQL_ASSOC)) {
    $i = 0;
    foreach ($line as $col_value) {
        $data2dArr[$i][] = $col_value;
        $i++;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Math Question Bank</title>
    </head>
    <body>
        <p>Hello this works</p>'
        <p>Just checking again</p>
    </body>
</html>
<?php
mysqli_close($conn);
?>