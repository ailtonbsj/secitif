<?php
	session_start();
	if(isset($_GET["logoff"]))
	{
		session_destroy();
	}
	if(isset($_POST["usuario"]) && isset($_POST["senha"]))
	{
		if($_POST["usuario"] == "admin" && $_POST["senha"] == "qwe123")
		{
			$_SESSION["usuario"] = "admin";
			header("Location: system_cursos.php?option=listcurso");
		}
		else
		{
			echo "Usuário ou senha incorreta!";
			session_destroy();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<h1 align="center">Sistema de Administração de Minicursos</h1>
<form id="login" name="login" method="post" action="index.php">
  <table width="200" border="0" align="center" cellpadding="0" cellspacing="5">
    <tr>
      <td>Usuário</td>
      <td><input type="text" name="usuario" id="usuario" /></td>
    </tr>
    <tr>
      <td>Senha</td>
      <td><input type="password" name="senha" id="senha" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="reset" name="Reset" id="button" value="Reset" />
        <input type="submit" name="button2" id="button2" value="Entrar" /></td>
    </tr>
  </table>
</form>
</body>
</html>