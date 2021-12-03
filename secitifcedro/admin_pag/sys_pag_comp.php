<?php
session_start();
if(isset($_SESSION["usuario"]))
{
	require_once('../Connections/link1.php');
	if(isset($_POST["cod_equip_pag"]))
	{
		if($_POST["cod_equip_pag"])
		{
			$sql3 = "UPDATE equipes SET pago = 'T', liberador = '". $_SESSION["usuario"] ."', data_lib = '". date("Y-m-d H:i:s") ."' WHERE cod_equipe = '". $_POST["cod_equip_pag"] ."'";
			mysql_query("$sql3",$link1);
			$alert = true;
		}
		else
		{
			$alert = false;
		}
	}
	
	$sql1 = "SELECT usuarios.nome,usuarios.sobrenome,usuarios.endereco,usuarios.cidade,usuarios.uf,usuarios.celular,usuarios.d_nascimento,equipes.*,equipes_usuarios.email_usu FROM equipes,equipes_usuarios,usuarios WHERE status='L' AND equipes.cod_equipe=equipes_usuarios.cod_equipe AND usuarios.email=email_usu AND pago='T'";
	$busca1 = mysql_query($sql1,$link1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sys_pag-comp</title>
</head>
<body>
<div style="height:30px;">
<a href="index.php?logoff=true" style="float:right; background-color: #CCC; margin: 0px; padding: 5px;"><?= $_SESSION["nome"] ?>  <?= $_SESSION["sobrenome"] ?>  (<?= $_SESSION["usuario"] ?>) Clique aqui para fazer Log-Off [X]</a>
</div>
<h1 align="center">Equipes com pagamento confirmado das Competições</h1>
<table width="1000" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#999999">
    <td>E-mail</td>
    <td>Nome Completo</td>
    <td>Endereço</td>
    <td align="center">Cidade</td>
    <td align="center">Celular</td>
    <td align="center">Data de Nascimento</td>
    <td align="center">Nome da Equipe</td>
    <td align="center">Competição</td>
    <td align="center">Liberador</td>
    <td align="center">Data de Liberacao</td>
  </tr>
  <?php
  if(isset($alert)) if($alert) echo "<script>Confirmado com Sucesso!!!</script>";
  while($linha1 = mysql_fetch_assoc($busca1))
  {
  ?>
  <tr>
    <td><?= $linha1["email_usu"] ?></td>
    <td><?= $linha1["nome"] ?> <?= $linha1["sobrenome"] ?></td>
    <td><?= $linha1["endereco"] ?></td>
    <td align="center"><?= $linha1["cidade"] ?> - <?= $linha1["uf"] ?></td>
    <td align="center"><?= $linha1["celular"] ?></td>
    <td align="center"><?= $linha1["d_nascimento"] ?></td>
    <td align="center"><?= $linha1["nome_equipe"] ?></td>
    <td align="center">
    <?php
    	switch($linha1["compet"])
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
    </td>
    <td align="center"><?= $linha1["liberador"] ?></td>
    <td align="center"><?= $linha1["data_lib"] ?></td>
  </tr>
  <?php
  }
  ?>
</table>
<h2 align="center">Confirmar pagamento de Usuário</h2>
<table width="400" border="1" align="center" cellpadding="3" cellspacing="0">
  <tr bgcolor="#999999">
    <td>Buscar Usuário por E-mail</td>
  </tr>
  <tr>
    <td><form id="query_mail" name="query_mail" method="get" action="sys_pag_comp.php">
      E-mail 
      <input type="text" name="email_query" id="email_query" style="width: 250px;" />
      <input type="submit" name="button" id="button" value="Buscar" />
    </form></td>
  </tr>
</table>
<br />
<?php
if(isset($_GET["email_query"]))
{
	$sql2 = "SELECT usuarios.nome,usuarios.sobrenome,usuarios.endereco,usuarios.cidade,usuarios.uf,usuarios.celular,usuarios.d_nascimento,equipes.*,equipes_usuarios.email_usu FROM equipes,equipes_usuarios,usuarios WHERE status='L' AND equipes.cod_equipe=equipes_usuarios.cod_equipe AND usuarios.email=email_usu AND pago='F' AND email_usu='". $_GET["email_query"] ."'";
	$busca2 = mysql_query($sql2,$link1);
	$erro1 = "<center>Nenhum Registro Encontrado! (Pode ser que o usuário não confirmou o e-mail, ou já pagou, ou o email digitado está incorreto).</center>";
	if(!$busca2)
	{
		echo $erro1;
	}
	else
	{
		if(mysql_num_rows($busca2)==0)
		{
			echo $erro1;
		}
		else
		{
?>
<table width="950" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#999999">
    <td>E-mail</td>
    <td>Nome Completo</td>
    <td>Endereço</td>
    <td align="center">Cidade</td>
    <td align="center">Celular</td>
    <td align="center">Data de Nascimento</td>
    <td align="center">Nome da Equipe</td>
    <td align="center">Competição</td>
    <td align="center">&nbsp;</td>
  </tr>
  <?php
  	$contcont  = 0;
  	while($linha2 = mysql_fetch_assoc($busca2))
	{
		$contcont++;
  ?>
  <tr>
    <td><?= $linha2["email_usu"] ?></td>
    <td><?= $linha2["nome"] ?> <?= $linha2["sobrenome"] ?></td>
    <td><?= $linha2["endereco"] ?></td>
    <td align="center"><?= $linha2["cidade"] ?> - <?= $linha2["uf"] ?></td>
    <td align="center"><?= $linha2["celular"] ?></td>
    <td align="center"><?= $linha2["d_nascimento"] ?></td>
    <td align="center"><?= $linha2["nome_equipe"] ?></td>
    <td align="center">
    <?php
    	switch($linha2["compet"])
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
    </td>
    <td align="center">
    <form name="form<?= $contcont ?>" method="post" action="sys_pag_comp.php?email_query=<?= $_GET["email_query"] ?>">
    <input type="hidden" name="cod_equip_pag" value="<?= $linha2["cod_equipe"] ?>" />
    <input type="submit" value="Confirmar!" />
    </form>
    <script type="text/javascript">
	function valida<?= $contcont ?>()
	{
		if(confirm("Tem certeza disso???")) return true;
		else return false;
	}
	document.form<?= $contcont ?>.onsubmit = valida<?= $contcont ?>;
	</script>
    </td>
  </tr>
  <tr>
  	<?php
		}
	?>
    <td colspan="9" align="center">
    <input type="button" name="button3" id="button3" value="Limpar Busca" onclick="location.href='sys_pag_comp.php';" />
     </td>
  </tr>
 </table>
 <?php
		}
	}
}
 ?>
</body>
</html>
<?php
}
else
{
	echo "pagina restrita!";
	header("Location: index.php");
}
?>