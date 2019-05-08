<title>update</title>
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
// get value of id that sent from address bar
$id=$_GET['id'];



// Retrieve data from database 
$stmt="SELECT * FROM questions WHERE question_id = '$id'";
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
<td colspan="6"><strong>Update Questions</strong> </td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center"><strong>Question Id</strong></td>
<td align="center"><strong>Text</strong></td>
<td align="center"><strong>Expected Result</strong></td>
<td align="center"><strong>Enabled</strong></td>
<td align="center"><strong>Max Attempts</strong></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="center">
<input name="question_id" type="text" id="question_id" value="<?php echo $rows['question_id']; ?>"size= "15"/>
</td>
<td align="center">
<input name="question_text" type="text" id="question_text" value="<?php echo $rows['question_text']; ?>" size="15"/>
</td>
<td align="center">
<input name="question_sql_result" type="text" id="question_sql_result" value="<?php echo $rows['question_sql_result']; ?>" size="15"/>
</td>
<td align="center">
<input name="status" type="text" id="status" value="<?php echo $rows['status']; ?>" size="15"/>
</td>
<td align="center">
<input name="max_attempts" type="text" id="max_attempts" value="<?php echo $rows['max_attempts']; ?>" size="15"/>
</td>
<tr>
</table>
<input name="id" type="hidden" id="id" value="<?php echo $rows['question_id']; ?>"/>
<button type="submit" name="Submit" value="Submit">Submit</button></td>
<td align="center">&nbsp;</td>
</td>
</form>
</tr>
</table>
</body>
</html>