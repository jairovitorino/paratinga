<?php
session_start();

 include "cabecalho/cabecalho.php";
 $msg_sucesso = @$_SESSION['msg_sucesso'];
 $msg_excessao = @$_SESSION['msg_excessao'];
 
 	$dt_log = date("Y-m-d");
	$time = mktime(date('H')-3, date('i'), date('s'));
	$hora_local = gmdate("H:i:s", $time);
	$hora = substr($hora_local,0,2).substr($hora_local,2,3);
	$hr_log = $hora;

	$id_ocorrencia = @$_SESSION['id_ocorrencia'];
	$id_assunto = @$_SESSION['id_assunto'];
	$nm_assunto = @$_SESSION['nm_assunto'];
	$dt_relato = @$_SESSION['dt_relato'];
	$hr_relato = @$_SESSION['hr_relato'];
	
	if ( $dt_relato == "" ){
	$dt_relato = date("d/m/Y");
	} else {
	$dt_relato = @$_SESSION['dt_relato'];
	}
	if ( $hr_relato == "" ){
	$hr_relato = $hr_log;
	} else {
	$hr_relato = @$_SESSION['hr_relato'];
	}
	
	$te_relato = @$_SESSION['te_relato'];
	
	$arquivo = @$_SESSION['arquivo'];
	$arquivo = substr($arquivo,12);
	//$resultado_busca = busca_cep('40275076');
   
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
function enviar(){
	//var i = document.formulario.id_marca.selectedIndex;
    //document.formulario.te_marca.value = document.formulario.id_marca[i].text;

	document.formulario.action = "controller/associado_controller.php?inserirAssociado=inserirAssociado";
	document.formulario.method = "post";
	document.formulario.submit();
}

