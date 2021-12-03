<?php
require_once('Connections/link1.php');
if (!isset($_SESSION)) {
  session_start();
}
$sql1 = "UPDATE usuarios SET nome = '". strtoupper($_POST["nome"]) ."',sobrenome='". strtoupper($_POST["sobrenome"]) ."' WHERE email = '". $_SESSION['MM_Username'] ."'";
$busca1 = mysql_query($sql1,$link1);
header("Location: emite_cert.php");
?>