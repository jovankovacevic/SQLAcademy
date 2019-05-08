<title>update</title>
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
// get value of id that sent from address bar
$id=$_GET['id'];



// Retrieve data from database 
$stmt="SELECT * FROM users WHERE user_id = '$id'";
$result=sqlsrv_query( $conn, $stmt);
$rows=sqlsrv_fetch_array($result);
?>
<body>


<table width="1200" border="0" cellspacing="1" cellpadding="0">
<tr>
<form name="form1" method="post" action="update_ac.php">
<td>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<td>&nbsp;</td>
<td colspan="6"><strong>Update User Details</strong> </td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center"><strong>User Id</strong></td>
<td align="center"><strong>User Name</strong></td>
<td align="center"><strong>Password</strong></td>
<td align="center"><strong>First Name</strong></td>
<td align="center"><strong>Last Name</strong></td>
<td align="center"><strong>Account Type</strong></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="center">
<input name="user_id" type="text" id="user_id" value="<?php echo $rows['user_id']; ?>"size= "15"/>
</td>
<td align="center">
<input name="uname" type="text" id="uname" value="<?php echo $rows['uname']; ?>" size="15"/>
</td>
<td align="center">
<input name="pw" type="text" id="pw" value="<?php echo $rows['pw']; ?>" size="15"/>
</td>
<td align="center">
<input name="first_name" type="text" id="first_name" value="<?php echo $rows['first_name']; ?>" size="15"/>
</td>
<td align="center">
<input name="last_name" type="text" id="last_name" value="<?php echo $rows['last_name']; ?>" size="15"/>
</td>
<td align="center">
<input name="type" type="text" id="type" value="<?php echo $rows['type']; ?>" size="15"/>
</td>
<tr>
</table>
<input name="id" type="hidden" id="id" value="<?php echo $rows['user_id']; ?>"/>
<button type="submit" name="Submit" value="Submit">Submit</button></td>
<td align="center">&nbsp;</td>
</td>
</form>
</tr>
</table>
</body>
</html>