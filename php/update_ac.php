<title>update</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/main.css?version=<?php echo date('YmdHis');?>">
</head>
<?php
require_once('configuration.php');
$user_id=$_POST['user_id'];
$uname=$_POST['uname'];
$pw=$_POST['pw'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$type=$_POST['type'];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}   
$stmt="UPDATE users SET uname='$uname', pw='$pw', first_name='$first_name', last_name = '$last_name', type='$type' WHERE user_id='$user_id'" ;
$result=sqlsrv_query( $conn, $stmt);
sqlsrv_close( $conn);

// if successfully updated. 
if($result){
echo "Successful";
echo "<BR>";
echo "<a href='list_records.php'><button type=\"submit\" name=\"Submit\" value=\"Submit\">View result</button></a>";
}

else {
echo "ERROR";
}

?>
</body>
</html>