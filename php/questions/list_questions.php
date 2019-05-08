<title>SQL Academy Questions</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/main.css?version=<?php echo date('YmdHis');?>">
</head>
<?php
require_once('../configuration.php');
$conn = sqlsrv_connect($serverName, $connectionOptions);
if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}    
$stmt = "SELECT * FROM questions";
$result = sqlsrv_query( $conn, $stmt);
//sqlsrv_close( $conn);
?>
<body>
<h2>SQL Academy Questions</h2>

<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<td>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
</tr>

<tr>
<td align="center"><strong>Question Id</strong></td>
<td align="center"><strong>Text</strong></td>
<td align="center"><strong>Expected Result</strong></td>
<td align="center"><strong>Enabled</strong></td>
<td align="center"><strong>Max Attempts</strong></td>
</tr>

<?php
while($rows=sqlsrv_fetch_array($result)){
?>
<tr>
<td align="center"><?php echo $rows['question_id']; ?></td>
<td align="center"><?php echo $rows['question_text']; ?></td>
<td align="center"><?php echo $rows['question_sql_result']; ?></td>
<td align="center"><?php echo $rows['status']; ?></td> 
<td align="center"><?php echo $rows['max_attempts']; ?></td>
<td align="center"><a href="update.php?id=<?php echo $rows['question_id']; ?>">
    <button type="submit" name="Submit" value="Submit">Update</button></a></td>
</tr>
<?php
}
?>

</table>
<a href="insert.php"><button type="submit" name="Submit" value="Submit">Add New Question</button></a></td>
<td align="center">&nbsp;</td>
</tr>
</table>

</body>
</html>