<?php
session_start();

 include "cabecalho/cabecalho.php";
 $msg_sucesso = @$_SESSION['msg_sucesso'];
 $msg_excessao = @$_SESSION['msg_excessao'];
 
  $id_assunto = @$_SESSION['id_assunto'];
  $id_usuario = @$_SESSION['id_usuario'];
  $id_status = @$_SESSION['id_status'];
   
 	require_once("class/conexao.php");
 //CONECTA AO MYSQL              
	$mysql = new Mysql();
	$mysql->conectar(); 
	
	@$p = $_GET["p"];
	if(isset($p)) {
	$p = $p;
	} else {
	$p = 1;
	}
	$qnt = 150;
	$inicio = ($p*$qnt) - $qnt;
	
	if ($id_assunto){
	$sql = mysql_query("SELECT * FROM ocorrencias, assuntos, usuarios WHERE ocorrencias.id_usuario = usuarios.id_usuario AND ocorrencias.id_assunto = assuntos.id_assunto AND ocorrencias.id_assunto = ".$id_assunto." ORDER BY dt_relato, hr_relato DESC LIMIT $inicio, $qnt");
	} else if ($id_status == 1) {
	$sql = mysql_query("SELECT * FROM ocorrencias, assuntos, usuarios WHERE ocorrencias.id_usuario = usuarios.id_usuario AND ocorrencias.id_assunto = assuntos.id_assunto ORDER BY dt_relato, hr_relato DESC LIMIT $inicio, $qnt");
	} else {
	$sql = mysql_query("SELECT * FROM ocorrencias, assuntos, usuarios WHERE ocorrencias.id_usuario = usuarios.id_usuario AND ocorrencias.id_assunto = assuntos.id_assunto AND usuarios.id_usuario = ".$id_usuario." ORDER BY dt_relato, hr_relato DESC LIMIT $inicio, $qnt");
	}
	@$row = mysql_num_rows($sql);
 
