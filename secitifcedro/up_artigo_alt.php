<?php
 require_once('Connections/link1.php');
 
if(isset($_FILES["artigo_alt"]))
{
	if($_FILES["artigo_alt"]["error"])
	{
		switch($_FILES["artigo_alt"]["error"]){
			case 1: $retorno = urlencode("Arquivo ultrapassou o tamanho limite de 2MB!");
			break;
			case 2: $retorno = urlencode("Arquivo ultrapassou o tamanho maximo!");
			break;
			case 3: $retorno = urlencode("O arquivo não foi enviador completamente!");
			break;
			case 4: $retorno = urlencode("Arquivo não enviado!");
	}
	header("Location: detalhes_artigo.php?artigo=" . $_POST["codigo"] . "&error=" . $retorno);
	exit;
	}
	if(!(
		$_FILES["artigo_alt"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||
		$_FILES["artigo_alt"]["type"] == "application/wps-office.docx"
	)){
		$retorno = urlencode($_FILES["artigo_alt"]["type"]);
		header("Location: detalhes_artigo.php?artigo=" . $_POST["codigo"] . "&error=" . $retorno);
		exit;
	}
	$nomeurl = $_POST["codigo"];
	$upfile = $_SERVER["DOCUMENT_ROOT"] . "/artigos_secitifcedro/". $nomeurl . ".docx";
	if(is_uploaded_file($_FILES["artigo_alt"]["tmp_name"])){
		if(!move_uploaded_file($_FILES["artigo_alt"]["tmp_name"], $upfile))
		{
			$retorno = urlencode("Erro de Servidor tipo 00000001");
			header("Location: detalhes_artigo.php?artigo=" . $_POST["codigo"] . "&error=" . $retorno);
			exit;
		}
	}
	else
	{
		$retorno = urlencode("Erro de Servidor tipo 00000003");
		header("Location: detalhes_artigo.php?artigo=" . $_POST["codigo"] . "&error=" . $retorno);
		exit;
	}
	$sql1 = "UPDATE artigos SET situacao = 'N' WHERE nomeurl = '". $_POST["codigo"] ."';";
	$busca1 = mysql_query($sql1,$link1);
	
	header("Location: detalhes_artigo.php?artigo=" . $_POST["codigo"] . "&sucess=ok");
	exit;
}
header("Location: detalhes_artigo.php?artigo=" . $_POST["codigo"]);
?>