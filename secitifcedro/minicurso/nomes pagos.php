<?php require_once('../Connections/link1.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
mysql_select_db('secitif',$link1);
$sql1 = "SELECT * FROM usuarios_pagos,usuarios WHERE usuarios_pagos.email=usuarios.email ORDER BY nome";
$busca1 = mysql_query($sql1,$link1);
echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">";
while($linha1 = mysql_fetch_assoc($busca1))
{
	echo "<tr>";
	echo "<td>" . $linha1["email"] . "</td><td>". $linha1["nome"] ." ". $linha1["sobrenome"] ."</td><td>&nbsp;</td>" ;
	echo "</tr>";
}
echo "</table>";
echo mysql_num_rows($busca1);
?>
</body>
</html>