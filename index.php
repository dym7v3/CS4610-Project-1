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

$problemId = array();
$problemContent = array();
$problemOrder= array();

$query = "SELECT pid, content, ordering FROM problem ORDER BY pid DESC";

$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
    $problemId[] = $row['pid'];
    $problemContent[] = $row['content'];
    $problemOrder[]=$row['ordering'];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Math Question Bank</title>
        <script type="text/javascript"
	src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
        </script>
        <script type="text/javascript">
	window.MathJax = {
		tex2jax : {
			inlineMath : [ [ '$', '$' ], [ "\\(", "\\)" ] ],
			processEscapes : true
		}
	};
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="DynamicFunctions.js"></script>
        
        
          <link rel="stylesheet" href="index.css"/>
    </head>
<body>
    <h2>Math Problem Bank</h2>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
            </tr>
        </thead>
        <tbody>
            <?php
                 for ($i = 0; $i < count($problemId); $i++) { ?>
                <tr>                        
                        
                        <td><?php print "<strong>$problemId[$i]</strong>";?></td>
                        <td><?php print $problemContent[$i]; ?></td>
                        <td><?php print $problemOrder[$i]; ?></td>
                        <td>
                            <form class='ChangeOrderForm' action="./ChangeOrder.php" method="get">  
                            <input name="QuestionPid" type="hidden" value="<?php print $problemId[$i] ?>"/>  
                            <input id="UpDown" name="UpOrDown" type="hidden" value="1" />    
                            <button onclick="orderingUp()" class="btn btn-info btn-lg">
                                    <span class="glyphicon glyphicon-arrow-up">
                                    </span>
                                </button>
                            </form>

                        </td>
                        <td> 
                            <form class='ChangeOrderForm' action="./ChangeOrder.php" method="get">  
                            <input name="QuestionPid" type="hidden" value="<?php print $problemId[$i] ?>"/>    
                            <input id="UpDown" name="UpOrDown" type="hidden" value="0" />
                             <button type="submit"  class="btn btn-info btn-lg" >
                                
                                    <span class="glyphicon glyphicon-arrow-down">
                                    </span>
                            </form>
                        </td>
                       
                    </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

    
    
    <?php
mysql_close($con);
?>