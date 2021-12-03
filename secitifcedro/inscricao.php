<?php

$site_saida = "https://secitifdemo.000webhostapp.com/secitifcedro";

$email_existe = false;
$nome = "";
$sobrenome = "";
$email = "";
$endereco = "";
$bairro = "";
$cidade = "";
$uf = "";
$celular = "";
$telefone = "";
$nasc = "";
session_start();
if (isset($_POST["capt"])) {
	$nome = $_POST["nome"];
	$sobrenome = $_POST["sobrenome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$endereco = $_POST["endereco"];
	$bairro = $_POST["bairro"];
	$cidade = $_POST["cidade"];
	$uf = $_POST["uf"];
	$celular = $_POST["celular"];
	$telefone = $_POST["telefone"];
	$nasc = $_POST["nasc"];
	$nascimento = $_POST["nascimento"];
	if ($_SESSION["captcha"] != $_POST["capt"]) {
		echo "<script>alert('As letras digitadas estão incorretas!!!');</script>";
	} else {
		if ($uf == "--") {
			echo "<script>alert('Seleciona a UF!!!');</script>";
		} else {
			//Script para guardar dados!

			require_once('Connections/link1.php');

			$sql = "INSERT INTO usuarios (email, nome, sobrenome, endereco, bairro, cidade,";
			$sql .= " uf, celular, telefone, d_nascimento, d_inscricao, senha) VALUES ('" . $email . "', '" . $nome . "',";
			$sql .= " '" . $sobrenome . "', '" . $endereco . "', '" . $bairro . "', '" . $cidade . "', '" . $uf . "', '" . $celular . "',";
			$sql .= " '" . $telefone . "', '" . $nascimento . "', '" . date("Y-m-d") . "', '" . $senha . "');";
			$busca = mysql_query($sql, $link1) or ("ERRO NA INSERCAO DE DADOS!!! VOLTE MAIS TARDE!!!");
			if ($busca == 1) {
				$dado = $email . "&" . $senha . "&" . $nome . "&1";
				$cript = base64_encode($dado);
				$urls = $site_saida . "/sendmail_.php?c=" . $cript;
				header("Location:" . $urls);
			} else {
				$email_existe = true;
			}
		}
	};
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="estilo.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script type="text/javascript" src="rand_banner.js"></script>
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>I SECITIF</title>
	<!-- InstanceEndEditable -->
	<!-- InstanceBeginEditable name="head" -->
	<style type="text/css">
		#conteudo {
			background-color: #CCC;
		}

		form {
			font-family: Verdana, Geneva, sans-serif;
			width: 500px;
			font-size: 16px;
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

		form h3 {
			text-align: center;
			font-size: 16px;
		}

		form fieldset {
			border: 0;
		}

		form .submit {
			display: block;
			margin: 10px auto;
			background-color: #FFF;
			border: 1;
			border-color: #000;
			cursor: pointer;
		}

		.status {
			margin-bottom: 15px;
			color: #060;
			font-size: 14px;
		}
	</style>

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
			<?php
			// Habilita Formulario
			if (true) {
			?>
				<form name="inscricao" method="post" action="inscricao.php">
					<fieldset>
						<h3>Inscrição no Sistema SECITIF-Cedro</h3>
						<div class="box_atencao">Atenção os campos com asteriscos(*) são obrigatório.</div>
						<label>Nome *</label><input name="nome" type="text" id="nome" value="<?= $nome ?>" maxlength="25" />
						<label>Sobrenome *</label><input name="sobrenome" type="text" value="<?= $sobrenome ?>" maxlength="25" />
						<div id="nome-pre" class="status">Seu Nome Completo é: </div>
						<div class="status">Obs: Para não haver problemas no seu certificado, verifique se seu <b>NOME COMPLETO</b> está sendo mostrado acima.</div>
						<label>Data de Nascimento *</label><input name="nasc" type="text" maxlength="10" value="<?= $nasc ?>" />
						<div class="status">Exemplo: 07/12/1990</div>
						<label>E-mail *</label><input name="email" type="text" maxlength="35" value="<?= $email ?>" />
						<?php
						if ($email_existe)
							echo "
			<div style='color:red;font-weight:bold;'>Usuário já está cadastrado!!!!</div>	
			  <script>
			  document.forms[0].email.focus();
			  document.forms[0].email.style.backgroundColor = 'red';
			  </script>";
						?>
						<label>UF *</label>
						<select name="uf">
							<option value="--" selected="selected">Selecione</option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AP">Amapá</option>
							<option value="AM">Amazonas</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espírito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MT">Mato Grosso</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MG">Minas Gerais</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PR">Paraná</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="SC">Santa Catarina</option>
							<option value="SP">São Paulo</option>
							<option value="SE">Sergipe</option>
							<option value="TO">Tocantins</option>
						</select>
						<label>Cidade *</label><input name="cidade" type="text" maxlength="35" value="<?= $cidade ?>" />
						<label>Bairro/Conjunto/Sitio *</label><input name="bairro" type="text" maxlength="35" value="<?= $bairro ?>" />
						<label>Endereço *</label><input name="endereco" type="text" maxlength="35" value="<?= $endereco ?>" />
						<div class="status">Digite esse campo apenas a Rua ou Avenida e o numero a casa ou apartamento</div>
						<label>Celular *</label><input name="celular" type="text" maxlength="11" value="<?= $celular ?>" />
						<label>Telefone</label><input name="telefone" type="text" maxlength="11" value="<?= $telefone ?>" />
						<label>Senha *</label><input name="senha" type="password" maxlength="10" value="" />
						<div class="status">Obs: a senha tem que ter no minimo 6 digitos</div>
						<label>Confirme a senha *</label><input name="senha2" type="password" maxlength="10" value="" />
						<label><img src="captcha/captcha.php" width="240" height="80" /></label>
						<label>Digite os Caracteres da imagem acima *</label><input name="capt" type="text" maxlength="5" />
						<input name="nascimento" type="hidden" maxlength="10" />
						<input type="submit" class="submit" value="Inscrever-se!" />
					</fieldset>
				</form>
				<script type="text/javascript">
					function setMaior() {
						this.value = this.value.toUpperCase();
					}

					function setMenor() {
						this.value = this.value.toLowerCase();
					}

					function nomeCompleto() {
						this.value = this.value.toUpperCase();
						document.getElementById("nome-pre").innerHTML = "<b>Seu Nome Completo é: </b>" + document.inscricao.nome.value + " " + document.inscricao.sobrenome.value;
					}

					function setNumber() {
						if (this.value.length > 0) {
							if (isNaN(parseInt(this.value.substring(this.value.length - 1, this.value.length)))) {
								alert("Só é permitido digitar números nesse campo");
								this.value = this.value.substring(0, this.value.length - 1);
							}
						}
					}

					function checarEmail() {
						if (document.forms[0].email.value == "" ||
							document.forms[0].email.value.indexOf('@') == -1) {
							alert("Por favor, informe um EMAIL válido!");
							return false;
						}
						return true;
					}

					function validaData() {
						data_nasc = document.forms[0].nasc.value;
						dia = data_nasc.substring(0, 2);
						mes = data_nasc.substring(3, 5);
						ano = data_nasc.substring(6, 10);
						if (isNaN(dia) || isNaN(mes) || isNaN(ano)) {
							alert("Formato de data Invalida!");
							document.forms[0].nasc.focus();
							return false;
						}
						if (parseInt(dia) > 31 || parseInt(mes) > 12 || parseInt(ano) < 1912) {
							alert("Data invalido!");
							return false;
						}
						document.forms[0].nascimento.value = ano + "-" + mes + "-" + dia;
						return true;
					}

					function valida() {
						with(document.inscricao) {
							if (nome.value == "") {
								alert("Preencha seu nome!!!");
								nome.focus();
								return false;
							} else if (sobrenome.value == "") {
								alert("Preencha seu Sobreome!!!");
								sobrenome.focus();
								return false;
							} else if (nasc.value == "") {
								alert("Preencha a data de nascimento!!!");
								nasc.focus();
								return false;
							} else {
								if (validaData() && checarEmail()) {
									if (uf.value == "--") {
										alert("Selecione um estado em UF!");
										uf.focus();
										return false;
									} else if (cidade.value == "") {
										alert("Preencha o campo Cidade!");
										cidade.focus();
									} else if (bairro.value == "") {
										alert("Preencha o campo Bairro!");
										bairro.focus();
									} else if (endereco.value == "") {
										alert("Preencha o campo Endereço!");
										endereco.focus();
									} else if (celular.value == "") {
										alert("Preencha campo Celular");
									} else if (senha.value.length < 6 || senha.value != senha2.value) {
										alert("As senhas não são iguais ou são menores que 6 digitos!");
										senha.value = "";
										senha2.value = "";
										return false;
									} else {
										return true;
									}

								}
								return false;
							}
						}
					}
					document.inscricao.nome.onkeyup = nomeCompleto;
					document.inscricao.sobrenome.onkeyup = nomeCompleto;
					document.inscricao.email.onkeyup = setMenor;
					document.inscricao.cidade.onkeyup = setMaior;
					document.inscricao.bairro.onkeyup = setMaior;
					document.inscricao.endereco.onkeyup = setMaior;
					document.inscricao.celular.onkeyup = setNumber;
					document.inscricao.telefone.onkeyup = setNumber;
					document.inscricao.capt.onkeyup = setMenor;
					document.inscricao.email.onblur = checarEmail;
					document.inscricao.onsubmit = valida;
				</script>
			<?php
			} else {
				echo "nao disponivel";
			}
			?>
			<!-- InstanceEndEditable -->
		</div>
		<div id="rodape">
			<div id="rodape-inner">
				<div class="reservado" id="reserv1"></div>
				<div class="reservado" id="reserv2"></div>
				<script type="text/javascript">
					rand_banner("reserv1", 10, 326, 140, 5);
					rand_banner("reserv2", 10, 326, 140, 4);
				</script>
			</div>
			<div id="if-logo"></div>
		</div>
		<div id="bottom">
			<div id="bot-text">Copyright &copy; 2012 - I Semana de Ciências e Tecnologia do IFCE Campus Cedro.</div>
			<div id="bot-master">WebMaster: José Ailton B. S.</div>
		</div>
	</div>
</body><!-- InstanceEnd -->

</html>