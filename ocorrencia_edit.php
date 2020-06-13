<?php
session_start();

 include "cabecalho/cabecalho.php";
 $msg_sucesso = @$_SESSION['msg_sucesso'];
 $msg_excessao = @$_SESSION['msg_excessao'];
 $id_status = @$_SESSION['id_status'];
 $id_ocorrencia = @$_SESSION['id_ocorrencia'];
 $opcao = @$_SESSION['opcao'];
   
 $login_paratinga = @$_SESSION['login_paratinga'];
   
 if ($login_paratinga){
?>
<html>
<head>
<title>Contr&ocirc;le acad&ecirc;mico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function caixas(){
	//document.getElementById('dt_ini').focus();
	document.formulario.nu_cep.focus();
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
function foto(){
var saida = document.getElementById('te_imagem');
saida.value =  document.getElementById('upload').value;
}
function combo_assunto(){
var i = document.getElementById("id_assunto").options[document.getElementById("id_assunto").selectedIndex].text;
   document.getElementById("nm_assunto").value = i;
}
function barra(objeto){
if (objeto.value.length == 2 || objeto.value.length == 5 ){
objeto.value = objeto.value+"/";
}
}
function barra_hora(objeto){
if (objeto.value.length == 2 || objeto.value.length == 2 ){
objeto.value = objeto.value+":";
}
}
</script>   
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<link rel="SHORTCUT ICON" href="<?php echo $icon;?>"/>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="formulario" id="formulario" method="post" action="controller/ocorrencia_controller.php" enctype="multipart/form-data" >
  <input type="hidden" name="nu_cpf" value="<?php echo $nu_cpf;?>">
  <table width="41%" border="0" cellspacing="0" cellpadding="0" align="center">
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
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"> 
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
      <td colspan="2" class="labelEsquerda"> </td>
    </tr>
    <?
	//CONECTA AO MYSQL              
	require_once("class/conexao.php");
	$mysql = new Mysql();
	$mysql->conectar(); 
		
	 $sql = mysql_query("SELECT * FROM ocorrencias, assuntos, usuarios 
	 WHERE ocorrencias.id_assunto = assuntos.id_assunto
	 AND ocorrencias.id_usuario = usuarios.id_usuario
	 AND id_ocorrencia = ".$id_ocorrencia." ");
    $row = mysql_num_rows($sql);
	for ( $i=0; $i < $row; $i++ ){
	$id_assunto = mysql_result($sql, $i, "id_assunto");
	$nm_assunto = mysql_result($sql, $i, "nm_assunto");
	$st_relato = mysql_result($sql, $i, "st_relato");
	$dt_relato = mysql_result($sql, $i, "dt_relato");
	$dt_relato = substr($dt_relato,8,2)."/".substr($dt_relato,5,2)."/".substr($dt_relato,0,4);
 	$hr_relato = mysql_result($sql, $i, "hr_relato");
	$te_relato = mysql_result($sql, $i, "te_relato");
	$te_relato_dir = mysql_result($sql, $i, "te_relato_dir");
	$nm_diretor = mysql_result($sql, $i, "nm_diretor");
	$id_usuario = mysql_result($sql, $i, "id_usuario");
	$nm_usuario_mor = mysql_result($sql, $i, "nm_usuario");
	$nu_lote = mysql_result($sql, $i, "nu_lote");
	$nm_quadra = mysql_result($sql, $i, "nm_quadra");
	}
	$sql_assunto = "SELECT * FROM assuntos ORDER BY nm_assunto"; 
	$sql_assunto = mysql_query($sql_assunto);       
	$row_assunto = mysql_num_rows($sql_assunto);
	?>
    <tr> 
      <td colspan="2" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">Ocorr&ecirc;ncia relatada por:&nbsp;<?php echo $nm_usuario_mor;?> 
        | Lote: <?php echo $nu_lote;?> | Quadra: <?php echo $nm_quadra;?></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
	<?php if ($id_status == 1) {?>
    <tr> 
      <td class="labelDireita">Status: </td>
      <td width="66%" class="labelEsquerda"> <?php echo $st_relato == 2 ? "<input type='radio' name='st_relato' id='st_relato' value='2' checked>" : 
	  "<input type='radio' name='st_relato' id='st_relato' value='2'>"?> Resolvido 
        <?php echo $st_relato == 1 ? "<input type='radio' name='st_relato' id='st_relato' value='1' checked>" : 
	  "<input type='radio' id='st_relato' name='st_relato' value='1' >"?> An&aacute;lise 
        <?php echo $st_relato == 0 ? "<input type='radio' name='st_relato' id='st_relato' value='0' checked>" : 
	  "<input type='radio' name='st_relato' id='st_relato' value='0' >"?> Pendente 
      </td>
    </tr><input type="hidden" name="nm_usuario_dir" value="<?php echo $_SESSION['nm_usuario_dir'];?>"> 
    <?php }?>
	 <?php if ( $id_usuario == $_SESSION['id'] ) {?>
    <tr> 
      <td class="labelDireita">Assunto:</td>
      <td class="labelEsquerda"><select name="id_assunto" id="id_assunto" onChange="combo_assunto()" >
          <option value="<?php echo $id_assunto ? $id_assunto : "0";?>"><?php echo $nm_assunto ? $nm_assunto : "-- Selecione -- >>";?></option>
          <?php for($a=0; $a<$row_assunto; $a++) { ?>
          <option value="<?php echo mysql_result($sql_assunto, $a, "id_assunto"); ?>"> 
          <?php echo mysql_result($sql_assunto, $a, "nm_assunto"); ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr> 
      <td class="labelDireita">Data:</td>
      <td class="labelEsquerda"><input type="text" name="dt_relato"  value="<?php echo $dt_relato;?>" size="12" maxlength="10" onKeyUp="barra(this)"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Hora:</td>
      <td class="labelEsquerda"><input type="text" name="hr_relato"  value="<?php echo $hr_relato;?>" size="6" maxlength="5" onKeyUp="barra_hora(this)"></td>
    </tr>         
    <tr> 
      <td width="34%" class="labelDireita">Relato:</td>
      <td class="labelEsquerda"><textarea name="te_relato" cols="2" rows="2"><?php echo $te_relato;?></textarea></td>
    </tr>
	 <tr> 
      <td class="labelDireita">Arquivo</td>
      <td class="labelEsquerda"><input type="file" name="upload" id="upload" onChange="javascript:foto()"> 
        <input type="checkbox" name="checkbox" value="checkbox">
      </td>
    </tr>
 	<?php } else { ?>   
	
	 <tr> 
      <td class="labelDireita">Assunto:</td>
      <td class="labelEsquerda"><select name="id_assunto" id="id_assunto" onChange="combo_assunto()" disabled >
          <option value="<?php echo $id_assunto ? $id_assunto : "0";?>"><?php echo $nm_assunto ? $nm_assunto : "-- Selecione -- >>";?></option>
          <?php for($a=0; $a<$row_assunto; $a++) { ?>
          <option value="<?php echo mysql_result($sql_assunto, $a, "id_assunto"); ?>"> 
          <?php echo mysql_result($sql_assunto, $a, "nm_assunto"); ?></option>
          <?php } ?>
        </select></td>
    </tr>
    <tr> 
      <td class="labelDireita">Data:</td>
      <td class="labelEsquerda"><input type="text" name="dt_relato"  value="<?php echo $dt_relato;?>" size="12" maxlength="10" onKeyUp="barra(this)" disabled></td>
    </tr>
    <tr> 
      <td class="labelDireita">Hora:</td>
      <td class="labelEsquerda"><input type="text" name="hr_relato"  value="<?php echo $hr_relato;?>" size="6" maxlength="5" onKeyUp="barra_hora(this)" disabled></td>
    </tr>         
    <tr> 
      <td width="34%" class="labelDireita">Relato morador:</td>
      <td class="labelEsquerda"><textarea name="te_relato" cols="2" rows="2" disabled><?php echo $te_relato;?></textarea></td>
    </tr> 
	<?php $te_relato_dir == "" ? $te_relato_dir = $_SESSION['te_relato_dir'] : $te_relato_dir = $te_relato_dir;?>
	 <tr> 
      <td width="34%" class="labelDireita">Relato diretoria:</td>
      <td class="labelEsquerda"><textarea name="te_relato_dir" cols="2" rows="2"><?php echo $te_relato_dir;?></textarea></td>
    </tr>
	<?php if ($nm_diretor) {?>
	 <tr> 
      <td class="labelDireita">Diretor(a):</td>
      <td class="labelEsquerda"><input type="text" name="nm_diretor"  value="<?php echo $nm_diretor;?>" size="30" maxlength="40" disabled></td>
    </tr>       
	<?php }?>
    <tr> 
      <td class="labelDireita">Arquivo</td>
      <td class="labelEsquerda"><input type="file" name="upload" id="upload" onChange="javascript:foto()" disabled> 
        <input type="checkbox" name="checkbox" value="checkbox" disabled>
      </td>
    </tr>
   	<?php }?>
    <tr> 
      <td colspan="2" class="labelEsquerda"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"> <input type="hidden" name="upload" id="upload"> 
        <input type="hidden" name="te_imagem" id="te_imagem"> 
		<input type="hidden" name="nm_assunto" id="nm_assunto" value="<?php echo $nm_assunto;?>"> 
        <input type="hidden" name="id_ocorrencia" id="id_ocorrencia" value="<?php echo $id_ocorrencia;?>"> 
        <input type="hidden" name="opcao" id="opcao" value="<?php echo $opcao;?>"> 
		<input type="hidden" name="id_assunto" value="<?php echo $id_assunto;?>"> 
		<input type="hidden" name="dt_relato" value="<?php echo $dt_relato;?>"> 
		<input type="hidden" name="hr_relato" value="<?php echo $hr_relato;?>"> 
		<input type="hidden" name="te_relato" value="<?php echo $te_relato;?>"> 
		<input type="hidden" name="upload" value="<?php echo $upload;?>"> 
		<input type="hidden" name="checkbox" value="<?php echo $checkbox;?>">		
       
        <?php if ( $id_status == 2 ){?>		 
        <input type="hidden" name="st_relato" id="st_relato" value="<?php echo $st_relato;?>"> 
        <?php }?>
      </td>
    </tr>
    <tr> 
      <td colspan="6" class="labelCentro"><input name="editarOcorrencia" type="submit" value="Editar"  /> 
        <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:executar('controller/cancela_controller.php?cancelarOperacao=cancelarOperacao')" /> 
      </td>
    </tr>
  </table>
</form> 

</body>

<?php

} else {
 include "rodape/rodape.php";
 }
 ?>
</html>
