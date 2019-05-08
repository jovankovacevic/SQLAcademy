<title>Insert</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../css/main.css?version=<?php echo date('YmdHis');?>">
</head>
<body>


<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<form name="form1" method="post" action="insert_ac.php">
<td>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<td>&nbsp;</td>
<td colspan="6"><strong>Add New Question</strong> </td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center"><strong>Text</strong></td>
<td align="center"><strong>Expected Result</strong></td>
<td align="center"><strong>Enabled</strong></td>
<td align="center"><strong>Max Attempts</strong></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="center">
<input name="question_text" type="text" id="question_text" value="" size="15"/>
</td>
<td align="center">
<input name="question_sql_result" type="text" id="question_sql_result" value="" size="15" rows="3"/>
</td>
<td align="center">
<select name="status" id="status">
  <option value="1">Enabled</option>
  <option value="0">Disabled</option>
</select></td>
<td align="center">
<input name="max_attempts" type="text" id="max_attempts" value="3" size="1"/>
</td>
<tr>
</table>
<button type="submit" name="Submit" value="Submit">Submit</button> </td>
<td align="center">&nbsp;</td>
</td>
</form>
</tr>
</table>
</body>
</html>