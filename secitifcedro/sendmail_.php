<?php

$site = "https://secitifdemo.000webhostapp.com/secitifcedro";

if(isset($_GET["c"]) || isset($_GET["sms"]))
{
	if(isset($_GET["c"])){
	$code = base64_decode($_GET["c"]);
	$email=strtok($code,"&");
	$senha=strtok("&");
	$nome=strtok("&");
	$codigo=strtok("&");
	} else if(isset($_GET["sms"])) {
		$email = "sac@ifce.edu.br";
		$froms = $_GET["mail"];
		$assunto = "SECITIF(Fale Conosco): " . strip_tags($_GET["ass"]);
		$corpo = "Nome: " .$nome . "<br />Email: " . $froms . "<br /><br />" . strip_tags($_GET["sms"]);
		$codigo = "3";
	}
	//Script de envio de email aqui!
	if($codigo == "1"){
	$assunto = "Inscrição no Sistema SECITIF";
	$corpo = "<html><head><title>Bem vindo!</title></head>
	<body>
	<h2>" . $nome . ", Bem Vindo a I SECITIF!!!</h2>
	<p>Você recebeu essa mensagem porque se cadastrou no site da I SECITIF.</p>
	<b>Seu Login é: </b>" . $email . "<br />
	<b>Sua Senha é: </b>". $senha . "<br />
	<br />
	<a href=\"". $site ."/confirmacao.php?email=". urlencode($email) ."&enable=true\">Clique aqui para Confirmar a sua Inscrição</a>
	<br />
	Caso tenha recebido essa mensagem por engano, por favor, desconsidere!
	</body><html>	
	";
	} else if($codigo == "2"){
	$assunto = "Recuperar Senha do Sistema SECITIF-Cedro";
	$corpo = "<html><head><title>Email de Recuperacao de senha</title></head>
					<body>
					<h2>" . $nome . ",</h2>
					<p>Seus dados de Login e senha estão abaixo, caso problemas em logar, por favor nos informe:</p>
					<b>Seu Login é: </b>" . $email . "<br />
					<b>Sua Senha é: </b>". $senha . "<br />
					<br />
					Caso tenha recebido essa mensagem por engano, por favor, desconsidere!
					</body><html>	
					";
	}
	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html;";
	$headers.= "charset=UTF-8\r\n";
	if($codigo == "3") $headers.= "From: " . $nome . "<". $froms .">\r\n";
	else $headers.= "From: SECITIF<ailton@ifce.edu.br>\r\n";
	mail($email, $assunto,$corpo, $headers) or die("ERRO!");
	if($codigo == "1"){
	header("Location:". $site ."/sucesso.php?nome=". urlencode($nome) . "&email=" . urlencode($email));
	} else if($codigo == "2") {
			 header("Location:" . $site . "/index.php?sendmail=ok");
	} else if($codigo == "3") {
		header("Location:". $site ."/contatos.php?sendmail=ok");
	}
}
if(isset($_GET["data"]))
{
	$entrada = base64_decode($_GET["data"]);
	$anc = strtok($entrada,"$");
	$nome = strtok("$");
	$email = strtok("$");
	$titulo = strtok("$");
	$alt = strtok("$");
	$motivo = strtok("$");
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html;";
	$headers.= "charset=UTF-8\r\n";
	$headers.= "From: SECITIF<ailton@ifce.edu.br>\r\n";
	$assunto = "Publicação de artigo na I SECITIF-Cedro";
	$corpo = "<html><head><title>Publicação de artigo</title></head>
	<body>
		<h1>$nome,</h1>
		<p>Informamos que o seu artigo \"$titulo\" foi avaliado.</p>";
		if($alt=="true"){
		$corpo .= "<p>Mas é necessária a seguinte alteração:</p>
		<p><pre>". $motivo ."</pre></p>
		<p>Faça as alterações descritas acima, depois acesse o sistema do I Simpósio Técnico no site da  I SECITIF(www.secitif.com.br) e selecione 'enviar artigo alterado'.</p>";
		}
		$corpo.= "<br><br><br>Caso tenha recebido essa mensagem por engano, por favor, desconsidere! 

	</body>
	<html>";
	mail($email, $assunto,$corpo, $headers) or die("ERRO!");
	header("location: " . $site . "/admin_prof/sys_prof.php#" . $anc);
}
?>