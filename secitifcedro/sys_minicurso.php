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
    <br />
    <center>
    <a href="seletor.php">Voltar para pagina de escolha do evento</a>
    </center>
    <div class="box_ok"><b>
    AVISO: As inscrições do Campeonato de Eletrotécnica está disponível até Quinta-feira às 2:00h da tarde.
    </b></div>
    <h1>Minicursos que voc&ecirc; est&aacute; cadastrado</h1>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%" bgcolor="#FFFFFF">Titulo</td>
        <td width="43%" bgcolor="#FFFFFF">Professores</td>
        <td width="15%" align="center" bgcolor="#FFFFFF">Evento</td>
        <td width="9%" align="center" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <?php
	  $sql3 = "SELECT minicursos.cod_curso AS curso, titulo, total_vagas,vagas_disponiveis,descricao, evento FROM minicursos_usuarios,minicursos WHERE minicursos.cod_curso=minicursos_usuarios.cod_curso AND email = '". $_SESSION['MM_Username'] ."'";
	  $busca3 = mysql_query($sql3,$link1);
	  while($linha3 = mysql_fetch_assoc($busca3)){
	  ?>
      <tr>
        <td><?= $linha3["titulo"] ?></td>
        <td>
        <?php
			$sql4 = "SELECT cod_curso,nome FROM minicursos_professores,professores";
			$sql4.= " WHERE minicursos_professores.email_professor=professores.email_professor AND cod_curso='". $linha3["curso"] ."'";
			$busca4 = mysql_query($sql4,$link1);
			$is_prim = 1;
			while($linha4 = mysql_fetch_assoc($busca4))
			{
				if($is_prim == 1)
				{
					echo $linha4["nome"];
					$is_prim = 0;
					continue;
				}
				echo "/ " . $linha4["nome"];
			}
		?>
        </td>
        <td align="center"><?php 
		switch($linha3["evento"])
		{
			case "F":
				echo "FEMECI";
			break;
			case "M":
				echo "Enc. da Matemática";
			break;
		}
		?></td>
        <td align="center">
        <a href="sys_minicurso_detalhe.php?codigo=<?= $linha3["curso"] ?>">Mais Detalhes</a>
        </td>
      </tr>
      <?php
	  }
	  ?>
    </table>
    <br />
    <h1>Seu horário</h1>
    <?php
	$sql5 = "SELECT datas.cod_curso,titulo,dia,hora_inicio,hora_fim FROM minicursos_usuarios,datas,minicursos WHERE datas.cod_curso=minicursos.cod_curso AND minicursos_usuarios.cod_curso=datas.cod_curso AND minicursos_usuarios.email='". $_SESSION['MM_Username'] ."' ORDER BY dia ASC";
	$busca5 = mysql_query($sql5,$link1);
	$horario = array(1=>array(1=>"",2=>""),2=>array(1=>"",2=>""),3=>array(1=>"",2=>""),4=>array(1=>"",2=>""),5=>array(1=>"",2=>""));
	while($linha5 = mysql_fetch_assoc($busca5))
	{
		$horario[$linha5["dia"]-1][$linha5["hora_inicio"]=="08:00:00"?"1":"2"]=
		"<a href=\"sys_minicurso_detalhe.php?codigo=". $linha5["cod_curso"] ."\">" . $linha5["titulo"] . "</a>";
	}
	?>
    <table border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="100" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="160" align="center" bgcolor="#FFFFFF">Segunda-feira</td>
        <td width="160" align="center" bgcolor="#FFFFFF">Ter&ccedil;a-feira</td>
        <td width="160" align="center" bgcolor="#FFFFFF">Quarta-feira</td>
        <td width="160" align="center" bgcolor="#FFFFFF">Quinta-feira</td>
        <td width="160" align="center" bgcolor="#FFFFFF">Sexta-feira</td>
      </tr>
      <tr>
        <td width="100" align="center" bgcolor="#FFFFFF">08:00 - 12:00</td>
        <td width="160" align="center"><?= $horario[1][1] ?></td>
        <td width="160" align="center"><?= $horario[2][1] ?></td>
        <td width="160" align="center"><?= $horario[3][1] ?></td>
        <td width="160" align="center"><?= $horario[4][1] ?></td>
        <td width="160" align="center"><?= $horario[5][1] ?></td>
      </tr>
      <tr>
        <td width="100" align="center" bgcolor="#FFFFFF">13:30 - 17:30</td>
        <td width="160" align="center"><?= $horario[1][2] ?></td>
        <td width="160" align="center"><?= $horario[2][2] ?></td>
        <td width="160" align="center"><?= $horario[3][2] ?></td>
        <td width="160" align="center"><?= $horario[4][2] ?></td>
        <td width="160" align="center"><?= $horario[5][2] ?></td>
      </tr>
    </table>
<br />
<h1>Minicursos ofertados (<?= $_GET["evt"]=="F"?"FEMECI":"Encontro da Matemática" ?>)</h1>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td bgcolor="#FFFFFF">Titulo</td>
        <td align="center" bgcolor="#FFFFFF">Total de vagas</td>
        <td align="center" bgcolor="#FFFFFF">Vagas disponiveis</td>
        <td bgcolor="#FFFFFF">Professores</td>
        <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <?php
	  if(isset($_GET["alert"]))
		{
			if($_GET["alert"]=="on")
			{
				echo "<script>alert(\"Inscrição realizada com sucesso!!!\");</script>";
			}
			if($_GET["alert"]=="off")
			{
				echo "<script>alert(\"Inscrição cancelada com sucesso!!!\");</script>";
			}
		}
	  $evento = $_GET["evt"];
	  $_SESSION["evt"] = $evento;
	  $sql1 = "SELECT * FROM minicursos WHERE evento='". $evento ."'";
	  $busca1 = mysql_query($sql1,$link1);
	  while($linha1 = mysql_fetch_assoc($busca1))
	  {
	  ?>
      <tr>
        <td><?= $linha1["titulo"] ?></td>
        <td align="center"><?= $linha1["total_vagas"] ?></td>
        <td align="center"><?= $linha1["vagas_disponiveis"] ?></td>
        <td>
          <?php
			$sql2 = "SELECT cod_curso,nome FROM minicursos_professores,professores";
			$sql2.= " WHERE minicursos_professores.email_professor=professores.email_professor AND cod_curso='". $linha1["cod_curso"] ."'";
			$busca2 = mysql_query($sql2,$link1);
			$is_prim = 1;
			while($linha2 = mysql_fetch_assoc($busca2))
			{
				if($is_prim == 1)
				{
					echo $linha2["nome"];
					$is_prim = 0;
					continue;
				}
				echo "/ " . $linha2["nome"];
			}
		?>
        </td>
        <td align="center"><a href="sys_minicurso_detalhe.php?codigo=<?= $linha1["cod_curso"] ?>">Mais Detalhes</a></td>
      </tr>

      <?php
	  }
	  ?>
    </table>
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
