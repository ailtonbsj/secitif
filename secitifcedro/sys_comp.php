<?php require_once('Connections/link1.php'); ?>
<?php
	if(isset($_POST["titulo"]))
	{
		$cod_equipe = date("dmyHis");
		$titulo = $_POST["titulo"];
		$lider = $_POST["lider"];
		$comp = $_GET["comp"];
		$sql_int2 = "SELECT * FROM equipes_usuarios,equipes WHERE equipes_usuarios.cod_equipe=equipes.cod_equipe AND compet='$comp' AND email_usu='$lider'";
		$busca_int2 = mysql_query($sql_int2,$link1);
		$tot_line = mysql_num_rows($busca_int2);
		if($tot_line==0)
		{
			$sql2 = "INSERT INTO equipes VALUES ('$cod_equipe', '$titulo', '$comp','F',NULL,NULL)";
			$sql3 = "INSERT INTO equipes_usuarios VALUES ('$cod_equipe', '$lider', 'L')";
			$busca2 = mysql_query($sql2,$link1);
			$busca3 = mysql_query($sql3,$link1);
		}
	}
	if(isset($_GET["op"]))
	{
		if($_GET["op"]=="f")
		{
			$cod = $_GET["cod"];
			$usu = $_GET["usu"];
			$sql6 = "DELETE FROM equipes_usuarios WHERE email_usu = '$usu' AND cod_equipe='$cod'";
			$busca6 = mysql_query($sql6,$link1);
		}
		else if($_GET["op"]=="g")
		{
			$cod = $_GET["cod"];
			$mail = $_GET["mail"];
			$sql_int1 = "SELECT * FROM equipes_usuarios WHERE email_usu='$mail' AND cod_equipe='$cod'";
			$busca_int1 = mysql_query($sql_int1,$link1);
			$exist_int1 = mysql_num_rows($busca_int1);
			if($exist_int1==0)
			{
				$sql9 = "INSERT INTO equipes_usuarios VALUES ('$cod', '$mail', 'A');";
				$busca9 = mysql_query($sql9,$link1);
			}
		}
	}
	else if(isset($_GET["cof"]))
	{
		if($_GET["cof"]=="y")
		{
			$cod = $_GET["cod"];
			$mail = $_GET["usu"];
			$sql10 = "UPDATE equipes_usuarios SET status = 'M' WHERE cod_equipe = '$cod' AND email_usu = '$mail';";
			mysql_query($sql10,$link1);
		}
	}
	if(isset($_GET["eq"]))
	{
		if($_GET["eq"]=="ex")
		{
			$codi = $_GET["cod"];
			$sql_del_eq = "DELETE FROM equipes_usuarios WHERE cod_equipe='$codi'";
			$sql_del_me = "DELETE FROM equipes WHERE cod_equipe='$codi'";
			mysql_query($sql_del_eq,$link1);
			mysql_query($sql_del_me,$link1);
		}
	}
