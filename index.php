<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "mathprobdb";

$con = mysql_connect($dbhost, $dbuser, $dbpassword);

if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($dbname, $con);

$probIdArr = array();
$probContArr = array();

$query = "SELECT pid, content FROM problem ORDER BY pid DESC";

$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
    $probIdArr[] = $row['pid'];
    $probContArr[] = $row['content'];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Math Question Bank</title>
        <script type="text/javascript">
            window.MathJax = {
                tex2jax: {
                    inlineMath: [["\\(", "\\)"]],
                    processEscapes: true
                }
            };
        </script>
        <script type="text/javascript" src="https://cdn.mathjax.org/mathjax
                /latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
        </script>
          <link rel="stylesheet" href="index.css"/>
    </head>
    <body>
       
    <h2>Problems</h2>
        <table>
           
            <?php
            for ($i = 0; $i < count($probIdArr); $i++) {
                ?>
                <tr>
                    <td><?php print "<strong>$probIdArr[$i]</strong>";?>
                    <?php print "&nbsp"; ?>
                    <?php print $probContArr[$i]; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
<?php
mysql_close($con);
?>