</script>
<!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
<!-- Adicionando Javascript -->
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#nm_logra").val("");
                $("#nm_bairro").val("");
                $("#nm_cidade").val("");
                $("#nm_uf").val("");
                
            }
            
            //Quando o campo cep perde o foco.
          //  $("#nu_cep").blur(function() {
			$("#nu_cep").focus(function() {

                //Nova variável "cep" somente com dígitos.
                var nu_cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (nu_cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(nu_cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#nm_logra").val("...");
                        $("#nm_bairro").val("...");
                        $("#nm_cidade").val("...");
                        $("#nm_uf").val("...");
                        

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ nu_cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#nm_logra").val(dados.logradouro);
                                $("#nm_bairro").val(dados.bairro);
                                $("#nm_cidade").val(dados.localidade);
                                $("#nm_uf").val(dados.uf);
                                document.formulario.nu_cep_msg.style.display = "none";
								
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                              //  alert("CEP não encontrado.");
							 document.formulario.nu_cep_msg.style.display = "";
							// document.formulario.nu_cep_msg;
							 //document.write("Olá, tudo bem?");
							  
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
   
</head>
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<link rel="SHORTCUT ICON" href="<?php echo $icon;?>"/>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<?php if (empty($id_ocorrencia)){?>
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
    <tr> 
      <td colspan="2" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"> </td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><strong>Ocorr&ecirc;ncia</strong></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda">&nbsp;</td>
    </tr>
    <?
		//CONECTA AO MYSQL              
	    require_once("class/conexao.php");
		$mysql = new Mysql();
		$mysql->conectar(); 
		
		$sql_assunto = "SELECT * FROM assuntos ORDER BY nm_assunto"; 
		$sql_assunto = mysql_query($sql_assunto);       
		$row_assunto = mysql_num_rows($sql_assunto);
	?>
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
      <td width="28%" class="labelDireita">Relato:</td>
      <td class="labelEsquerda"><textarea name="te_relato" cols="2" rows="2"><?php echo $te_relato;?></textarea></td>
    </tr>
    <tr> 
      <td class="labelDireita">Arquivo</td>
      <td class="labelEsquerda"><input type="file" name="upload" id="upload" onChange="javascript:foto()"> 
      </td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"><hr></td>
    </tr>
    <tr> 
      <td colspan="2" class="labelEsquerda"> <input type="hidden" name="upload" id="upload"> 
        <input type="hidden" name="te_imagem" id="te_imagem"> 
        <input type="hidden" name="nm_assunto" id="nm_assunto" value="<?php echo $nm_assunto;?>"> 
      </td>
    </tr>
    <tr> 
      <td colspan="6" class="labelCentro"><input name="inserirOcorrencia" type="submit" value="Gravar"  /> 
        <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:executar('controller/cancela_controller.php?cancelarOperacao=cancelarOperacao')" /> 
      </td>
    </tr>
  </table>
</form> 
<?php } else {?>
<form name="formulario" id="formulario" method="post" action="controller/ocorrencia_controller.php" >
  <input type="hidden" name="nu_cpf" value="<?php echo $nu_cpf;?>">
  <table width="41%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td colspan="7" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="7" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="7" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="7" class="labelEsquerda"> 
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
      <td colspan="7" class="labelEsquerda"> </td>
    </tr>
    <tr> 
      <td colspan="7" class="labelCentro"><hr></td>
    </tr>
    <tr> 
      <td colspan="7" class="labelEsquerda"> </td>
    </tr>
    <tr> 
      <td colspan="7" class="labelEsquerda"><strong>Ocorr&ecirc;ncia</strong></td>
    </tr>
    <tr> 
      <td colspan="7" class="labelCentro">&nbsp;</td>
    </tr>
    <tr bgcolor="#999999"> 
      <td width="33%" class="labelEsquerda"><font color="#FFFFFF"><strong>Assunto</strong></font></td>
      <td width="13%" class="labelEsquerda"><font color="#FFFFFF"><strong>Data</strong></font></td>
      <td width="7%" class="labelEsquerda"><font color="#FFFFFF"><strong>Hora</strong></font></td>
      <td width="11%" class="labelCentro"><font color="#FFFFFF"><strong>Arquivo</strong></font></td>
      <td width="12%" class="labelCentro"><font color="#FFFFFF"><strong>Inserir</strong></font></td>
      <td width="12%" class="labelCentro"><font color="#FFFFFF"><strong>Editar</strong></font></td>
      <td width="12%" class="labelCentro"><font color="#FFFFFF"><strong>Excluir</strong></font></td>
    </tr>
    <?php
 	 require_once("class/conexao.php");
		$mysql = new Mysql();
		$mysql->conectar(); 
	 $sql = mysql_query("SELECT * FROM ocorrencias, assuntos 
	 WHERE ocorrencias.id_assunto = assuntos.id_assunto
	 AND id_ocorrencia = ".$id_ocorrencia." ");
    $row = mysql_num_rows($sql);
	for ( $i=0; $i < $row; $i++ ){
	$nm_assunto = mysql_result($sql, $i, "nm_assunto");
	$dt_relato = mysql_result($sql, $i, "dt_relato");
	$dt_relato = substr($dt_relato,8,2)."/".substr($dt_relato,5,2)."/".substr($dt_relato,0,4);
 	$hr_relato = mysql_result($sql, $i, "hr_relato");
	$te_imagem = mysql_result($sql, $i, "te_imagem");
	$te_imagem = substr($te_imagem,13);
	$te_imagem != "" ? $image = "<a href='arquivos/$te_imagem'><img src='img/lupa.gif' width='10' height='10'></a>" : $image = "-";  
		
	}
	
  ?>
    <tr> 
      <td class="labelEsquerda"><?php echo $nm_assunto;?></td>
      <td class="labelEsquerda"><?php echo $dt_relato;?></td>
      <td class="labelEsquerda"><?php echo $hr_relato;?></td>
      <td class="labelCentro"><?php echo $image;?></td>
      <td class="labelCentro"><a href="controller/ocorrencia_controller.php?abrirOcorrencia=abrirOcorrencia"><img src="img/insert.gif" width="10" height="10"></a></td>
      <td class="labelCentro"><a href="controller/ocorrencia_controller.php?abrirOcorrenciaEdit=abrirOcorrenciaEdit&id_ocorrencia=<?php echo $id_ocorrencia;?>"><img src="img/insert.gif" width="10" height="10"></a></td>
      <td class="labelCentro"><a href="javascript:del('controller/ocorrencia_controller.php?excluirOcorrencia=excluirOcorrencia&id_ocorrencia=<?php echo $id_ocorrencia;?>&opcao=1&te_imagem=<?php echo $te_imagem;?>')"><img src="img/excluir2.gif" width="10" height="10"></a></td>
    </tr>
    <tr> 
      <td colspan="7" class="labelCentro">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="11" class="labelCentro"> <input name="volta" type="button" id="volta" value="Cancelar" onClick="javascript:executar('controller/cancela_controller.php?cancelarOperacao=cancelarOperacao')" /> 
      </td>
    </tr>
  </table>
</form>
</body>

<?php
}
} else {
 include "rodape/rodape.php";
 }
 ?>
</html>
