<title>Insert</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/main.css?version=<?php echo date('YmdHis');?>">
</head>
<body>


<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<form name="form1" method="post" action="insert_ac.php">
<td>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr>
<td>&nbsp;</td>
<td colspan="6"><strong>Add New User</strong> </td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="center"><strong>User Name</strong></td>
<td align="center"><strong>Password</strong></td>
<td align="center"><strong>First Name</strong></td>
<td align="center"><strong>Last Name</strong></td>
<td align="center"><strong>Account Type</strong></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="center">
<input name="uname" type="text" id="uname" value="" size="15"/>
</td>
<td align="center">
<input name="pw" type="text" id="pw" value="" size="15"/>
</td>
<td align="center">
<input name="first_name" type="text" id="first_name" value="" size="15"/>
</td>
<td align="center">
<input name="last_name" type="text" id="last_name" value="" size="15"/>
</td>
<td align="center">

<select name="type" id="type">
  <option value="regular">regular</option>
  <option value="admin">admin</option>
</select>
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