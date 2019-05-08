<title>update</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/main.css?version=<?php echo date('YmdHis');?>">
</head>
<?php
require_once('../configuration.php');
$question_id=$_POST['question_id'];
$question_text=$_POST['question_text'];
$question_sql_result=$_POST['question_sql_result'];
$status=$_POST['status'];
$max_attempts=$_POST['max_attempts'];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}   
$stmt="UPDATE questions SET question_text='$question_text', question_sql_result='$question_sql_result', status='$status', max_attempts = '$max_attempts' WHERE question_id='$question_id'" ;
$result=sqlsrv_query( $conn, $stmt);
sqlsrv_close( $conn);

// if successfully updated. 
if($result){
echo "Successful";
echo "<BR>";
echo "<a href='list_questions.php'><button type=\"submit\" name=\"Submit\" value=\"Submit\">View result</button></a>";
}

else {
echo "ERROR";
}

?>
</body>
</html>