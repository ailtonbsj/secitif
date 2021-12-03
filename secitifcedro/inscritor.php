<?php require_once('Connections/link1.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

if(isset($_GET["action"]))
{
	$sql2 = "SELECT * FROM minicursos WHERE cod_curso='". $_GET["codigo"] ."'";
	$busca2 = mysql_query($sql2,$link1);
	$linha2 = mysql_fetch_assoc($busca2);
	$sql3 = "SELECT * FROM minicursos_usuarios WHERE cod_curso='". $_GET["codigo"] ."'";
	$busca3 = mysql_query($sql3,$link1);
	$disponivel = $linha2["total_vagas"] - mysql_num_rows($busca3);
	if($disponivel>0) $liberador = "ok";
	else $liberador = "no";
	
	if($_GET["action"] == "inscricao" && $liberador=="ok")
	{
		$sql1 = "INSERT INTO minicursos_usuarios VALUES('". $_GET["codigo"] ."','". $_SESSION['MM_Username'] ."')";
		$busca1 = mysql_query($sql1,$link1);
		$sql4 = "UPDATE minicursos SET vagas_disponiveis = '". ($disponivel-1) ."' WHERE cod_curso = '". $_GET["codigo"] ."';";
		$busca4 = mysql_query($sql4,$link1);
		header("Location: sys_minicurso.php?alert=on&evt=" . $_SESSION["evt"]);
	}
	if($_GET["action"] == "cancel_inscricao")
	{
		$sql1 = "DELETE FROM minicursos_usuarios WHERE cod_curso = '". $_GET["codigo"] ."' AND email = '". $_SESSION["MM_Username"] ."'";
		$busca1 = mysql_query($sql1,$link1);
		$sql5 = "SELECT * FROM minicursos_usuarios WHERE cod_curso = '". $_GET["codigo"] ."'";
		$busca5 = mysql_query($sql5,$link1);
		$insc = mysql_num_rows($busca5);
		$dispon = $linha2["total_vagas"] - $insc;
		$sql6 = "UPDATE minicursos SET vagas_disponiveis = '". ($dispon) ."' WHERE cod_curso = '". $_GET["codigo"] ."';";
		$busca6 = mysql_query($sql6,$link1);
		header("Location: sys_minicurso.php?alert=off&evt=" . $_SESSION["evt"]);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<center>
<h2>AGUARDE...</h2>
<img src="images/load.gif" width="100" height="100" /></center>
</body>
</html>