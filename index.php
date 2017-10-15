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

$query = "SELECT `pid`, `content`, ordering FROM problem WHERE `del`='0' ORDER BY ordering DESC";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
    $problemId[] = $row['pid'];
    $problemContent[] = $row['content'];
    $problemOrder[]=$row['ordering'];
}
if (!empty($problemOrder))
{
    $max=max($problemOrder);
}


//This gets the amount of rows in the page. 
$numberOfRows= mysql_num_rows($result);
print $numberOfRows;
print"<br>";

//Then we want to get the correct amount of pages.
//So we want 20 questions per page some we divide by 20 and take the ceiling.
$amountOfpages=$numberOfRows/20;
$amountOfpages=ceil($amountOfpages);
print $amountOfpages;



$query = "SELECT `pid` FROM problem WHERE `del`='1'";
$result = mysql_query($query);

$deleted=null;
while ($row = mysql_fetch_assoc($result))
{
    $deleted = $row['pid'];
   }

if($deleted==null)
{
    $showUndoButton=false;
}
else
    $showUndoButton=true;

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Math Question Bank</title>
        <script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
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
    <div class="container">    
    <form id="addNewQuestion" action="./AddOrEdittingAQuestion.php" method="get">
        <div class="form-group">
            <h2 id="heading">Insert A Question</h2>
                <input id="EditOrAddQuestion" name="EditOrAddQuestion" type="hidden" value="0" /> 
                <textarea id="QuestionContent" class="form-control" name="QuestionContent" placeholder="Type Question Content" cols="50" rows="3" name="comment"></textarea>
            <br> 
        <div class="row">
            <div class="col-xs-12">
                <div class="text-right">
                    <input id="QuestionSubmitButton" class="btn btn-primary" type="submit"  value="Submit" onClick="return empty()" />
                    <div class="btn-group">
                        <input id="QuestionUpdate"  class="btn btn btn-info" type="submit" style="display: none" value="UPDATE" onClick="return empty()" />
                        <input id="QuestionUpdateCancel"  class="btn btn btn-info" type="reset" onclick='window.location.reload();' style="display: none" value="Cancel" />
                        <input id="QuestionOrderNum" name="QuestionOrderNum" type="hidden" value="-1"/>
                    </div>
                </div>
            </div>
        </div>    
    </form>
        <h2>Math Problem Bank</h2>      
    <table class="table table-striped">
        <thead>
            <tr>
                <div class="text-right">
                <ul class="pagination pagination-lg">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                </ul>
                 </div>
            </tr>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th></th>
                <th></th>
                <th>
                </th>
                <th></th>
                <th>   
                    <form class="UndoDelete" action='./UndoDelete.php' method="get">
                    <?php if($showUndoButton)
                           {
                            print "<input id='QuestionSubmitButton' "
                             . "class='btn btn-warning ' type='submit' "
                                    . "value='Undo' "
                                    . "onClick='' />";
                            }?>
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                 for ($i = 0; $i < count($problemOrder); $i++) { ?>
                <tr>                        
                        
                        <td><?php print "<strong>$problemOrder[$i]</strong>";?></td>
                        <td><?php print $problemContent[$i]; ?></td>
                        <td></td>
                        <td>
                            <form class='ChangeOrderForm' action="./ChangeOrder.php" method="get">  
                            <input name="QuestionPid" type="hidden" value="<?php print $problemOrder[$i]; ?>"/>  
                            <input name="UpOrDown" type="hidden" value="1" />    
                            <?php 
                                //Checks Removes the move up arrow.
                                if ( 0 != $i)
                                {
                                  print "<button type='submit' class='btn btn-info '>
                                    <span class='glyphicon glyphicon-arrow-up'>
                                    </span>
                                    </button>";
                                } 
                            ?>            
                            </form>

                        </td>
                        <td> 
                            <form class='ChangeOrderForm' action="./ChangeOrder.php" method="get">  
                            <input name="QuestionPid" type="hidden" value="<?php print $problemOrder[$i] ?>"/>    
                            <input name="UpOrDown" type="hidden" value="0" />
                             <?php 
                                //removes the bottom down arrow so then you can move the problem down. 
                                if ($max != $i+1)
                                {
                                  print "<button type='submit' class='btn btn-info'>
                                    <span class='glyphicon glyphicon-arrow-down'>
                                    </span>
                                    </button>";
                                } 
                            ?>           
                            </form>
                        </td>
                                    
                       
                        <td>
                            <form class='EditForm' action="./AddOrEdittingAQuestion.php" method="get">    
                                <input id="problemContent" name="problemContent" type="hidden" value='<?php print $problemContent[$i]?>'/>
                                <input name="QuestionOrderNum" type="hidden" value="<?php print $problemOrder[$i] ?>"/> 
                                <input id="EditOrAddQuestion" name="EditOrAddQuestion" type="hidden" value="1" />
                                <button type="button" class="btn btn-success " onclick="editting(problemContent.value, QuestionOrderNum.value)">Edit</button>
                             </form>
                        </td>
                        <td>
                            <form class='DeleteForm' action="./Delete.php" method="get">
                                <input name="QuestionOrderNum" type="hidden" value="<?php print $problemOrder[$i] ?>"/> 
                                <button type="submit" class="btn btn-danger">Delete</button>
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