<?php
$saida_site = "http://localhost/secitifcedro";//http://www.cedro.ifce.edu.br
?>
<?php
 require_once('../Connections/link1.php');

 /*
 
 A - Aguardando
 M - Modificacao necessaria
 N - Modificado!
 V - Verificado
 P - Publicado
 
 */
 $ancora = $_POST["anchora"];
 $artigo = $_POST["codartigo"];
 $professor = $_POST["professor"];
 $nota1 = $_POST["nota_1"];
 $nota2 = $_POST["nota_2"];
 $alt = $_POST["alt"];
 $motivo =  $_POST["contalt"];
 if($alt == "true")
 	$situacao = "M";
 else if($alt == "false")
    $situacao = "V";
	if(isset($_POST["nota_1"]))
	{
 $sql1 = "UPDATE artigos SET situacao = '". $situacao ."', ultima_alteracao = '". date("Y-m-d") ."', nota1 = '". ($nota1-0) ."', prof_avaliador = '$professor' WHERE nomeurl = '$artigo';";
 $busca1 = mysql_query($sql1,$link1);
	}
	 //nota2
	if(isset($_POST["nota_2"]))
	{
 $sql3 = "UPDATE artigos SET ultima_alteracao = '". date("Y-m-d") ."', nota2 = '". ($nota2-0) ."' WHERE nomeurl = '$artigo';";
 $busca3 = mysql_query($sql3,$link1);
	}
	 //fim nota2
 if($alt == "true"){
 $origem = $_SERVER["DOCUMENT_ROOT"] . "/artigos_secitifcedro/". $artigo . ".docx";
 $destin = $_SERVER["DOCUMENT_ROOT"] . "/artigos_secitifcedro/bkp/". $artigo . ".docx";
 copy($origem,$destin);
 unlink($origem);
 }
 $sql2 = "SELECT artigos.*,usuarios.nome FROM artigos,usuarios WHERE artigos.email=usuarios.email AND nomeurl='$artigo'";
 $busca2 = mysql_query($sql2,$link1);
 $linha2 = mysql_fetch_assoc($busca2);
 //ancora$nome$mail$titulo$alt$motivo
 $meutok = $ancora ."$". $linha2["nome"] . "$". $linha2["email"] ."$". $linha2["titulo"] ."$". $alt ."$" . $motivo;
 $urls = $saida_site . "/sendmail_.php?data=" . base64_encode($meutok);
 $urls = "sys_prof.php"; //NAO ENVIA EMAIL
 header("Location:" . $urls);
?>