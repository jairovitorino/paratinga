<?php
session_start();

 include "cabecalho/cabecalho.php";
$nu_ano = date("Y");
$nu_mes = date("m");

 $login_paratinga = @$_SESSION['login_paratinga'];
   
 if ($login_paratinga){
//CONECTA AO MYSQL              
 	require_once("class/conexao.php");
	$mysql = new Mysql();
	$mysql->conectar(); 
	
	$nu_ano = date("Y");
	
	$assuntos = mysql_query("SELECT COUNT(ocorrencias.id_assunto) AS qt, nm_assunto, ocorrencias.id_assunto 
	FROM ocorrencias, assuntos
	WHERE ocorrencias.id_assunto = assuntos.id_assunto
	AND ocorrencias.nu_ano = ".$nu_ano."
	GROUP BY assuntos.nm_assunto ");
	$row_assunto = mysql_num_rows($assuntos);		
	
	$acessos = mysql_query("SELECT COUNT(logs.id_acao) AS qt, nm_acao, logs.id_acao 
	FROM logs, acoes
	WHERE logs.id_acao = acoes.id_acao
	AND logs.nu_ano = ".$nu_ano."
	GROUP BY logs.id_acao ");
	$row_acesso = mysql_num_rows($acessos);
	
	$signatarios = mysql_query("SELECT COUNT(usuarios.id_sexo) AS qt, usuarios.id_sexo, usuarios.id_usuario 
	FROM usuarios
	WHERE usuarios.id_usuario <> 40 
	OR usuarios.id_status = 2
	AND usuarios.id_status = 1
	GROUP BY usuarios.id_sexo ");
	$row_signatario = mysql_num_rows($signatarios);			
				
	
?>
<html>
<head>
<title><?php echo $titulo;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

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
<form name="formulario" id="formulario" method="post" action="">
<?php // if ( ($row_produtos) || ($row_recebimento) || ($row_estoque) ) {?>
  <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro"><strong>Painel</strong></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <?php if ( $row_acesso ) {?>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><strong>Moradores</strong></td>
    </tr>
    <?php 	
	for ( $e=0; $e < $row_signatario; $e++ ){
	$id_sexo = mysql_result($signatarios, $e, "id_sexo");
	$qt = mysql_result($signatarios, $e, "qt");	
	$id_usuario = mysql_result($signatarios, $e, "id_usuario");
	$id_sexo == 1 ? $nm_sexo = "Homem" : $nm_sexo = "Mulher";
	?>
    <tr onMouseOver="move_i(this)" onMouseOut="move_o(this)" title=""> 
      <td width="9%" class="labelEsquerda"><?php echo $nm_sexo;?></td>
      <td width="91%" class="labelEsquerda"><a href="controller/ocorrencia_controller.php?abrirOcorrenciaLista=abrirOcorrenciaLista&id_usuario=<?php echo $id_usuario;?>"><img src="img/quadro_blue.jpg" width="<?php echo $qt;?>" height="10"></a><?php echo $qt;?></td>
    </tr>
    <?php } ?>
	<tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><strong>Assuntos</strong></td>
    </tr>
    <?php 	
	for ( $e=0; $e < $row_assunto; $e++ ){
	$nm_assunto = mysql_result($assuntos, $e, "nm_assunto");
	$qt = mysql_result($assuntos, $e, "qt");
	$id_assunto = mysql_result($assuntos, $e, "id_assunto");
	?>
    <tr onMouseOver="move_i(this)" onMouseOut="move_o(this)" title=""> 
      <td width="9%" class="labelEsquerda"><?php echo $nm_assunto;?></td>
      <td width="91%" class="labelEsquerda"><a href="controller/ocorrencia_controller.php?abrirOcorrenciaLista=abrirOcorrenciaLista&id_assunto=<?php echo $id_assunto;?>"><img src="img/quadro_blue.jpg" width="<?php echo $qt;?>" height="10"></a><?php echo $qt;?></td>
    </tr>
    <?php } ?>
	
	 <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
	 <tr> 
      <td colspan="2" class="labelEsquerda"><strong>Acessos</strong></td>
    </tr>
    
    <?php 	
	for ( $e=0; $e < $row_acesso; $e++ ){
	$nm_acao = mysql_result($acessos, $e, "nm_acao");
	$qt = mysql_result($acessos, $e, "qt");
	$id_acao = mysql_result($acessos, $e, "id_acao");
	?>
    <tr onMouseOver="move_i(this)" onMouseOut="move_o(this)" title=""> 
      <td width="9%" class="labelEsquerda"><?php echo $nm_acao;?></td>
      <td width="91%" class="labelEsquerda"><a href="controller/ocorrencia_controller.php?abrirLogLista=abrirLogLista&id_acao=<?php echo $id_acao;?>"><img src="img/quadro_blue.jpg" width="<?php echo $qt;?>" height="10"></a><?php echo $qt;?></td>
    </tr>
    <?php } ?>
	
	
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><hr></td>
    </tr>
    <tr> 
      <td class="labelEsquerda">Ano&nbsp;<?php echo $nu_ano;?></td>
      <td class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="6" class="labelCentro"> <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:executar('controller/cancela_controller.php?cancelarOperacao=cancelarOperacao')" /> 
      </td>
    </tr>
    <?php } else {?>
    <tr> 
      <td colspan="6"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">Relatório 
          vazio!!!</font></div></td>
    </tr>
    <?php }?>
  </table>
</form> 
</body>

<?php

} else {
 

 }
 ?>
</html>
