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

$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(100, 37);
$texto = "RELATOS";
$pdf->Cell(0,0.5,$texto, 4, 'J');

// 1A LINHA HORIZONTAL
$pdf->SetXY(20,45);
$pdf->Cell(0,0,'',1,1,'L');
 
 $id_usuario = @$_SESSION['id_usuario'];
 $id_status = @$_SESSION['id_status'];
 
	 if ( $id_status == 1 ){
	$sql = mysql_query("SELECT * FROM ocorrencias, assuntos, usuarios WHERE ocorrencias.id_assunto = assuntos.id_assunto AND ocorrencias.id_usuario = usuarios.id_usuario ORDER BY nm_assunto ");	
	} else {
	$sql = mysql_query("SELECT * FROM ocorrencias, assuntos, usuarios WHERE ocorrencias.id_assunto = assuntos.id_assunto AND ocorrencias.id_usuario = usuarios.id_usuario AND usuarios.id_usuario = ".$id_usuario." ORDER BY nm_assunto ");
	}

	@$row = mysql_num_rows($sql);

$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(20, 40);
$pdf->Cell(40,5,'OR');
$pdf->SetXY(27, 40);
$pdf->Cell(40,5,'ASSUNTO');
$pdf->SetXY(55, 40);
$pdf->Cell(40,5,'SIGNATÁRIO');
$pdf->SetXY(105, 40);
$pdf->Cell(40,5,'DATA');
$pdf->SetXY(120, 40);
$pdf->Cell(40,5,'HORA');
$pdf->SetXY(133, 40);
$pdf->Cell(40,5,'STATUS');


$j = 1;
while ( $vetor = mysql_fetch_array($sql) ){
$dt_relato = substr($vetor['dt_relato'],8,2)."/".substr($vetor['dt_relato'],5,2)."/".substr($vetor['dt_relato'],0,4);
$dt_relato == "00/00/0000" ? $dt_relato = "" : $dt_relato = $dt_relato;
$vetor['id_sexo'] == 1 ? $nm_sexo = "M" : $nm_sexo = "F";
//$vetor['st_relato'] == 1 ? $st_relato = "ANALISADO/RESOLVIDO" : $st_relato = "";
switch ($vetor['st_relato']){
case 2;
$st_relato = "Resolvido";
break;
case 1;
$st_relato = "Análise";
break;
case 0;
$st_relato = "Pendente";
break;
}

$pdf->Ln();
$pdf->SetX(20);
$pdf->Cell(0,5,$j);
$pdf->SetX(27);
$pdf->Cell(0,5,$vetor['nm_assunto']);
$pdf->SetX(55);
$pdf->Cell(0,5,$vetor['nm_usuario']);
$pdf->SetX(105);
$pdf->Cell(0,5,$dt_relato);
$pdf->SetX(120);
$pdf->Cell(0,5,$vetor['hr_relato']);
$pdf->SetX(133);
$pdf->Cell(0,5,$st_relato);



$j = $j + 1;
}



$pdf->Output();
?>