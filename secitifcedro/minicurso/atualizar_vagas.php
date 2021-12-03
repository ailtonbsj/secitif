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
$sql1 = "SELECT * FROM minicursos WHERE evento='F' OR evento='M'";
$busca1 = mysql_query($sql1,$link1);
while($linha1=mysql_fetch_assoc($busca1))
{
	$sql2 = "SELECT * FROM `minicursos_usuarios` WHERE cod_curso='". $linha1["cod_curso"] ."'";
	$busca2 = mysql_query($sql2,$link1);
	echo "<br>Curso: " . $linha1["titulo"];
	echo "<br>Total preenchida: ". mysql_num_rows($busca2);
	echo "<br>Total vagas: " . $linha1["total_vagas"];
	echo "<br>disponiveis: " . ($linha1["total_vagas"] - mysql_num_rows($busca2));
	echo "<hr>";
	$sql3 = "UPDATE minicursos SET vagas_disponiveis = '". ($linha1["total_vagas"] - mysql_num_rows($busca2)) . "' WHERE cod_curso = '". $linha1["cod_curso"] ."'";
	$busca3 = mysql_query($sql3);
	if($busca3) echo "<font color=red>OK</font><br>";
	else echo "FALHA!";
	
}
?>
</body>
</html>