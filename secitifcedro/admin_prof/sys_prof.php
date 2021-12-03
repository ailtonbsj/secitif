<?php
session_start();
if(isset($_SESSION["usuario"]))
{
	require_once('../Connections/link1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="style_sys_prof.css" media="screen"/>
<title>Sistema Administrativo - I Simpósio Técnico do IFCE </title>
</head>
<body>
<div id="box_geral">
    <div id="header">
        <div class="logo_simposio"></div>
		<div class="descricao">
		<h2>Sistema Administrativo de Avaliação de Artigos</br>I Simpósio Técnico</h2>
		<h3>IFCE - Campus Cedro</h3>
		</div>
		
		<div id="sair"><a href="index.php?logoff=true"><img src="images/Knob Cancel.png" border="0" alt="" width="22" height="22"/><p>SAIR<p></a>
		</div>
		
    </div>
	<!--Fim Top-->
	<!--Usuario Logado-->
	<div id="content_container">
	</br>
	<div id="user_log">Bem Vindo, <u><?= $_SESSION["usuario"] ?></u>!!!</div>
    <script type="text/javascript">
	function requereAlt(formu)
	{
		saida = confirm("Deseja requerer alteração ou cancelar???");
		if(saida==true)
		{
			motivo = prompt("Digite a requisição de alteração. Obs; esse texto será enviado para o usuario do artigo!");
			formu.contalt.value = motivo;
			formu.alt.value = "true";
		}
		else
		{
			formu.alt.value = "false";
		}
	}
    </script>
<?php
	$sql1 = "SELECT * FROM artigos,modalidade WHERE cod_mod=cod ORDER BY nota2,nota1"; //ORDER BY FIELD(situacao, 'N') DESC
	$busca1 = mysql_query($sql1,$link1);
	$cont = 0;
	while($linha1 = mysql_fetch_assoc($busca1))
	{
		$cont++;
?>
<a name="<?= $cont ?>"></a>	
   <table width="100%" border="0" cellspacing="15" cellpadding="0" class="table" bgcolor="<?php if($linha1["situacao"]=="N") echo "#FFFF82"; ?>">

  <tr>
    <td width="25%"><img src="images/list-checkmark.png" alt="" /><b>Titulo do Artigo:</b></td>
    <td width="80%"><?= $linha1["titulo"] ?></td>
  </tr>
  <tr>
    <td><img src="images/list-checkmark.png" alt="" /><b>Resumo:</b></td>
    <td><a href="javascript:alert('<?= $linha1["resumo"]?>');">Ver Resumo</a></td>
  </tr>
  <tr>
    <td valign="top"><img src="images/list-checkmark.png" alt="" /><b>Autores:</b></td>
    <td>
    <?php
		$sql2 = "SELECT * FROM autores WHERE cod_artigo = " . $linha1["nomeurl"];
		$busca2 = mysql_query($sql2,$link1);
		while($linha2 = mysql_fetch_assoc($busca2))
		{
			echo $linha2["nome_autor"] . "<br>";
		}
	?>
    </td>
  </tr>
  <tr>
    <td><img src="images/list-checkmark.png" alt="" /><b>Baixar Arquivo:</b></td>
    <td><a href="../../artigos_secitifcedro/<?= $linha1["nomeurl"] ?>.docx"><?= $linha1["nomeurl"] ?>.docx</a></td>
  </tr>
  <tr>
    <td><img src="images/list-checkmark.png" alt="" /><b>Modalidade:</b></td>
    <td><?= $linha1["nome_mod"] ?></td>
  </tr>
    <tr>
    <td><img src="images/list-checkmark.png" alt="" /><b>Nota 1:</b></td>
    <td>
    <?php
	$parte_botao = "<input type=\"button\" class=\"bt-avalia\" value=\"Avaliar Agora!\"";
	if($linha1["nota1"]==null)
	{
	echo "Nao avaliado!";
	$forms = "document.getElementById('form_avaliacao". $cont ."').style.display";
	echo $parte_botao . " onclick=\"". $forms ."=='none'?". $forms ."='block':". $forms ."='none';\" />";
	}
	else
	{
		echo $linha1["nota1"];
	}
	?>
    </td>
  </tr>
  <?php
  if($linha1["prof_avaliador"] != null)
  {
  ?>
  <tr>
    <td><img src="images/list-checkmark.png" alt="" /><b>Prof. Avaliador:</b></td>
    <td><?= $linha1["prof_avaliador"] ?></td>
  </tr>
  <?php
  }
  if($linha1["nota1"]!=null)
  {
  ?>
  <tr>
    <td><img src="images/list-checkmark.png" alt="" /><b>ARTIGO MODIFICADO:</b></td>
    <td>
	<?php
		if($linha1["situacao"]=="N") echo "Artigo modificado enviado!";
		else if($linha1["situacao"]=="M") echo "Aguardando Modificação!";
		else echo "Não!";
    ?>
    </td>
  </tr>
  <tr>
    <td><img src="images/list-checkmark.png" alt="" /><b>Nota 2:</b></td>
    <td>
    <?php		
	if($linha1["nota2"]==null)
	{
		echo "Nao avaliado!";
		$forms = "document.getElementById('form_avaliacao". $cont ."').style.display";
		echo $parte_botao . " onclick=\"". $forms ."=='none'?". $forms ."='block':". $forms ."='none';\" />";
	}
	else
	{
		echo $linha1["nota2"];
	}
	?>
    </td>
  </tr>
  <?php
  }
  ?>  
</table>
<div class="form_avaliacao" id="form_avaliacao<?= $cont ?>" style="display:none;">
<img src="images/Knob Valid Green.png" alt="" /><h2 class="avaliacao">  Avaliação</h2>
<form name="form<?= $cont ?>" method="post" action="cadastro_notas.php">
<input type="hidden" name="codigo" value="" />
<table width="50%" border="0" cellspacing="0" cellpadding="0" class="table1">
<?php
if($linha1["nota1"]==null)
{
?>
<tr>
<td><label>Professor:</label></td><td><input name="professor" type="text" /></td>
</tr>
<tr>
<td><label>Nota 1:</label></td><td><input name="nota_1" type="text" /></td>
</tr>
<tr>
<td></td><td>
<input name="alt" type="hidden" value="false" />
<input name="contalt" type="hidden" value="" />
<input name="codartigo" type="hidden" value="<?= $linha1["nomeurl"] ?>" />
<input name="anchora" value="<?= $cont ?>" type="hidden" />
<input type="button" value="Requerer Alteração" class="bt-avalia" onclick="requereAlt(document.form<?= $cont ?>)"></td>
<td><input type="submit" value="Publicar"></td>
</tr>
<?php
}
else
{
?>
<tr>
<td>
<input name="codartigo" type="hidden" value="<?= $linha1["nomeurl"] ?>" />
<label>Nota 2:</label></td><td><input name="nota_2" type="text" /></td>
</tr>
<tr>
<td></td><td><input type="submit" value="Publicar"></td>
</tr>
<?php
}
?>
</table>
</form>
<!--Fim Table Avaliação-->

</div>
<div class="linha"></div>
<?php
	}
?>
</div><!-- Fim Box Content Container-->

<div id="clear">
</div>
<!--Clear-->

<!--Rodapé-->
<div id="footer">
    <div class="footer_copyright">
		<p>Copyright © 2012 - I Semana de Ciências e Tecnologia do IFCE Campus Cedro.</p>
	</div>
	<div class="footer_desenvolvedores">
	    <p>Desenvolvedores: José Ailton / Antonio Xavier</p>
	</div>
</div>
	
</div>
<!--Fim Box-->
<div id="shadow">
</div>

</body>
</html>
<?php
}
else {
	echo "Restrito!";
	header("Location: index.php");
}
?>