<?php
	session_start();
	if(isset($_GET["logoff"]))
	{
		session_destroy();
	}
	if(isset($_POST["usuario"]) && isset($_POST["senha"]))
	{
		if($_POST["usuario"]=="admin" && $_POST["senha"]=="qwe123")
		{
			$_SESSION["usuario"]="admin";
			header("Location: sys_prof.php");
		}
		else
		{
			echo "<script>alert('Usuario ou senha incorreta!');</script>";
			session_destroy();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Administrativo - I Simpósio Técnico do IFCE - Login</title>
<style type="text/css">
* {
	margin: 0px;
	padding: 0px;
}
body {
	background-image:url(images/bg-body.jpg);
}
#shadow {
	width: 270px;
	height: 9px;
	background: url(images/widget_title_breaker.png) no-repeat;
	margin: 0px auto 0px auto; 
}
#box_login {
	width: 350px;
	height: auto;
	margin: 150px auto 0px auto;
	border: 1px solid #CFCFCF;
	background-color: #F8F8FF;
}
#top_login {
	height: 115px;
	border-bottom: 1px solid #CFCFCF;
	background-image:-moz-linear-gradient(50% 0% -90deg,rgb(255,255,255) 0%,rgb(221,221,221) 100%);
	background-image:-webkit-gradient(linear,50% 0%,50% 100%,color-stop(0, rgb(255,255,255)),color-stop(1, rgb(221,221,221)));
	background-image:-webkit-linear-gradient(-90deg,rgb(255,255,255) 0%,rgb(221,221,221) 100%);
	background-image:-o-linear-gradient(-90deg,rgb(255,255,255) 0%,rgb(221,221,221) 100%);
	background-image:-ms-linear-gradient(-90deg,rgb(255,255,255) 0%,rgb(221,221,221) 100%);
	background-image:linear-gradient(-90deg,rgb(255,255,255) 0%,rgb(221,221,221) 100%);
	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffffffff,endColorstr=#ffdddddd,GradientType=0)";
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffffffff,endColorstr=#ffdddddd,GradientType=0);
}
#top_login img {
	width: 90px;
	height: 70px;
	margin: 10px 0px 0px 120px;
}
#top_login h3 {
	font-family:Verdana, Geneva, sans-serif;
	font-size: 18px;
	font-weight:normal;
	text-transform: uppercase;
	text-align: center;
	color: #999;
	padding: 5px 0px 0px 0px;
	text-shadow: 0px 1px 2px rgba(255,255,255,0.5);
}
.descricao {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	width: 300px;
	margin: 5px auto 0px auto;
	padding: 5px;
	color: #4F8A10;
	background-color: #DFF2BF;
	text-align: center;
	border: 1px solid #4F8A10;
	border-radius: 4px;	
}
#form {
	width: 300px;
	height: 130px;
	background-color: #E6E6FA;
	margin: 10px auto 10px auto;
	padding: 10px;
}
label {
	padding: 5px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 15px;
	text-shadow: 0px 1px 1px rgba(255,255,255,0.5);
	color: #555;
	margin-left: 20px;
}
input {
	border: 1px solid #ccc;
	margin: 5px;
	padding: 5px;
	font-size: 16px;
	color: #444;
}
input[type="submit"] {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 15px;
	display: block;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	padding: .5em 2em .55em;
	border-radius: 2px;
	border-width:1px;
	border-color:rgb(136,136,136);
	box-shadow: 0 1px 2px rgba(0,0,0,.2);
	font-size: 0.8em;
	margin-top: 10px;
	margin-left: 180px;
	color: #555;
	text-shadow: 0px 1px 1px rgba(255,255,255,0.5);
	wisth: 100px;
	outline: none;
	background-image:-moz-linear-gradient(50% 0% -90deg,rgb(221,221,221) 0%,rgb(170,170,170) 100%); 
	background-image:-webkit-gradient(linear,50% 0%,50% 100%,color-stop(0, rgb(221,221,221)),color-stop(1, rgb(170,170,170)));
	background-image:-webkit-linear-gradient(-90deg,rgb(221,221,221) 0%,rgb(170,170,170) 100%);
	background-image:-o-linear-gradient(-90deg,rgb(221,221,221) 0%,rgb(170,170,170) 100%);
	background-image:-ms-linear-gradient(-90deg,rgb(221,221,221) 0%,rgb(170,170,170) 100%);
	background-image:linear-gradient(-90deg,rgb(221,221,221) 0%,rgb(170,170,170) 100%);
	border-color:rgb(136,136,136);    
	-ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffdddddd,endColorstr=#ffaaaaaa,GradientType=0)";
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffdddddd,endColorstr=#ffaaaaaa,GradientType=0);
}
</style>
</head>

<body>
<div id="box_login">
	<div id="top_login">
    <img src="images/logo_admin.png" />
    <h3>IFCE Campus Cedro</h3>
    </div>
    <div class="descricao">Entrar no Sistema</div>
    <form name="login" id="form" method="post" action="index.php">
    <label>Nome:</label><input type="text" name="usuario" id="usuario" />
    <label>Senha:</label><input type="password" name="senha" id="senha" />
    <input type="submit" value="Entrar" /> 
    </form>
</div>
<div id="shadow">
</div>
</body>
</html>