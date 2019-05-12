<title>Insert</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/main.css?version=<?php echo date('YmdHis');?>">
</head>
<body>
<?php
require_once('configuration.php');
$uname=$_POST['uname'];
$pw=$_POST['pw'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$type=$_POST['type'];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}   
$stmt="INSERT INTO SQLAcademy.users(uname, pw, first_name, last_name, type) VALUES('$uname', '$pw', '$first_name', '$last_name', '$type')" ;
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