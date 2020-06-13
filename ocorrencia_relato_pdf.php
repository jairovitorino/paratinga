<?php
session_start();

//CONECTA AO MYSQL              
require_once("class/conexao.php");
$mysql = new Mysql();
$mysql->conectar(); 


define("FPDF_FONTPATH","fpdf/font/");
require_once("fpdf/fpdf.php");
$pdf = new FPDF('P'); 
$pdf->Open(); 

$pdf->AddPage(); 

$pdf->Image('img/mansion.png',96,9,25,20);

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetXY(91, 33);
$texto = "CONDOMÍNIO PARTINGA";
$pdf->Cell(0,0.5,$texto, 4, 'J');

// 1A LINHA HORIZONTAL
$pdf->SetXY(20,45);
$pdf->Cell(0,0,'',1,1,'L');
 
 $id_ocorrencia = @$_SESSION['id_ocorrencia'];
 //$nm_bairro = @$_SESSION['nm_bairro'];
 //$nm_logra = @$_SESSION['nm_logra'];

	$sql = mysql_query("SELECT * FROM ocorrencias, assuntos, usuarios
	WHERE ocorrencias.id_assunto = assuntos.id_assunto
	AND ocorrencias.id_usuario = usuarios.id_usuario
	AND id_ocorrencia = ".$id_ocorrencia." ");
	$row = mysql_num_rows($sql);
	
$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(20, 40);
$pdf->Cell(40,5,'ASSUNTO');
$pdf->SetXY(40, 40);
$pdf->Cell(40,5,'SIGNATÁRIO');
$pdf->SetXY(75, 40);
$pdf->Cell(40,5,'DATA');
$pdf->SetXY(90, 40);
$pdf->Cell(40,5,'HORA');
$pdf->SetXY(100, 40);
$pdf->Cell(40,5,'RELATO');


$j = 1;
while ( $vetor = mysql_fetch_array($sql) ){
$dt_relato = substr($vetor['dt_relato'],8,2)."/".substr($vetor['dt_relato'],5,2)."/".substr($vetor['dt_relato'],0,4);
$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(0,5,$vetor['nm_assunto']);
$pdf->SetX(40);
$pdf->Cell(0,5,$vetor['nm_usuario']);
$pdf->SetX(75);
$pdf->Cell(0,5,$dt_relato);
$pdf->SetX(90);
$pdf->Cell(0,5,$vetor['hr_relato']);
$pdf->SetX(100);
$pdf->MultiCell(0,5,$vetor['te_relato']);



$j = $j + 1;
}



$pdf->Output();
?>