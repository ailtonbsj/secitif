<?php
require_once('../Connections/link1.php');
session_start();
if(isset($_POST["login"]))
{
	$sql1 = "SELECT usuarios_pagos_admin.email AS mail,usuarios.* FROM usuarios_pagos_admin,usuarios WHERE usuarios_pagos_admin.email=usuarios.email AND usuarios_pagos_admin.email='". $_POST["login"] ."' AND senha='". $_POST["senha"] ."'";
	$busca1 = mysql_query($sql1,$link1);
	$linha1 = mysql_fetch_assoc($busca1);
	$regs = mysql_num_rows($busca1);
	if($regs==1)
	{
		$_SESSION["usuario"]=$linha1["mail"];
		$_SESSION["nome"] = $linha1["nome"];
		$_SESSION["sobrenome"] = $linha1["sobrenome"];
		if($_POST["syst"]=="M")
		header("Location: sys_pag.php");
		else if($_POST["syst"]=="C")
		header("Location: sys_pag_comp.php");
	}
	else
	{
		session_destroy();
		header("Location: index.php?status=1");
	}
}
if(isset($_GET["logoff"]))
{
	session_destroy();
	header("Location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SysPagMinicursos</title>
</head>

<body>
<h1 align="center">Sistema de Pagamento  da I SECITIF</h1>
<form id="box_login" name="box_login" method="post" action="index.php" >
<?php
if(isset($_GET["status"]))
{
	echo "<div style=\"text-align: center; color: #F00; font-weight:bold;\">Usuário ou senha Incorreta!</div>";
}
?>
  <table width="100" border="0" align="center" cellpadding="5" cellspacing="0" style="background-color:#999999" >
    <tr>
      <td>Login</td>
      <td><input type="text" name="login" id="login" /></td>
    </tr>
    <tr>
      <td>Senha</td>
      <td><input type="password" name="senha" id="senha" /></td>
    </tr>
    <tr>
      <td>Sistema</td>
      <td><input name="syst" type="radio" id="radio" value="M" checked="checked"  /> Minicursos<br />
      <input type="radio" name="syst" id="radio2" value="C" /> Competições</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="Entrar" /></td>
    </tr>
  </table>
</form>
</body>
</html>