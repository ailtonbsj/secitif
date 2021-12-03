<?php require_once('Connections/link1.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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
?>
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

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
$query_Recordset1 = sprintf("SELECT * FROM usuarios WHERE email = %s", GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $link1) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilo.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" />
<script type="text/javascript" src="rand_banner.js"></script>
<!-- InstanceBeginEditable name="doctitle" -->
<title>I SECITIF</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<a id="link_pop" style="position: absolute; left:505px;top: 0px; z-index: 99; cursor: pointer; display:none;" onClick="document.getElementById('box_pop').style.display='none';document.getElementById('link_pop').style.display='none';"><img src="images/bt_close.png" width="25" height="25" border="0" /></a>
<div id="box_pop" style="position: absolute; left: 5px; top: 25px; background-color: #FFAE5E; border-style: solid; border-width: 3px; border-radius: 10px; width: 500px; height: 380px; padding: 10px; z-index: 99; display: none;">
Caros professores, alunos e visitantes !<br />
O Campus fornecerá espaço para alojamento. Quem deseja ficar hospedado no campus durante o evento deverá enviar os seguintes dados aos emails saulo@ifce.edu.br ou damiaostark@live.com:<br />
<br />
a) Número de pessoas que ficarão hospedadas;<br />
b) Número de Homens;<br />
c) Número de mulheres;<br />
d) Quais dias ficarão hospedados (contar somente os dias que irão dormir, pois o alojamento será somente para as pessoas que necessitem deste tipo de guarida);<br />
<br />
Todos que vierem alojar-se no campus deverão trazer colchonete e roupa de cama.
O campus não se responsabilizará por nenhum item deixado nos alojamentos.<br />
Enviem logo seus dados, pois temos vagas limitadas.<br />
<br />
Maiores informações pelos números:
(88)3564-1430 ou
(88)9965-0480
<br />
Montem suas caravanas e venham nos visitar!!!<br />
</div>
<div id="wrap">
	<div id="top">
    	<div id="logo"></div>
        <div id="topo"></div>
    </div>
    <div id="menu">
   	  <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="evento.php">O Evento</a></li>
          <li><a href="inscricao.php">Inscrição</a></li>
          <li><a href="patrocinio.php">Patrocinio</a></li>
          <li><a href="downloads.php">Downloads</a></li>
          <li><a href="competicoes.php">Competições</a></li>
          <li><a href="contatos.php">Contatos</a></li>
          <li><a href="anais.php">Anais</a></li>
      </ul>
    </div>
    <div id="conteudo">
    <!-- InstanceBeginEditable name="Conteudo" -->
    <div style=" border: solid 1px; font-family:Verdana, Geneva, sans-serif; font-size: 16px; padding: 5px;text-align:right;">
    Seja Bem Vindo, <?php echo $row_Recordset1['nome']; ?> <?php echo $row_Recordset1['sobrenome']; ?>!!! <a href="<?php echo $logoutAction ?>">[Sair do Sistema]</a></div>
    <div class="box_alerta">
    Atenção: Quaisquer problemas com a exibição de caracteres, por favor, comunicar ao CA da Mecatrônica para alteração do seu certificado.
    </div>
    <h1>Certificados de Oficinas</h1>
    <ul>
    	<?php
		$sql10 = "SELECT * FROM `usuarios_pagos` WHERE email='". $_SESSION["MM_Username"] ."'";
		$busca10 = mysql_query($sql10,$link1);
		$num_line10 = mysql_num_rows($busca10);
		if($num_line10!=0)
		{
		$sql1 = "SELECT minicursos_usuarios.*,minicursos.titulo FROM minicursos_usuarios,minicursos WHERE minicursos_usuarios.cod_curso=minicursos.cod_curso AND email='". $_SESSION["MM_Username"] ."'";
		$busca1 = mysql_query($sql1,$link1);
		while($linha1 = mysql_fetch_assoc($busca1))
		{
		?>
    	<a href="certificado/certificado.php?cod=<?= $linha1["cod_curso"] ?>" target="_blank"><li><?= $linha1["titulo"] ?> (Clique para gerar o PDF)</li></a>
      <?php
		}
		if(mysql_num_rows($busca1)==0) echo "Sem participação.";
		}
		else echo "Sem participação.";
        ?>
    </ul>
    <h1>Certificados de Artigos Publicados</h1>
    <ul>
    	<?php
		$sql1 = "SELECT * FROM artigos WHERE email='". $_SESSION["MM_Username"] ."'";
		$busca1 = mysql_query($sql1,$link1);
		$cont = 0;
		while($linha1 = mysql_fetch_assoc($busca1))
		{
			if($linha1["nota2"]!=NULL)
			{
				$cont++;
		?>
    	<a href="certificado/certificado_simp.php?cod=<?= $linha1["nomeurl"] ?>" target="_blank"><li><?= $linha1["titulo"] ?> (Clique para gerar o PDF)</li></a>
      <?php
			}
		}
		if($cont==0) echo "Nenhum artigo publicado.";
        ?>
    </ul>
  <!-- InstanceEndEditable --></div>
    <div id="rodape">
    	<div id="rodape-inner">
        	<div class="reservado" id="reserv1"></div>
            <div class="reservado" id="reserv2"></div>
            <script type="text/javascript">
			rand_banner("reserv1",10,326,140,5);
			rand_banner("reserv2",10,326,140,4);
			</script>
        </div>
        <div id="if-logo"></div>
    </div>
    <div id="bottom">
    	<div id="bot-text">Copyright &copy; 2012 - I Semana de Ciências e Tecnologia do IFCE Campus Cedro.</div>
        <div id="bot-master">WebMaster: José Ailton B. S.</div>
    </div>
</div>
</body><!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
