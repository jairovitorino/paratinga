<?php
@session_start();

$titulo = @$_SESSION['titulo'];
$titulo == "" ? $titulo = "Condomínio Paratinga" : $titulo = $titulo;
$icon = @$_SESSION['icon'];
$icon == "" ? $icon = "img/mansion.png" : $icon = $icon;
// strtoupper();

if (isset($_SESSION['login_paratinga'])){
$login_paratinga = $_SESSION['login_paratinga'];
}
if (isset($_SESSION['acesso'])){
$acesso = $_SESSION['acesso'];
}
if (isset($_SESSION['id_status'])){
$id_status = $_SESSION['id_status'];
}
if (isset($_SESSION['msg'])){
$msg = $_SESSION['msg'];
}

?>
<html>
<head>
<title><?php echo $titulo;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
function imprimir(detUrl){
document.location = detUrl;
}
</script>
</head>
<link rel="stylesheet" href="css/textos.css" type="text/css">
<link rel="stylesheet" href="css/estilo.css" type="text/css">
<link rel="stylesheet" href="css/filadelfia.css" type="text/css">
<link rel="SHORTCUT ICON" href="<?php echo $icon;?>"/>
<body bgcolor="#F5F5F5" onLoad="javascript:caixas()">
<form name="form1" action="controller/usuario_controller.php" method="post">

<?php if ( @$acesso == 1 ){?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#FFFFFF"> 
    <td colspan="5"><font color="#000099" size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>
 <tr bgcolor="#333333">  
      <td colspan="5"><div align="center"><font color="#000099" size="2" face="Arial, Helvetica, sans-serif">&nbsp;<font color="#FFFFFF">CONDOM&Iacute;NIO 
          PARATINGA </font></font></div></td>
  </tr>
   <tr bgcolor="#ffffff"> 
    <td colspan="5"><div align="center"><font color="#000099" size="2" face="Arial, Helvetica, sans-serif">&nbsp;<font color="#FFFFFF">ADMINISTRA&Ccedil;&Atilde;O</font></font></div></td>
  </tr>
  <script type="text/javascript" src="js/menu.js"></script>
  <tr> 
    <td width="18%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro"><font color="#FF0000" size="2" face="Courier New, Courier, mono">&nbsp; 
      </font></td>
      <td><ul class="udm" id="udm" name="udm"> <li><a href="#">Cadastros</a> 
          <ul>
            <?php if ( ($login_paratinga != 'admin')){?>
           	<li><a href="controller/ocorrencia_controller.php?abrirOcorrencia=abrirOcorrencia">Ocorrencia</a> </li>
			 <?php } else {?>
            <li><a href="#">Ocorrencia</a> </li>
			           
			  <?php }?>
          </ul>
        <li><a href="#">Consultas</a> 
	     <ul>
          <li><a href="controller/ocorrencia_controller.php?abrirOcorrenciaLista=abrirOcorrenciaLista">Ocorrencias</a>  </li>
          <li><a href="controller/ocorrencia_controller.php?abrirPainel=abrirPainel">Painel</a></li>
         </ul>
      		
		 <li><a href="#">Contas</a> 
          <ul> 
				
			<li><a href="controller/usuario_controller.php?abrirUsuarioLista=abrirUsuarioLista">Usu&aacute;rios</a></li>
							
			</ul>
		
			 <li><a href="#">Ajuda</a>
		 <ul> 
			
			<li><a href="controller/usuario_controller.php?abrirInformacoes=abrirInformacoes">Informa&ccedil;&otilde;es</a></li>
			<li><a href="#" title="28/11/2018 as 14:54">Release 1.0</a></li>				
			 <?php if ( ($_SESSION['login_paratinga'] == 'jairo.vitorino@gmail.com') || ($_SESSION['login_paratinga'] == 'millyssousa20@gmail.com') ){?>	
			 <li><a href="#">Backup</a>
        	<ul>		
			 <li><a href="controller/usuario_controller.php?copiarDados=copiarDados">Executar</a></li>
		  <li><a href="controller/usuario_controller.php?abrirBackup=abrirBackup">Exibir</a></li> 		     
		   </ul>		  			
		<?php }?>	
		  <?php if ( ($_SESSION['login_paratinga'] == 'jairo.vitorino@gmail.com') ){?>	
			<li><a href="controller/usuario_controller.php?abrirBoasVindas=abrirBoasVindas">Boas Vindas</a></li>
			<li><a href="controller/usuario_controller.php?abrirLogLista=abrirLogLista">Log</a></li>
			 <li><a href="#" title="28/11/2018 as 14:54">Contratos</a>
			   <ul>
			       <li><a href="controller/usuario_controller.php?imprimirContratoOnline=imprimirContratoOnline">onLine</a></li>
					<li><a href="controller/usuario_controller.php?imprimirContrato=imprimirContrato">Padrao</a></li>
			   </ul>
			 </li>   			 
		   </ul>		  			
		<?php }?>		
			</ul>
	  
	  </td>
      <td width="31%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro"> 
        Usu&aacute;rio <?php echo $_SESSION['nm_status']?>:&nbsp;<font color="#ff0000"><?php echo @$login_paratinga;?>:</font>&nbsp;&nbsp;(<a href="controller/usuario_controller.php?logout=logout">Sair</a>)</td>
      <td width="13%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro">&nbsp;</td>
    
  </tr>
</table>
<?php } else {?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr bgcolor="#FFFFFF"> 
    <td colspan="5"><font color="#000099" size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
  </tr>
   <tr bgcolor="#333333"> 
    <td colspan="5"><div align="center"><font color="#000099" size="2" face="Arial, Helvetica, sans-serif">&nbsp;<font color="#FFFFFF">CONDOM&Iacute;NIO 
          PARATINGA </font></font></div></td>
  </tr>
     <tr bgcolor="#ffffff"> 
    <td colspan="5"><div align="center"><font color="#000099" size="2" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;<font color="#FFFFFF">ADMINISTRA&Ccedil;&Atilde;O</font></font></div></td>
  </tr>
    <tr> 
      <td width="18%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro">&nbsp;</td>
      <td width="38%" bordercolor="#FFFFFF" background="../calendario.php" bgcolor="#FFFFFF" class="labelCentro">&nbsp;</td>
      <td width="32%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro"> 
        E-mail 
        <input name="login" type="text" size="25" maxlength="50">
        Senha
        <input name="senha" type="password" size="8" maxlength="50">
        <input type="submit" value="Ok">
       
        &nbsp;<font color="#ff0000"><?php echo @$msg;?></font>
		
        <input type="hidden" name="logar"></td>
      <td width="12%" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="labelCentro"><a href="controller/usuario_controller.php?novoUsuario=novoUsuario">N&atilde;o 
        sou cadastrado</a></td>
    </tr>
  </table>
<?php }?>
</form>
</body>

</html>
