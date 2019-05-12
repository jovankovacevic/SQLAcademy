<title>SQL Academy Users</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/main.css?version=<?php echo date('YmdHis');?>">
</head>
<?php
require_once('configuration.php');
$conn = sqlsrv_connect($serverName, $connectionOptions);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}    
$stmt = "SELECT * FROM SQLAcademy.users";
$result = sqlsrv_query( $conn, $stmt);
//sqlsrv_close( $conn);
?>
<body>
<h2>SQL Academy Users</h2>

<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
</tr>

<tr>
<td align="center"><strong>User Id</strong></td>
<td align="center"><strong>User Name</strong></td>
<td align="center"><strong>Password</strong></td>
<td align="center"><strong>First Name</strong></td>
<td align="center"><strong>Last Name</strong></td>
<td align="center"><strong>Account Type</strong></td>
</tr>

<?php
while($rows=sqlsrv_fetch_array($result)){
?>
<tr>
<td align="center"><?php echo $rows['user_id']; ?></td>
<td align="center"><?php echo $rows['uname']; ?></td>
<td align="center"><?php echo $rows['pw']; ?></td>
<td align="center"><?php echo $rows['first_name']; ?></td> 
<td align="center"><?php echo $rows['last_name']; ?></td>
<td align="center"><?php echo $rows['type']; ?></td>  
<td align="center"><a href="update.php?id=<?php echo $rows['user_id']; ?>">
    <button type="submit" name="Submit" value="Submit">Update</button></a></td>
</tr>
<?php
}
?>

</table>
<a href="insert.php"><button type="submit" name="Submit" value="Submit">Add New User</button></a></td>
<td align="center">&nbsp;</td>
</tr>
</table>

</body>
</html>