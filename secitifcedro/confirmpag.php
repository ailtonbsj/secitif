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
O Campus fornecer?? espa??o para alojamento. Quem deseja ficar hospedado no campus durante o evento dever?? enviar os seguintes dados aos emails saulo@ifce.edu.br ou damiaostark@live.com:<br />
<br />
a) N??mero de pessoas que ficar??o hospedadas;<br />
b) N??mero de Homens;<br />
c) N??mero de mulheres;<br />
d) Quais dias ficar??o hospedados (contar somente os dias que ir??o dormir, pois o alojamento ser?? somente para as pessoas que necessitem deste tipo de guarida);<br />
<br />
Todos que vierem alojar-se no campus dever??o trazer colchonete e roupa de cama.
O campus n??o se responsabilizar?? por nenhum item deixado nos alojamentos.<br />
Enviem logo seus dados, pois temos vagas limitadas.<br />
<br />
Maiores informa????es pelos n??meros:
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
          <li><a href="inscricao.php">Inscri????o</a></li>
          <li><a href="patrocinio.php">Patrocinio</a></li>
          <li><a href="downloads.php">Downloads</a></li>
          <li><a href="competicoes.php">Competi????es</a></li>
          <li><a href="contatos.php">Contatos</a></li>
          <li><a href="anais.php">Anais</a></li>
      </ul>
    </div>
    <div id="conteudo">
    <!-- InstanceBeginEditable name="Conteudo" -->
    <?php
		require_once('Connections/link1.php');
		$sql1 = "SELECT * FROM usuarios_pagos WHERE email = '". $_SESSION['MM_Username'] ."'";
		$busca1 = mysql_query($sql1,$link1);
		if(mysql_num_rows($busca1)==0)
		{
	?>
    <div style="text-align: center; font-family: Verdana, Geneva, sans-serif; margin: 20px;">
    <h1>ATEN????O</h1>
    <p>Voc?? ainda n??o pagou a inscri????o no valor de <strong><big>R$5,00</big></strong> para participar da I Semana de Ci??ncia e Tecnologia do IFCE Campus Cedro.<br />
    Voc?? tem acesso liberado para escolher os minicursos clicando no link abaixo.<br />
    <p>
    <input type="button" name="button" id="button" value="Clique para acessar o Sistema!" style="background-color: #333;color: #FFF;font-size:18px;font-weight:bold;padding: 20px; cursor: pointer;" onclick="location.href='sys_minicurso.php?evt=<?= $_GET["evt"] ?>';" />
    
    </p>
    <p>
    Caso voc?? n??o pague o valor de inscri????o de R$ 5,00. Sua inscri????o n??o ser?? aceita.<br />
    Voc?? tem at?? o dia <strong><big>18 de Novembro</big></strong> para efetuar o pagamento e confirm??-lo! </p>
    <h1>Para efetuar o pagamento, existem duas formas:</h1>
    <p>
    1) Ir a qualquer ag??ncia do <big><b>Banco do Brasil</b></big> e efetuar um Dep??sito na seguinte conta:
    <div class="box_ok">
    Banco: Banco do Brasil<br />
    Agencia: 1293-9<br />
    Conta: 13688-3<br />
    Cliente da conta: Dami??o da Silva Oliveira<br />
    </div>
    <p>
    Depois digitalizar (scannear) o comprovante de dep??sito enviar para o seguinte e-mail:
    </p>
    <div class="box_ok">cami-ifce@live.com</div>
    <p>
    ?? importante que al??m do <u>comprovante de dep??sito</u>, seja enviado tamb??m o seu <u>e-mail de inscri????o no sistema</u> (para fazer a libera????o) e o seu <u>nome completo</u>.
    </p>
    <p>
    2) Efetuar o pagamento indo diretamente ao Centro Acad??mico (CA) da Mecatr??nica, no IFCE Campus Cedro.<br /><br />
    Depois de confirmada o pagamento essa mensagem n??o ir?? mais aparecer!<br />
    D??vidas, questionamentos ou sugest??es, entrar em contato com CA da Mecatr??nica IFCE Campus Cedro ou organizadores do evento.<br />
	</p>
    </div>
    <?php
		}
		else
		{
			$sql2 = "SELECT * FROM usuarios_pagos WHERE email='". $_SESSION['MM_Username'] ."'";
			$busca2 = mysql_query($sql2,$link1);
			$linha2 = mysql_fetch_assoc($busca2);
			if($linha2["p_acesso"]=='T')
			{
				$sql3 = "UPDATE usuarios_pagos SET p_acesso='F' WHERE email='". $_SESSION['MM_Username'] ."'";
				mysql_query($sql3,$link1);
	?>
    <div style="text-align: center; font-family: Verdana, Geneva, sans-serif; margin: 20px;">
    <h1>PARAB??NS!!!</h1>
    <p>Seu pagamento foi confirmado! De agora em diante n??o ser?? mais mostrado mensagens de alerta de pagamento!<br />
    <p>
    <input type="button" name="button" id="button" value="Clique para acessar o Sistema!" style="background-color: #333;color: #FFF;font-size:18px;font-weight:bold;padding: 20px; cursor: pointer;" onclick="location.href='sys_minicurso.php?evt=<?= $_GET["evt"] ?>';" />
    </p>
    </div>
    <?php
			}
			else
			{
				header("Location: sys_minicurso.php?evt=" . $_GET["evt"]);
			}
		}
	?>
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
    	<div id="bot-text">Copyright &copy; 2012 - I Semana de Ci??ncias e Tecnologia do IFCE Campus Cedro.</div>
        <div id="bot-master">WebMaster: Jos?? Ailton B. S.</div>
    </div>
</div>
</body><!-- InstanceEnd --></html>