$login_paratinga = @$_SESSION['login_paratinga'];
   
 if ($login_paratinga){
?>
<html>
<head>
<title><?php echo $titulo;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function caixas(){
	//document.getElementById('dt_ini').focus();
	document.formulario.nm_filho.focus();
}
function executar(delUrl) { 
    document.location = delUrl; 
}

/*function alteraMaiusculo(){
	var valor = document.getElementById("campo").nm_macom;
	var novoTexto = valor.value.toUpperCase();
	valor.value = novoTexto;
	}*/
function del(delUrl) {
  if (confirm("Deseja excluir?")) {
    document.location = delUrl;
  }
}
function move_i(what) { what.style.background='#CCCCCC'; }
function move_o(what) { what.style.background='#F5F5F5'; }
</script>
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<link rel="SHORTCUT ICON" href="<?php echo $icon;?>"/>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="formulario" id="campo" method="post" action="controller.php" onSubmit="valida_dados(this)">
<?php if ( $row ) {?>
  <table width="43%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="32" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="32" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="32" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="32" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="32" class="labelEsquerda"> 
        <?php
  if ($msg_sucesso){
   echo "<div align='left'>
   <img src='img/msg_azul.png' width='20' height='20'><font color='#0099CC' size='2' face='Arial, Helvetica, sans-serif'> $msg_sucesso </font></div>";
     } else if ($msg_excessao){
	   echo "<div align='left'>
   <img src='img/msg_vermelha.gif' width='20' height='20'><font color='#FF0000' size='2' face='Arial, Helvetica, sans-serif'> $msg_excessao </font></div>";
	 }	
   ?>
      </td>
    </tr>
    <tr> 
      <td colspan="32" class="labelEsquerda"> </td>
    </tr>
    <tr> 
      <td colspan="32" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="32" class="labelEsquerda"> </td>
    </tr>
    <tr> 
      <td colspan="32" class="labelCentro"><strong>Consulta - Ocorr&ecirc;ncias</strong></td>
    </tr>
    <tr> 
      <td colspan="32" class="labelDireita">&nbsp; </td>
    </tr>
    <tr bgcolor="#999999"> 
      <td width="17%" class="labelEsquerda"><font color="#FFFFFF"><strong>Assunto</strong></font></td>
      <td width="28%" class="labelEsquerda"><font color="#FFFFFF">&nbsp;<strong>Signat&aacute;rio</strong></font></td>
      <td width="11%" class="labelEsquerda"><font color="#FFFFFF"><strong>Data</strong></font></td>
      <td width="6%" class="labelEsquerda"><font color="#FFFFFF"><strong>Hora</strong></font></td>
      <td width="8%" class="labelCentro"><font color="#FFFFFF"><strong>Status</strong></font></td>
      <td width="8%" class="labelCentro"><font color="#FFFFFF"><strong>Relato</strong></font></td>
      <td width="7%" class="labelCentro"><font color="#FFFFFF"><strong>Arquivo</strong></font></td>
      <td width="7%" class="labelCentro"><font color="#FFFFFF"><strong>Editar</strong></font></td>
      <td width="8%" class="labelCentro"><font color="#FFFFFF"><strong>Excluir</strong></font></td>
    </tr>
    <?php
	
	for ($i=0;$i < $row ; $i++){
	$id_ocorrencia = mysql_result($sql, $i, "id_ocorrencia");
	$nm_assunto = mysql_result($sql, $i, "nm_assunto");
	$st_relato = mysql_result($sql, $i, "st_relato");
	//$st_relato == 2 ? $status = "<img src='img/clock_amarelo.png' width='10' height='10'>" : $status = "";  
	//$st_relato == 1 ? $status = "<img src='img/clock.png' width='10' height='10'>" : $status = "";  
	$dt_relato = mysql_result($sql, $i, "dt_relato");
	$dt_relato = substr($dt_relato,8,2)."/".substr($dt_relato,5,2)."/".substr($dt_relato,0,4);
	$hr_relato = mysql_result($sql, $i, "hr_relato");
	$nm_usuario = mysql_result($sql, $i, "nm_usuario");
	$te_imagem = mysql_result($sql, $i, "te_imagem");
	$te_imagem = substr($te_imagem,14);
	$te_imagem != "" ? $image = "<a href='arquivos/$te_imagem'><img src='img/lupa.gif' width='10' height='10'></a>" : $image = "";  
	if ($st_relato == 2){
	$status = "<img src='img/sucesso.png' width='10' height='10'>";
	} else if ($st_relato == 1){
	$status = "<img src='img/clock_amarelo.png' width='10' height='10'>";
	} else {
	$status = "<img src='img/bomb.png' width='10' height='10'>";
	}
		
	?>
    <tr onMouseOver="move_i(this)" onMouseOut="move_o(this)" title=""> 
      <td class="labelEsquerda"><?php echo $nm_assunto;?></td>
      <td class="labelEsquerda"><?php echo $nm_usuario;?></td>
      <td class="labelEsquerda"><?php echo $dt_relato;?></td>
      <td class="labelEsquerda"><?php echo $hr_relato;?></td>
      <td class="labelCentro"><?php echo $status;?></td>
      <td class="labelCentro"><a href="controller/ocorrencia_controller.php?imprimirOcorrenciaRelato=imprimirOcorrenciaRelato&id_ocorrencia=<?php echo $id_ocorrencia;?>&opcao=2"><img src="img/lupa.gif" width="10" height="10"></a></td>
      <td class="labelCentro"><?php echo $image;?></td>
      <td class="labelCentro"><a href="controller/ocorrencia_controller.php?abrirOcorrenciaEdit=abrirOcorrenciaEdit&id_ocorrencia=<?php echo $id_ocorrencia;?>&opcao=2"><img src="img/insert.gif" width="10" height="10"></a></td>
      <td class="labelCentro"><a href="javascript:del('controller/ocorrencia_controller.php?excluirOcorrencia=excluirOcorrencia&id_ocorrencia=<?php echo $id_ocorrencia;?>&opcao=2&te_imagem=<?php echo $te_imagem;?>')"><img src="img/excluir2.gif" width="10" height="10"></a></td>
    </tr>
    <?php }?>
    <tr> 
      <td colspan="32" class="labelEsquerda"><hr></td>
    </tr>
    <tr> 
      <td colspan="12" class="labelEsquerda">Itens:<?php echo $i;?></td>
    </tr>
    <tr> 
      <td colspan="32" class="labelCentro"><input name="imprime" type="button" id="imprime" value="Imprimir" onClick="javascript:executar('controller/ocorrencia_controller.php?imprimirOcorrenciaLista=imprimirOcorrenciaLista')" /> 
        <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:executar('controller/cancela_controller.php?cancelarOperacao=cancelarOperacao')" /> 
      </td>
      <?php } else {?>
    <tr> 
      <td colspan="32"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Relatório 
          vazio!!!</font></div></td>
    </tr>
    <?php }?>
    <tr> 
      <td colspan="32">&nbsp;</tr>
  </table>
</form> 
<p align="center" class="labelCentro">
  <?php // include("paginacao_alunos.php");?>
</p>
</body>

<?php

} else {
 
 }
 ?>
</html>
