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

$query_buscaModalidade = "SELECT * FROM modalidade";
$buscaModalidade = mysql_query($query_buscaModalidade, $link1) or die(mysql_error());
$row_buscaModalidade = mysql_fetch_assoc($buscaModalidade);
$totalRows_buscaModalidade = mysql_num_rows($buscaModalidade);
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
<style>
form {
	font-family: Verdana, Geneva, sans-serif;
	width: 500px;
	font-size:16px;
	margin: 0 auto;
	padding: 10px 10px;
	background-color: #CCC;
}
form label {
	display: block;
	margin: 5px 0;
}
form input {
	padding: 5px 0;
	width: 200px;
}
form select {
	padding: 5px 0;
	width: 200px;
}
form h2 {
	text-align: center;
	font-size: 16px;
}
form .submit {
	display:block;
	margin: 10px auto;
	background-color: #FFF;
	border: 1;
	border-color: #000;
	cursor: pointer;
}
.status {
	margin-bottom: 15px;
	color: #060;
	font-size:14px;
}
.atencao {
	margin-top: 10px;
	margin-bottom: 15px;
	color: #F00;
	font-size:14px;
}
</style>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<!-- InstanceEndEditable -->
</head>

<body>
<a id="link_pop" style="position: absolute; left:505px;top: 0px; z-index: 99; cursor: pointer; display:block;" onClick="document.getElementById('box_pop').style.display='none';document.getElementById('link_pop').style.display='none';"><img src="images/bt_close.png" width="25" height="25" border="0" /></a>
<div id="box_pop" style="position: absolute; left: 5px; top: 25px; background-color: #FFAE5E; border-style: solid; border-width: 3px; border-radius: 10px; width: 500px; height: 380px; padding: 10px; z-index: 99; display: block;">
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
<?php
/* Script de Uploader */
$link_retorno = "<center><a href=\"sys_simposio.php\">Voltar a Pagina de Upload!</a></center>"; //Link de Retorno do Sistema
if(isset($_FILES["artigo"])){
	if($_POST["titulo"] =="" || $_POST["resumo"]=="" || $_POST["autor1"]=="" || $_POST["chaves"]=="" || $_POST["modalidade"]==""){
		echo "<div class=\"box_atencao\">";
		echo "ERRO: Erro de Servidor tipo 00000002";
		echo "<br>Seu artigo NÃO foi enviado!!!</div>";
	echo $link_retorno;
		exit;
	}
	$meucodigo = "SELECT * FROM artigos WHERE titulo='". $_POST["titulo"] ."'";
	$bus = mysql_query($meucodigo,$link1);
	if(mysql_num_rows($bus) > 0){
		echo "<div class=\"box_atencao\">";
		echo "ERRO: Já existe um artigo com mesmo Titulo!!! Por favor altere o titulo.";
		echo "<br>Seu artigo NÃO foi enviado!!!</div>";
	echo $link_retorno;
		exit;
	}
	if($_FILES["artigo"]["error"]){
		echo "<div class=\"box_atencao\">";
	echo "ERRO: ";
	switch($_FILES["artigo"]["error"]){
		case 1: echo "Arquivo ultrapassou o tamanho limite de 2MB!";
		break;
		case 2: echo "Arquivo ultrapassou o tamanho maximo!";
		break;
		case 3: echo "O arquivo não foi enviador completamente!";
		break;
		case 4: echo "Arquivo não enviado!";
	}
	echo "<br>Seu artigo NÃO foi enviado!!!</div>";
	echo $link_retorno;
	exit;
	}
	if(!(
		$_FILES["artigo"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||
		$_FILES["artigo"]["type"] == "application/wps-office.docx"
	)){
		echo "<div class=\"box_atencao\">";
		echo "ERRO: O arquivo não é um Documento do Word 2007 (.docx) application/vnd.openxmlformats-officedocument.wordprocessingml.document";
		echo "<br>Seu artigo NÃO foi enviado!!!</div>";
	echo $link_retorno;
	exit;
	}
	$nomeUrl = date("dmyHis");
	$upfile = $_SERVER["DOCUMENT_ROOT"] . "/artigos_secitifcedro/". $nomeUrl . ".docx";
	if(is_uploaded_file($_FILES["artigo"]["tmp_name"])){
		if(!move_uploaded_file($_FILES["artigo"]["tmp_name"], $upfile))
		{
		echo "<div class=\"box_atencao\">";
		echo "ERRO: Erro de Servidor tipo 00000001";
		echo "<br>Seu artigo NÃO foi enviado!!!</div>";
		echo $link_retorno;
			exit;
		}
	} else {
		echo "<div class=\"box_atencao\">";
		echo "ERRO: Erro de Servidor tipo 00000003";
		echo "<br>Seu artigo NÃO foi enviado!!!</div>";
		echo $link_retorno;
			exit;
	}
	$meusql = "INSERT INTO artigos VALUES ('". $row_Recordset1['email'];
	$meusql.= "','". $_POST["titulo"] ."','". $_POST["resumo"] ."','". $_POST["chaves"];
	$meusql.= "','". $nomeUrl ."','". date("Y-m-d") ."','". $_POST["modalidade"];
	$meusql.= "','A','". date("Y-m-d") ."',null,null,null);";
	if(!mysql_query($meusql,$link1)){
		echo "<div class=\"box_atencao\">";
		echo "ERRO: Erro de Servidor tipo 00000002";
		echo "<br>Seu artigo NÃO foi enviado!!!</div>";
		echo $link_retorno;
		unlink($upfile);
		exit;
	}
	$meusql2 = "INSERT INTO autores VALUES ('". $nomeUrl ."','" . $_POST["autor1"] . "','');";
	mysql_query($meusql2,$link1);
	if($_POST["autor2"] != ""){
		$meusql2 = "INSERT INTO autores VALUES ('". $nomeUrl ."','" . $_POST["autor2"] . "','');";
		mysql_query($meusql2,$link1);
	}
	if($_POST["autor3"] != ""){
		$meusql2 = "INSERT INTO autores VALUES ('". $nomeUrl ."','" . $_POST["autor3"] . "','');";
		mysql_query($meusql2,$link1);
	}
	if($_POST["autor4"] != ""){
		$meusql2 = "INSERT INTO autores VALUES ('". $nomeUrl ."','" . $_POST["autor4"] . "','');";
		mysql_query($meusql2,$link1);
	}
	if($_POST["autor5"] != ""){
		$meusql2 = "INSERT INTO autores VALUES ('". $nomeUrl ."','" . $_POST["autor5"] . "','');";
		mysql_query($meusql2,$link1);
	}
	if($_POST["autor6"] != ""){
		$meusql2 = "INSERT INTO autores VALUES ('". $nomeUrl ."','" . $_POST["autor6"] . "','');";
		mysql_query($meusql2,$link1);
	}
	echo "<div class=\"box_ok\">";
	echo "PARABENS!!! Seu artigo foi enviado com Sucesso!!!";
	echo "</div>";
}
?>
    <h2>Artigos Enviados</h2>
    <table width="920" border="1" cellspacing="0" cellpadding="0">
      <tr bgcolor="#CCCCCC">
        <td>Titulo</td>
        <td>Primeiro Autor</td>
        <td>Palavras-chave</td>
        <td align="center">Arquivo</td>
        <td align="center">Data de Envio</td>
        <td align="center">Modalidade</td>
        <td align="center">Ultima Alteração</td>
        <td align="center">Situação</td>
      </tr>
      <?php
	  	$sqlcode = "SELECT * FROM artigos,modalidade WHERE email='". $row_Recordset1['email'] ."' AND modalidade.cod=cod_mod;";
		$mibusca = mysql_query($sqlcode,$link1);
		if(mysql_num_rows($mibusca) > 0){
			while($linha = mysql_fetch_assoc($mibusca)){
				$sqlautor = "SELECT * FROM autores WHERE cod_artigo=" . $linha["nomeurl"];
				$mibusca2 = mysql_query($sqlautor,$link1);
				$linha_autor = mysql_fetch_assoc($mibusca2);
	  ?>
      <tr bgcolor="<?php if($linha["situacao"]=="M") echo "#FF5151"; ?>">
        <td><a href="detalhes_artigo.php?artigo=<?=$linha["nomeurl"]?>"><?=$linha["titulo"]?></a></td>
        <td><?=$linha_autor["nome_autor"]?></td>
        <td><?=$linha["chaves"]?></td>
        <td align="center">
        <?php
		if($linha["situacao"]=="M")
		{
		?>
        <a href="detalhes_artigo.php?artigo=<?=$linha["nomeurl"]?>">Enviar artigo modificado</a>
        <?php
		}
		else
		{
		?>
        <a href="../artigos_secitifcedro/<?=$linha["nomeurl"]?>.docx"><?=$linha["nomeurl"]?>.docx</a>
        <?php
		}
		?>
        </td>
        <td align="center"><?=$linha["data_envio"]?></td>
        <td align="center"><?=$linha["nome_mod"]?></td>
        <td align="center"><?=$linha["ultima_alteracao"]?></td>
        <td align="center"><?php
		 /*
		 
		 A - Aguardando
		 M - Modificacao necessaria
		 N - Modificacao Enviada
		 V - Verificado
		 P - Publicado
		 
		 */
		 if($linha["nota1"] >= 6){
			 echo "Aceito para Apresentação";
			 switch($linha["situacao"]){
				case "M": echo " (Modificação necessaria)";
				break;
				case "N": echo " (Modificação Enviada)";
			}
		 } else
		 {
			 echo "Reprovado.";
		 }
		?></td>
      </tr>
      <?php
			}
		} else {
	?>
    <tr>
    	<td colspan="8">Nenhum Artigo encontrado!</td>
    </tr>
    <?php
		}
	  ?>
    </table><br />
	<?php
		// UPLOAD ENABLED
		if(true){
	?>
    <form enctype="multipart/form-data" action="sys_simposio.php" nome="send_artigo" method="post">
  	        <h3>Enviar Artigo para o I Simpósio Técnico</h3>
            <div class="atencao">Atenção os campos com asteriscos(*) são obrigatório.</div>
      <label for="titulo">Titulo do Artigo *</label>
            <input name="titulo" type="text" id="titulo" maxlength="300" />
            <label for="resumo">Resumo do Artigo *</label>
      <textarea name="resumo" id="resumo" cols="45" rows="5"></textarea>
      <div class="status">Resumo com no maximo 300 palavras.<br />Palavras: <span id="palavra">0</span>/300</div>
            <label for="autor1">Autor 1 *</label>
            <input type="text" name="autor1" id="autor1" />
      <label for="autor2">Autor 2</label>
            <input type="text" name="autor2" id="autor2" />
      <label for="autor3">Autor 3</label>
            <input type="text" name="autor3" id="autor3" />
      <label for="autor4">Autor 4</label>
            <input type="text" name="autor4" id="autor4" />
      <label for="autor5">Autor 5</label>
            <input type="text" name="autor5" id="autor5" />
      <label for="autor6">Autor 6</label>
            <input type="text" name="autor6" id="autor6" />
      <label for="chaves">Palavras-Chave *</label>
            <input name="chaves" type="text" id="chaves" maxlength="200" />
      <div class="status">Digite as palavras-chave separados por virgula (,)<br />Exemplo: palavras, chave, tags</div>
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
            <label for="arquivo">Selecione o arquivo a ser enviado *</label>
            <input type="file" name="artigo" />
            <div class="status">O arquivo tem que estar no formato Word 2007 (.docx) com no máximo 2MB.</div>
            <label for="modalidade">Escolha a Modalidade *</label>
            <select name="modalidade" id="modalidade">
            <option value="" selected="selected">Selecione</option>
              <?php
do {  
?>
              <option value="<?php echo $row_buscaModalidade['cod']?>"><?php echo $row_buscaModalidade['nome_mod']?></option>
              <?php
} while ($row_buscaModalidade = mysql_fetch_assoc($buscaModalidade));
  $rows = mysql_num_rows($buscaModalidade);
  if($rows > 0) {
      mysql_data_seek($buscaModalidade, 0);
	  $row_buscaModalidade = mysql_fetch_assoc($buscaModalidade);
  }
?>
            </select>
            <input name="Submit" type="submit" class="submit" id="button" value="Enviar Artigo" />
    </form>
	<script type="text/javascript">
	function isEmpty(obj){
		if(obj.value == ""){
			alert("Preencha o campo "+ obj.name);
			obj.focus();
			return false;
		}
		return true;
	}
	function countWord(obj){
			if(!obj.length) return 0;
			space = obj.indexOf(" ");
			subs = obj.substring(space+1,obj.length);
			if(space>=0)
				return 1+countWord(subs);
			return 1;
	}
	function valida(){
		with(document.forms[0]){
			return isEmpty(titulo) && isEmpty(resumo) && isEmpty(autor1) && isEmpty(chaves) && isEmpty(modalidade) && isEmpty(artigo);
		}
	}
	function atualiza(){
		res = document.forms[0].resumo.value;
		total = countWord(res);
		document.getElementById("palavra").innerHTML = total;
		while(total>300){
				ult = res.lastIndexOf(" ");
				document.forms[0].resumo.value =
				res.substring(0,ult);
				atualiza();
		}
	}
	document.forms[0].onsubmit = valida;
	document.forms[0].resumo.onkeyup = atualiza;
    </script>
 <?php
		}else {
?>
	<div class="box_alerta">A submissão de artigos para o I Simpósio Técnico se dará entre os dias 01 a 31 de outubro.</div>
<?php
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

mysql_free_result($buscaModalidade);
?>
