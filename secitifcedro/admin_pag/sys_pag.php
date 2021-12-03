<?php
session_start();
if(isset($_SESSION["usuario"]))
{
	require_once('../Connections/link1.php');
	if(isset($_POST["email_conf"]))
	{
		$sql3 = "INSERT INTO usuarios_pagos VALUES ('". $_POST["email_conf"] ."', '". $_SESSION["usuario"] ."','T','". date("Y-m-d H:i:s") ."');";
		$busca3 = mysql_query($sql3, $link1);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div style="height:30px;">
<a href="index.php?logoff=true" style="float:right; background-color: #CCC; margin: 0px; padding: 5px;"><?= $_SESSION["nome"] ?>  <?= $_SESSION["sobrenome"] ?>  (<?= $_SESSION["usuario"] ?>) Clique aqui para fazer Log-Off [X]</a>
</div>
<h2 align="center">Usuários Pagos dos Minicursos</h2>
<table width="900" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#999999">
    <td align="center">E-mail</td>
    <td>Nome Completo</td>
    <td>Endereço</td>
    <td align="center">Cidade</td>
    <td align="center">Celular</td>
    <td align="center">Data de Nascimento</td>
    <td align="center">Data de Liberacao</td>
    <td align="center">Liberador</td>
  </tr>
  <?php
  $sql1 = "SELECT usuarios.email,nome,sobrenome,endereco,bairro,cidade,uf,celular,d_nascimento,usuarios_pagos.liberador,data_lib FROM usuarios,usuarios_pagos WHERE usuarios.email=usuarios_pagos.email";
  $busca1 = mysql_query($sql1,$link1);
  if(mysql_num_rows($busca1)!=0)
  {
  	while($linha1 = mysql_fetch_assoc($busca1))
  	{
  ?>
  <tr>
    <td align="center"><?php echo $linha1["email"] ?></td>
    <td><?php echo $linha1["nome"] . " " . $linha1["sobrenome"] ?></td>
    <td><?php echo $linha1["bairro"] . ", " . $linha1["endereco"] ?></td>
    <td align="center"><?php echo $linha1["cidade"] . " - " . $linha1["uf"] ?></td>
    <td align="center"><?php echo $linha1["celular"] ?></td>
    <td align="center"><?php echo $linha1["d_nascimento"] ?></td>
    <td align="center"><?php echo $linha1["data_lib"] ?></td>
    <td align="center"><?php echo $linha1["liberador"] ?></td>
  </tr>
  <?php
  	}
	echo "<tr><td>Total: </td><td colspan=\"7\"> ". mysql_num_rows($busca1) . " (R$ ". mysql_num_rows($busca1)*5 .",00)" ."</td></tr>";
  }
  else
  {
	  echo "<tr><td colspan=\"7\">Nenhum Registro!</td></tr>";
  }
  ?>
</table>
<h2 align="center">Confirmar pagamento de Usuário</h2>
<table width="400" border="1" align="center" cellpadding="3" cellspacing="0">
  <tr bgcolor="#999999">
    <td>Buscar Usuário por E-mail</td>
  </tr>
  <tr>
    <td><form id="query_mail" name="query_mail" method="get" action="sys_pag.php">
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
	$sql2 = "SELECT * FROM usuarios WHERE email='". $_GET["email_query"] ."'";
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
		$linha2 = mysql_fetch_assoc($busca2);
?>
<form action="sys_pag.php" method="post" id="confirmador" name="confirmador">
<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#999999">
    <td>E-mail</td>
    <td>Nome Completo</td>
    <td>Endereço</td>
    <td>Cidade</td>
    <td>Celular</td>
    <td>Data de Nascimento</td>
    <td>Liberador</td>
  </tr>
  <tr>
    <td><?php echo $linha2["email"] ?></td>
    <td><?php echo $linha2["nome"] . " " . $linha2["sobrenome"] ?></td>
    <td><?php echo $linha2["bairro"] . ", " . $linha2["endereco"] ?></td>
    <td><?php echo $linha2["cidade"] . " - " . $linha2["uf"] ?></td>
    <td><?php echo $linha2["celular"] ?></td>
    <td><?php echo $linha2["d_nascimento"] ?></td>
    <td><?= $_SESSION["usuario"] ?>
      <input type="hidden" name="email_conf" id="email_conf" value="<?= $linha2["email"] ?>" /></td>
  </tr>
  <tr>
    <td colspan="7" align="center">
    <input type="submit" name="button2" id="button2" value="Confirmar Pagamento!" /> 
    <input type="button" name="button3" id="button3" value="Limpar Busca" onclick="location.href='sys_pag.php';" />
     </td>
  </tr>
 </table>
 </form>
<script type="text/javascript">
function validaForm()
{
	if(confirm("Tem certeza que o usuário pagou????"))
		return true;
	else
		return false;
}
document.confirmador.onsubmit = validaForm;
</script>
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