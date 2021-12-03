<?php 
require_once('../Connections/link1.php');
if(!isset($_SESSION)) 
{ 
session_start(); 
}
$sql1 = "SELECT * FROM `usuarios` WHERE email='". $_SESSION["MM_Username"] ."'";
$busca1 = mysql_query($sql1,$link1);
$linha1 = mysql_fetch_assoc($busca1);
$sql2 = "SELECT titulo,evento FROM `minicursos` WHERE cod_curso='". $_GET["cod"] ."'";
$busca2 = mysql_query($sql2,$link1);
$linha2 = mysql_fetch_assoc($busca2);
$sql3 = "SELECT * FROM `datas` WHERE cod_curso='". $_GET["cod"] ."'";
$busca3 = mysql_query($sql3,$link1);
$nu_lin = mysql_num_rows($busca3);

require_once("tfpdf/tfpdf.php");
define('FPDF_FONTPATH','tfpdf/font/');
$pdf= new tFPDF("L","mm","A4");
// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',19);

$pdf->SetTitle("Certificado");
$pdf->SetSubject("Certificado I Secitif 2012");
$pdf->SetY("-1"); 
$pdf->Cell(0,5,"",0,0,'L');
if($linha2["evento"]=='F') $img1 = "bg_femeci.jpg";
else if($linha2["evento"]=='M') $img1 = "bg_encmat.jpg";
$pdf->Image($img1, 0,0,297,210);

if($linha2["evento"]=='F') $evts = "VII FEMECI I Feira da Mecatrônica Industrial";
else if($linha2["evento"]=='M') $evts = "VII Encontro da Matemática";
$texto = "Certificamos que ". strtoupper($linha1["nome"]) ." ". strtoupper($linha1["sobrenome"]) ." participou do $evts realizado no período de 19 a 23 de novembro de 2012 na oficina ". strtoupper($linha2["titulo"]) .", com carga horária de " . ($nu_lin*4) . " horas/aulas.";
$pdf->setXY(10,88);
$pdf->Multicell(277,70,'',1,'J',false);
$pdf->setXY(15,93);
$pdf->setMargins(15,93,13);
$pdf->Write(13,$texto);
$pdf->Output("certificado","I");
 ?>