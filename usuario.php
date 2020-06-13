<?php
session_start();

 include "cabecalho/cabecalho.php";
 $msg_sucesso = @$_SESSION['msg_sucesso'];
 $msg_excessao = @$_SESSION['msg_excessao'];
 $nm_usuario = @$_SESSION['nm_usuario'];
 $id_sexo = @$_SESSION['id_sexo'];
 $nm_sexo = @$_SESSION['nm_sexo'];
 $nu_cpf = @$_SESSION['nu_cpf'];
 $nu_lote = @$_SESSION['nu_lote'];
 $nm_quadra = @$_SESSION['nm_quadra'];
 $nm_senha = @$_SESSION['nm_senha'];
 $re_senha = @$_SESSION['re_senha'];
 $nm_login = @$_SESSION['nm_login'];
 $nm_senha = @$_SESSION['nm_senha'];
 $re_senha = @$_SESSION['re_senha'];
?>
<html>
<head>
<title><?php echo $titulo;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">

function caixas(){
	//document.getElementById('dt_ini').focus();
	document.form1.nm_usuario.focus();
}
function cancelar(delUrl) { 
    document.location = delUrl; 
}
function combo_sex(){
var i = document.getElementById("id_sexo").options[document.getElementById("id_sexo").selectedIndex].text;
   document.getElementById("nm_sexo").value = i;
}

</script>
</head>
<link rel="stylesheet" href="css/textos.css" type="text/css">
<link rel="stylesheet" href="css/estilo.css" type="text/css">
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<link rel="SHORTCUT ICON" href="<?php echo $icon;?>"/>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="form1" id="form1" method="post" action="controller/usuario_controller.php" onSubmit="valida_dados(this)">
  <table width="40%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
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
    <tr> 
      <td colspan="2" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"> </td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><strong>Dados do Usu&aacute;rio</strong></td>
    </tr>
    <tr> 
      <td class="labelDireita">&nbsp;</td>
      <td class="labelEsquerda">&nbsp;</td>
    </tr>
    <tr> 
      <td width="39%" class="labelDireita">Nome</td>
      <td width="61%" class="labelEsquerda"><input name="nm_usuario" id="nm_usuario" value="<?php echo $nm_usuario;?>" type="text" size="50" maxlength="50"></td>
    </tr>
    <tr>
      <td class="labelDireita">Sexo:</td>
      <td class="labelEsquerda"><select name="id_sexo" id="id_sexo" onChange="combo_sex()">
          <option value="<?php echo $id_sexo ? $id_sexo : "";?>"><?php echo $nm_sexo ? $nm_sexo : "-- Selecione -- >>";?></option>
          <option value="1">M</option>
          <option value="2">F</option>
        </select></td>
    </tr>
    <tr> 
      <td width="39%" class="labelDireita">CPF:</td>
      <td width="61%" class="labelEsquerda"><input name="nu_cpf" value="<?php echo $nu_cpf;?>" type="text" size="12" maxlength="11"></td>
    </tr>
    <tr> 
      <td width="39%" class="labelDireita">Lote:</td>
      <td width="61%" class="labelEsquerda"><input name="nu_lote" value="<?php echo $nu_lote;?>" type="text" size="4" maxlength="2"></td>
    </tr>
    <tr> 
      <td width="39%" class="labelDireita">Quadra:</td>
      <td width="61%" class="labelEsquerda"><input name="nm_quadra" value="<?php echo $nm_quadra;?>" type="text" size="2" maxlength="1"></td>
    </tr>
    <tr> 
      <td width="39%" class="labelDireita">E-mail</td>
      <td width="61%" class="labelEsquerda"><input name="nm_login" value="<?php echo $nm_login;?>" type="text" size="40" maxlength="50"></td>
    </tr>
    <tr> 
      <td class="labelDireita">Senha:</td>
      <td class="labelEsquerda"><input name="nm_senha" value="<?php echo $nm_senha;?>" type="password" size="20" maxlength="8"></td>
    </tr>
    <tr> 
      <td width="39%" class="labelDireita">Repete Senha:</td>
      <td width="61%" class="labelEsquerda"><input name="re_senha" value="<?php echo $re_senha;?>" type="password" size="20" maxlength="8"></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelDireita">Lí e concordo com os <a href="termo_condicoes_uso.php" target="_blank">Termos 
        e cond&ccedil;&otilde;es de uso</a>&nbsp; <input type="checkbox" name="termo" value="checkbox"></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><input type="hidden" name="inserirUsuario">
        <input type="hidden" name="nm_sexo" id="nm_sexo" value="<?php echo $nm_sexo;?>"></td>
    </tr>
    <tr> 
      <td colspan="6" class="labelCentro"><input name="grava" type="submit" id="grava" value="Gravar"> 
        <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:cancelar('controller/cancela_controller.php?cancelarOperacao=cancelarOperacao')" /> 
      </td>
    </tr>
  </table>
</form> 
</body>

<?php

 include "rodape/rodape.php";
 
 ?>
</html>
