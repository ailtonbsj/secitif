<?php require_once('../Connections/link1.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_link1, $link1);
$query_Recordset1 = "SELECT * FROM minicursos WHERE evento = 'F' OR evento ='M' ORDER BY titulo ASC";
$Recordset1 = mysql_query($query_Recordset1, $link1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_POST['list_minicurso'])) {
  $colname_Recordset2 = $_POST['list_minicurso'];
}
mysql_select_db($database_link1, $link1);
$query_Recordset2 = sprintf("SELECT * FROM minicursos_usuarios,usuarios WHERE minicursos_usuarios.email=usuarios.email AND cod_curso=%s ORDER BY nome", GetSQLValueString($colname_Recordset2, "text"));
$Recordset2 = mysql_query($query_Recordset2, $link1) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>minicursos</title>
</head>

<body>
<form id="slt_mini" name="slt_mini" method="post" action="">
  <select name="list_minicurso" id="list_minicurso">
    <option value="Escolha o minicurso">0</option>
    <?php
do {  
?>
    <option value="<?php echo $row_Recordset1['cod_curso']?>"><?php echo $row_Recordset1['titulo']?></option>
    <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  $rows = mysql_num_rows($Recordset1);
  if($rows > 0) {
      mysql_data_seek($Recordset1, 0);
	  $row_Recordset1 = mysql_fetch_assoc($Recordset1);
  }
?>
  </select>
  <input type="submit" name="button" id="button" value="Mostrar Alunos" />
</form>
<h1>Alunos do Minicurso</h1>
<table width="700" border="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#999999">
    <td>NOME COMPLETO</td>
    <td>CIDADE</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset2['nome']; ?> <?php echo $row_Recordset2['sobrenome']; ?></td>
      <td><?php echo $row_Recordset2['cidade']; ?></td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
