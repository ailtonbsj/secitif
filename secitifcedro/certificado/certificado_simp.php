<?php
@require_once('../Connections/link1.php');
if(!isset($_SESSION)) 
{ 
session_start(); 
}
mysql_set_charset('utf8',$link1);
$sql1 = "SELECT * FROM artigos WHERE nomeurl='" . $_GET['cod'] . "'"; 
$busca1 = mysql_query($sql1,$link1);
$linha1 = mysql_fetch_assoc($busca1);

$sql2 = "SELECT * FROM autores WHERE cod_artigo='". $_GET['cod'] ."'";
$busca2 = mysql_query($sql2,$link1);

$sql3 = "SELECT * FROM `usuarios` WHERE email='". $_SESSION["MM_Username"] ."'";
$busca3 = mysql_query($sql3,$link1);
$linha3 = mysql_fetch_assoc($busca3);

require_once("tfpdf/tfpdf.php");
define('FPDF_FONTPATH','tfpdf/font/');
$pdf= new tFPDF("L","mm","A4");
// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',18);

$pdf->SetTitle("Certificado");
$pdf->SetSubject("Certificado I Secitif 2012");
$pdf->SetY("-1"); 
$pdf->Cell(0,5,"",0,0,'L');
$pdf->Image("bg_simposio.jpg", 0,0,297,210);
$texto_simp = "Certificamos que o artigo: ". strtoupper($linha1["titulo"]) ." dos autores ";
while($linha2 = mysql_fetch_assoc($busca2))
{
	$texto_simp .= strtoupper($linha2["nome_autor"]) . ", ";
}
$media = ((4*$linha1["nota1"])+$linha1["nota2"])/5;
$texto_simp .= "foi publicado no 1º Simpósio Técnico do IFCE-Cedro nos dias 20, 21 e 22 de novembro de 2012, tendo sido apresentado por: ". strtoupper($linha3["nome"]) . " " . strtoupper($linha3["sobrenome"]) .".\n\nO conceito final do Artigo foi: ". $media;
$pdf->setXY(10,73);
$pdf->Multicell(277,95,'',1,'J',false);
$pdf->setXY(15,78);
$pdf->setMargins(15,78,13);
//$pdf->SetFont('arial','',14);
$pdf->Write(13,$texto_simp);
$pdf->Output("certificado","I");
 ?>