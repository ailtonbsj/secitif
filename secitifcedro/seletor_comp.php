<?php
require_once('Connections/link1.php');
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
    <br />
    <center>
    <a href="seletor.php">Voltar para pagina de escolha do evento</a>
    </center>
    <div class="box_ok">Caso d&uacute;vidas de como inscrever-se nas Competi&ccedil;&otilde;es, acesse o tutorial abaixo:<br />
    <a href="tuto_pag_comp.php">Tutorial Como inscrever-se em uma Competição aqui!</a></div>
    <br />
    <h1>Selecione a Competição desejada:</h1>
    <ul>
    	<a href="sys_comp.php?comp=elet"><li>Competição da Eletrotécnica </li></a>
        <?php
		$sql_e = "SELECT * FROM equipes WHERE compet='elet' AND pago ='T'";
		$busca_e = mysql_query($sql_e,$link1);
		$total_e = mysql_num_rows($busca_e);
		?>
        (Máximo de Equipes: 12 / Equipes Confirmados: <?= $total_e ?>)
        <a href="sys_comp.php?comp=meca"><li>Corrida Mecanica</li></a>
        <?php
		$sql_e = "SELECT * FROM equipes WHERE compet='meca' AND pago ='T'";
		$busca_e = mysql_query($sql_e,$link1);
		$total_e = mysql_num_rows($busca_e);
		?>
        (Máximo de Equipes: 10 / Equipes Confirmados: <?= $total_e ?>)
        <a href="sys_comp.php?comp=prog"><li>Maratona de Programação</li></a>
        <?php
		$sql_e = "SELECT * FROM equipes WHERE compet='prog' AND pago ='T'";
		$busca_e = mysql_query($sql_e,$link1);
		$total_e = mysql_num_rows($busca_e);
		?>
        (Máximo de Equipes: 30 / Equipes Confirmados: <?= $total_e ?>)
        <a href="sys_comp.php?comp=xadr"><li>Competição de Xadrez</li></a>
        <?php
		$sql_e = "SELECT * FROM equipes WHERE compet='xadr' AND pago ='T'";
		$busca_e = mysql_query($sql_e,$link1);
		$total_e = mysql_num_rows($busca_e);
		?>
        (Equipes Confirmados: <?= $total_e ?>)
        <li>ROBOMECT</li>
        <ul>
        	<a href="sys_comp.php?comp=corr"><li>Corrida</li></a>
            <?php
		$sql_e = "SELECT * FROM equipes WHERE compet='corr' AND pago ='T'";
		$busca_e = mysql_query($sql_e,$link1);
		$total_e = mysql_num_rows($busca_e);
		?>
        (Equipes Confirmados: <?= $total_e ?>)
            <a href="sys_comp.php?comp=linh"><li>Seguidor de Linha</li></a>
            <?php
		$sql_e = "SELECT * FROM equipes WHERE compet='linh' AND pago ='T'";
		$busca_e = mysql_query($sql_e,$link1);
		$total_e = mysql_num_rows($busca_e);
		?>
        (Equipes Confirmados: <?= $total_e ?>)
            <a href="sys_comp.php?comp=drag"><li>Dragster</li></a>
            <?php
		$sql_e = "SELECT * FROM equipes WHERE compet='drag' AND pago ='T'";
		$busca_e = mysql_query($sql_e,$link1);
		$total_e = mysql_num_rows($busca_e);
		?>
        (Equipes Confirmados: <?= $total_e ?>)
            <a href="sys_comp.php?comp=labi"><li>Labirinto</li></a>
            <?php
		$sql_e = "SELECT * FROM equipes WHERE compet='labi' AND pago ='T'";
		$busca_e = mysql_query($sql_e,$link1);
		$total_e = mysql_num_rows($busca_e);
		?>
        (Equipes Confirmados: <?= $total_e ?>)
        </ul>
    </ul>
    <script type="text/javascript">
	document.body.onload = null;
	</script>
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