?>
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
require_once('Connections/link1.php');
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
<style type="text/css">
    #box_nova_equipe {
		border: #000 solid 2px;
		background: #fff;
		width: 300px;
		font-family: Verdana, Geneva, sans-serif;
		font-size: 16px;
		margin: 5px auto;
	}
	#titulo_nova_equipe {
		padding: 10px;
		background: #666;
		text-align: center;
	}
	#text_nova_equipe {
		padding: 5px;
	}
	#text_nova_equipe input {
		width: 120px;
	}
	#int_nova_equipe {
		margin: 5px;
		padding: 5px;
		background-color:#999999;
	}
	#int_nova_equipe div {
		border: #FFF solid 1px;
		padding: 5px;
		margin-top: 2px;
	}
	#criar input {
		padding: 10px;
		margin: 5px 5px;
	}
	
	.box_equipe {
		border: #000 solid 2px;
		background: #fff;
		width: 700px;
		font-family: Verdana, Geneva, sans-serif;
		font-size: 16px;
		margin: 5px auto;
	}
    </style>
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
    <a href="seletor_comp.php">Voltar para pagina de escolha da Competição</a>
    </center>
    <br />
    <h1>
	<?php
    	switch($_GET["comp"])
		{
			case "elet":
				echo "Competição da Eletrotécnica";
				$max_membro = 2;
				$pag_value = 10;
				$max_equipe = 12;
			break;
			case "meca":
				echo "Competição: Corrida Mecanica";
				$max_membro = 4;
				$pag_value = 12;
				$max_equipe = 10;
			break;
			case "prog":
				echo "Competição: Maratona de Programação";
				$max_membro = 2;
				$pag_value = 10;
				$max_equipe = 30;
			break;
			case "xadr":
				echo "Competição de Xadrez";
				$max_membro = 1;
				$pag_value = 10;
				$max_equipe = 0;
			break;
			case "corr":
				echo "ROBOMECT: Corrida";
				$max_membro = 4;
				$pag_value = 20;
				$max_equipe = 0;
			break;
			case "linh":
				echo "ROBOMECT: Seguidor de Linha";
				$max_membro = 4;
				$pag_value = 20;
				$max_equipe = 0;
			break;
			case "drag":
				echo "ROBOMECT: Dragster";
				$max_membro = 4;
				$pag_value = 20;
				$max_equipe = 0;
			break;
			case "labi":
				echo "ROBOMECT: Labirinto";
				$max_membro = 4;
				$pag_value = 20;
				$max_equipe = 0;
			break;
			
		}
	?>
    </h1>
    <?php
		$sql1 = "SELECT equipes_usuarios.*,equipes.nome_equipe,equipes.compet,equipes.pago FROM equipes_usuarios,equipes WHERE equipes_usuarios.cod_equipe=equipes.cod_equipe AND compet='". $_GET["comp"] ."' AND email_usu='". $_SESSION['MM_Username'] ."'";
		$busca1 = mysql_query($sql1,$link1) or die("ERRO!");
		$result1 = mysql_num_rows($busca1);
		if($result1==0)
		{
			$sql11 = "SELECT * FROM equipes WHERE compet='". $_GET["comp"] ."' AND pago = 'T'";
			$busca11 = mysql_query($sql11,$link1);
			$total_conf = mysql_num_rows($busca11);
			if($total_conf < $max_equipe || $max_equipe==0)
			{	
	?>
    <div id="box_nova_equipe">
   	  <div id="titulo_nova_equipe">Criar Nova Equipe</div>
        <form name="novaequipe" action="sys_comp.php?comp=<?= $_GET["comp"] ?>" method="post" id="nova_equipe">
        <div id="text_nova_equipe">Nome da Equipe <input name="titulo" type="text" value="" /></div>
        <div id="int_nova_equipe">Integrantes
        <div><?php echo $row_Recordset1['nome']; ?> (Líder)<input name="lider" type="hidden" value="<?php echo $_SESSION['MM_Username']; ?>" /></div>
        </div>
        <div id="criar" ><input type="submit" value="Criar Equipe" /></div>
        </form>
        <script type="text/javascript">
		function askNewEquipe()
		{
			if(confirm("tem Certeza que deseja criar nova Equipe?"))
			return true;
			else
			return false;
		}
		document.novaequipe.onsubmit = askNewEquipe;
        </script>
    </div>
    <?php
			}
			else
			{
				echo "<div class=\"box_alerta\">Não há mais vagas para essa competição!</div>";
			}
		}
		else
		{
			$linha1 = mysql_fetch_assoc($busca1);
			$status = $linha1["status"];
			if($status=="L")
			{
				if($linha1["pago"]=="F")
				{
					echo "<div class=\"box_alerta\">
					Equipe ainda não pagou para entrar na competição.<br>
					<a href=\"tuto_pag_comp.php\">Veja como pagar e confirmar o pagamento!</a>
					</div>";
				}
				else if($linha1["pago"]=="T")
				{
					echo "<div class=\"box_ok\">
					Parabéns!<br />Confirmado o pagamento da equipe!
					</div>";
				}
	?>
    <div class="box_equipe">
    	<div id="titulo_nova_equipe">Equipe: <?= $linha1["nome_equipe"] ?>
        <?php
		if($linha1["pago"]=="F")
		{
		?>
        <img src="images/remove.jpg" border="0" style="float:right; cursor: pointer;" onclick="if(confirm('Tem certeza que deseja Excluir a Equipe???\nTodos os membros serão removidos dela e a equipe desfeita.')) location.href='sys_comp.php?comp=<?= $_GET["comp"] ?>&eq=ex&cod=<?= $linha1["cod_equipe"] ?>';" />
        <?php
		}
		?>
        </div>
        <div id="int_nova_equipe">
        Integrantes
        <?php
			$sql5 = "SELECT * FROM equipes_usuarios,equipes,usuarios ";
			$sql5.= "WHERE email_usu=usuarios.email AND equipes_usuarios.cod_equipe=equipes.cod_equipe AND equipes_usuarios.cod_equipe='". $linha1["cod_equipe"] ."' ORDER BY FIELD(equipes_usuarios.status, 'A') DESC";
			$busca5 = mysql_query($sql5,$link1);
			$membros = mysql_num_rows($busca5);
			while($linha5 = mysql_fetch_assoc($busca5))
			{
				switch($linha5["status"])
				{
					case "L":
						$confi = "(Líder)";
						$fundo = " style=\"background-color: #B5FF95\"";
						$excluir = "";
						break;
					case "A":
						$confi = "(Não Confirmado!)";
						$fundo = " style=\"background-color: #FF6262\"";
						$excluir = "<a href=\"javascript:if(confirm('Tem Certeza que deseja Remover da Equipe???'))location.href='sys_comp.php?comp=". $_GET["comp"] ."&cod=". $linha5["cod_equipe"] ."&op=f&usu=". $linha5["email_usu"] ."'\"><img src=\"images/remove.jpg\" style=\"float:right; cursor:pointer;\" border=\"0\"></a>";
						break;
					case "M":
						$confi = "(Confirmado!)";
						$fundo = " style=\"background-color: #B5FF95\"";
						$excluir = "<a href=\"javascript:if(confirm('Tem Certeza que deseja Remover da Equipe???'))location.href='sys_comp.php?comp=". $_GET["comp"] ."&cod=". $linha5["cod_equipe"] ."&op=f&usu=". $linha5["email_usu"] ."'\"><img src=\"images/remove.jpg\" style=\"float:right; cursor:pointer;\" border=\"0\"></a>";
						break;
				}
				echo "<div". $fundo .">" . $linha5["nome"] . " " . $linha5["sobrenome"] ." - ". $linha5["email_usu"] . " ". $confi . $excluir . "</div>";
			}
		?>
        
        </div>
    </div>
    <?php
	//inicio busca
	if($membros < $max_membro)
	{
	?>
    <div class="box_equipe">
    	<div id="titulo_nova_equipe">Adicionar Novo Membro</div>
        <div id="int_nova_equipe" style=" padding: 10px;">
        	Busque por Nome ou e-mail:
        	<form action="sys_comp.php?comp=<?= $_GET["comp"] ?>" method="post">
        	<input name="query_nome" type="text" style="width: 300px;" /><input name="" type="submit" value="Buscar" />
        	</form>
        </div>
        <div id="int_nova_equipe">
        <?php
			if(isset($_POST["query_nome"]))
			{
				$query = $_POST["query_nome"];
				$query = str_replace(array("<", ">", "\\", "/", "=", "'", "?"), "", $query);
				$sql7 = "SELECT * FROM usuarios WHERE (nome LIKE '%$query%' OR sobrenome LIKE '%$query%' OR email = '$query') LIMIT 0,15";
				$busca7 = mysql_query($sql7,$link1);
				if(mysql_num_rows($busca7)==0)
				{
					echo "<span>Nenhum registro encontrado!</span>";
				}
				while($linha7 = mysql_fetch_assoc($busca7))
				{
					$sql8 = "SELECT equipes_usuarios.*,equipes.compet FROM equipes_usuarios,equipes WHERE equipes_usuarios.cod_equipe=equipes.cod_equipe AND equipes.compet='". $_GET["comp"] ."' AND email_usu='". $linha7["email"] ."'";
					$busca8 = mysql_query($sql8,$link1);
					$total_line = mysql_num_rows($busca8);
					if($total_line==0) $add_line = "<a href=\"sys_comp.php?comp=". $_GET["comp"] ."&op=g&cod=". $linha1["cod_equipe"] ."&mail=". $linha7["email"] ."\"><img src=\"images/adicionar.png\" style=\"float:right;\" border=\"0\"></a>";
					else
					{
						$linha8 = mysql_fetch_assoc($busca8);
						switch($linha8["status"])
						{
							case "L":
								$add_line = " (Líder de uma Equipe)";
							break;
							case "A":
								$add_line = " (Outra Equipe adicionou)";
							break;
							case "M":
								$add_line = " (Membro de uma Equipe)";
							break;
						}
					}
					echo "<div>". $linha7["nome"] . " " . $linha7["sobrenome"] . " - " . $linha7["email"] . $add_line . "</div>";
				}
			}
		?>
        </div>
    </div>
    <?php
	}
	else
	{
	?>
    <div class="box_ok">Máximo de membros na equipe é: <?= $max_membro ?>.</div>
	<?php
	}
	if($_GET["comp"]=="corr" || $_GET["comp"]=="linh" || $_GET["comp"]=="drag" || $_GET["comp"]=="labi")
	{
		echo"<div class=\"box_atencao\" class=\"box_ok\">
		Caso a equipe queira inscrever-se também em outra categoria da ROBOMECT o Líder deve criar uma equipe com mesmo Titulo e adicionar os mesmos membros. É importante que o Líder que crie a equipe na outra categoria, pois assim o pagamento será único no valor de R$20,00. Mais informações, acesse o menu Download e baixe o edital.
		</div>";
	}
	//fim busca
			}
			else if($status=="M" || $status=="A")
			{
				if($status=="A")
				{
	?>
    <div style="background-color: #F60; color:#000000; font-family: Verdana, Geneva, sans-serif; font-size: 18px; width: 350px; margin: 0px auto; padding: 10px; text-align: center; border: #000 dashed 1px;">
    Você ainda não confirmou a participação na Equipe "<?= $linha1["nome_equipe"] ?>".<br />
    <?php
	$z_c = $_GET["comp"];
	$z_u = $_SESSION['MM_Username'];
	$z_e = $linha1["cod_equipe"];
	?>
    <input type="button" value="CONFIRMAR PARTICIPAÇÃO" onclick="if(confirm('Tem deseja que deseja participar???')) location.href='sys_comp.php?comp=<?=$z_c?>&cof=y&usu=<?=$z_u?>&cod=<?=$z_e?>'" />
    <input type="button" value="CANCELAR PARTICIPAÇÃO" onclick="if(confirm('Tem deseja que NAO deseja participar???')) location.href='sys_comp.php?comp=<?=$z_c?>&op=f&usu=<?=$z_u?>&cod=<?=$z_e?>'" />
    </div>
    <?php
				}
				else
				{
					if($linha1["pago"]=="F")
					{
						echo "<div class=\"box_alerta\">
						Equipe ainda não pagou para entrar na competição.<br>
						<a href=\"tuto_pag_comp.php\">Veja como pagar e confirmar o pagamento!</a>
						</div>";
					}
					else if($linha1["pago"]=="T")
					{
						echo "<div class=\"box_ok\">
						Parabéns!<br />Confirmado o pagamento da equipe!
						</div>";
					}
				}
	?>
    <div class="box_equipe">
    	<div id="titulo_nova_equipe">Equipe: <?= $linha1["nome_equipe"] ?></div>
        <div id="int_nova_equipe">
        Integrantes
        <?php
			$sql4 = "SELECT * FROM equipes_usuarios,equipes,usuarios ";
			$sql4.= "WHERE email_usu=usuarios.email AND equipes_usuarios.cod_equipe=equipes.cod_equipe AND equipes_usuarios.cod_equipe='". $linha1["cod_equipe"] ."' ORDER BY FIELD(equipes_usuarios.status, 'A') DESC";
			$busca4 = mysql_query($sql4,$link1);
			while($linha4 = mysql_fetch_assoc($busca4))
			{
				switch($linha4["status"])
				{
					case "L":
						$confi = "(Líder)";
						$fundo = " style=\"background-color: #B5FF95\"";
						break;
					case "A":
						$confi = "(Não Confirmado!)";
						$fundo = " style=\"background-color: #FF6262\"";
						break;
					case "M":
						$confi = "(Confirmado!)";
						$fundo = " style=\"background-color: #B5FF95\"";
						break;
				}
				echo "<div". $fundo .">" . $linha4["nome"] . " " . $linha4["sobrenome"] ." - ". $linha4["email_usu"] . " ". $confi ."</div>";
			}
		?>
        
        </div>
    </div>
    <?php
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
    	<div id="bot-text">Copyright &copy; 2012 - I Semana de Ciências e Tecnologia do IFCE Campus Cedro.</div>
        <div id="bot-master">WebMaster: José Ailton B. S.</div>
    </div>
</div>
</body><!-- InstanceEnd --></html>
<?php
mysql_free_result($Recordset1);
?>
