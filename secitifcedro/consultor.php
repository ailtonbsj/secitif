<?php require_once('Connections/link1.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$sql1 = "SELECT * FROM minicursos_usuarios ORDER BY email";
$busca1 = mysql_query($sql1,$link1);
echo "<table border=\"1\">";
$cont=0;
$ncont = 0;
while($linha1 = mysql_fetch_assoc($busca1))
{
	echo "<tr><td>";
	echo $linha1["email"] . "<br>";
	$sql2 = "SELECT * FROM usuarios_pagos WHERE email='".
	$linha1["email"] ."'";
	$busca2 = mysql_query($sql2,$link1);
	if(mysql_num_rows($busca2)==1)
	{
		$cont++;
	echo "<td><font color='red'> Confirmado</font> </td>";
	}
	else
	{
		//$ncont++;
		//$sql3 = "DELETE FROM minicursos_usuarios WHERE cod_curso='".$linha1["cod_curso"] . "' AND email='". $linha1["email"] ."'";
		//$busca3 = mysql_query($sql3,$link1);
		//if($busca3) echo "<font color='green'><b>DELETOU!</b></font>";
	}
	echo "</td></tr>";
}
echo "</table>";
echo mysql_num_rows($busca1);
echo "<br>Confirmados: " . $cont;
echo "<br>Nao confirmados: " . $ncont;
?>
</body>
</html>