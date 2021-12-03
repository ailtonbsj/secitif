<?php require_once('Connections/link1.php'); ?>
<?php

if (isset($_GET["sendmail"])) {
  echo "<script>alert(\"Uma mensagem foi enviada para o seu email!!!\");</script>";
}
if (isset($_GET["status"])) {
  if ($_GET["status"] == 1) echo "<script>alert('Login ou senha incorreto!!!');</script>";
}
if (!function_exists("GetSQLValueString")) {
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
  {
    if (PHP_VERSION < 6) {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
      case "text":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "long":
      case "int":
        $theValue = ($theValue != "") ? intval($theValue) : "NULL";
        break;
      case "double":
        $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
        break;
      case "date":
        $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
        break;
      case "defined":
        $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
  }
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['login'])) {
  $loginUsername = $_POST['login'];
  $password = $_POST['senha'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "seletor.php";
  $MM_redirectLoginFailed = "index.php?status=1";
  $MM_redirecttoReferrer = false;

  $LoginRS__query = sprintf(
    "SELECT email, senha FROM usuarios WHERE email=%s AND senha=%s",
    GetSQLValueString($loginUsername, "text"),
    GetSQLValueString($password, "text")
  );

  $LoginRS = mysql_query($LoginRS__query, $link1) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    $loginStrGroup = "";

    if (PHP_VERSION >= 5.1) {
      session_regenerate_id(true);
    } else {
      session_regenerate_id();
    }
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
    }
    header("Location: " . $MM_redirectLoginSuccess);
  } else {
    header("Location: " . $MM_redirectLoginFailed);
  }
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
  <title>I Semana de Ciencias e Tecnologia do IFCE Campus Cedro (SECITIF-Cedro)</title>
  <!-- InstanceEndEditable -->
  <!-- InstanceBeginEditable name="head" -->
  <style type="text/css">
    #banner1 {
      background-color: #900;
      width: 689px;
      height: 179px;
    }

    #banner2 {
      background-color: #999;
      width: 689px;
      height: 179px;
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
      <!-- INICIO FACE BOOK -->
      <div id="fb-root"></div>
      <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s);
          js.id = id;
          js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>
      <!-- FIM FACE BOOK -->
      <div id="banner-login">
        <div id="banner-top">
          <div id="banner1">
            <div id="banner2"></div>
          </div>
        </div>
        <form action="<?php echo $loginFormAction; ?>" name="login" id="login" method="POST">
          <legend>Sistema SECITIF-Cedro</legend>
          <label><span>Login</span>
            <input type="text" name="login" id="textfield" class="entrada" value="demo@local" /></label>
          <label><span>Senha</span>
            <input type="password" name="senha" class="entrada" id="textfield2" value="demo" /></label>
          <input type="submit" name="Submit" id="button" value="    Entrar     " /><a href="recupera.php">Esqueceu a Senha?</a><a href="inscricao.php">Cadastre-se aqui!</a>
        </form>
      </div>
      <div id="quatro-logo">
        <ul>
          <li><a href="femeci.php"><img src="images/bt_femeci.gif" width="228" height="157" /></a></li>
          <li><a href="matematica.php"><img src="images/bt_math.gif" width="227" height="157" /></a></li>
          <li><a href="simposio.php"><img src="images/bt_simposio.gif" width="227" height="157" /></a></li>
          <li><a href="competicoes.php"><img src="images/bt_competicoes.gif" width="227" height="157" /></a></li>
        </ul>
      </div>
      <div id="sobre">
        <div id="sobre_evt">
          <h1>Sobre o Evento</h1>
          <p>A I SECITIF é uma iniciativa conjunta das coordenações dos cursos Superiores em Tecnologia Mecatrônica Industrial e Licenciatura em Matemática e das coordenações dos cursos Técnicos em Eletrotécnica, Mecânica e Informática visando propiciar um ambiente de integração de conhecimento e fomentar, através das interações sociais, as práticas acadêmicas norteadas pelo tripé Ensino-Pesquisa-Extensão.</p>
          <p>O IFCE - Campus Cedro já era palco de dois grandes eventos científicos do interior do estado, a FEMECI que se encaminha para sua 6ª edição e o Encontro da Matemática que se encaminha para sua 7ª edição. Tendo em vista o grande alcance destes eventos, resolveu-se congregá-los em uma mesma semana e integrá-los com o I Simpósio Técnico do IFCE – Campus Cedro que tem a intenção de fomentar a pesquisa científica através da exposição e apresentação de artigos científicos que serão avaliados e julgados por uma comissão altamente qualificada.</p>
          <span class="link_estilo1"><a href="evento.php">Leia mais [+]</a></span>
        </div>
        <!-- INICIO FACEBOOK -->
        <div class="fb-like-box" data-href="http://www.facebook.com/secitifcedro" data-width="309" data-show-faces="true" data-stream="false" data-header="true"></div>
        <!-- FIM FACEBOOK -->
      </div>
      <script type="text/javascript" src="banner_rotativo.js"></script>
      <div style="clear: both;"></div>
      <div style="margin-top: 5px;">
        <h1>Cronograma de Palestras</h1>
        <table width="900" border="1" cellpadding="0" cellspacing="0" style="margin: 0 auto 0 auto;">
          <tr>
            <td width="351" bgcolor="#666666">Nome</td>
            <td width="202" bgcolor="#666666">Professor</td>
            <td width="339" bgcolor="#666666">Dia/Local</td>
          </tr>
          <?php
          $sql1 = "SELECT * FROM minicursos WHERE evento='P'";
          $busca1 = mysql_query($sql1, $link1) or die(mysql_error());
          while ($linha1 = mysql_fetch_assoc($busca1)) {
          ?>
            <tr>
              <td><?= $linha1["titulo"] ?></td>
              <td>
                <?php
                $sql2 = "SELECT * FROM minicursos_professores,professores WHERE minicursos_professores.email_professor=professores.email_professor AND cod_curso='" . $linha1["cod_curso"] . "'";
                $busca2 = mysql_query($sql2, $link1);
                while ($linha2 = mysql_fetch_assoc($busca2)) {
                  echo $linha2["nome"] . " ";
                }
                ?>
              </td>
              <td>
                <?php
                $sql3 = "SELECT * FROM datas,local WHERE datas.cod_local=local.cod_local AND cod_curso='" . $linha1["cod_curso"] . "'";
                $busca3 = mysql_query($sql3, $link1);
                $linha3 = mysql_fetch_assoc($busca3);
                switch ($linha3["dia"]) {
                  case 2:
                    echo "Segunda";
                    break;
                  case 3:
                    echo "Terca";
                    break;
                  case 4:
                    echo "Quarta";
                    break;
                  case 5:
                    echo "Quinta";
                    break;
                  case 6:
                    echo "Sexta";
                    break;
                }
                echo " (" . $linha3["hora_inicio"] . " - " . $linha3["hora_fim"] . ") " . $linha3["nome_local"];
                ?>
              </td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
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
  <style>
    .demopop {
      background-color: white;
      position: absolute;
      width: 450px;
      height: 430px;
      top: 10px;
      left: 10px;
      border: 2px solid #888;
      padding: 10px;
      border-radius: 9px;
    }
    .demopop h3 {
      margin-top: 10px;
      margin-bottom: 10px;
    }
    .demopop pre {
      margin-top: 10px;
    }
    .demopop > span {
      position: relative;
      float: right;
      font-weight: bolder;
      cursor: pointer;
    }
  </style>
  <div class="demopop">
    <span onclick="document.getElementsByClassName('demopop')[0].style.display = 'none';">[Fechar]</span>
    <h3>Demo</h3>
    Este sistema é somente uma demonstração do sistema construido em 2012. Use os usuários abaixo para fazer login.
    <pre>USUÁRIO1:  demo@local SENHA: demo
USUÁRIO2: demo2@local SENHA: demo
USUÁRIO3: demo3@local SENHA: demo
USUÁRIO4: demo4@local SENHA: demo</pre>
    <h3>Administração de minicursos:</h3>
    Acesse <a href="./admin/" target="_blank">/admin</a> e use o login abaixo:
    <pre>USUÁRIO1:  admin SENHA: qwe123</pre>
    <h3>Pagamento da I SECITIF:</h3>
    Acesse <a href="./admin_pag/" target="_blank">/admin_pag</a> e use o login abaixo:
    <pre>ADMIN1:  demo@local SENHA: demo
ADMIN2: demo2@local SENHA: demo</pre>
    <h3>Sistema de Avaliação de Artigos:</h3>
    Acesse <a href="./admin_prof/" target="_blank">/admin_prof</a> e use o login abaixo:
    <pre>USUÁRIO1:  admin SENHA: qwe123</pre>
  </div>
</body><!-- InstanceEnd -->

</html>