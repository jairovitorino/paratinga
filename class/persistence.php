<?php
@session_start();
require_once("conexao.php");
$mysql = new Mysql();
$mysql->conectar();

class Persistence {

public function logar($nm_login,$nm_senha){
		// $nm_senha = md5('$nm_senha');
		$sql = mysql_query("SELECT usuarios.id_usuario,usuarios.nm_usuario,usuarios.id_status,status.nm_status FROM usuarios, status 
		WHERE usuarios.id_status = status.id_status AND nm_login = '".$nm_login."' AND nm_senha = password('".$nm_senha."') AND status.id_status <> 3  ") or 
		die ("<table width='100%' border='0' align='center'><tr><td><div align='center'><font color='#FF0000'>AVISO: A CONEX&Atilde;O COM O BANCO DE DADOS FALHOU!.</font></div></td></tr></table>");
		$row = mysql_num_rows($sql);
		for ( $i=0; $i < $row; $i++ ){
		$id_usuario  = mysql_result($sql, $i, "id_usuario"); 
		$id  = mysql_result($sql, $i, "id_usuario"); 
		$nm_usuario  = mysql_result($sql, $i, "nm_usuario"); 
		$id_id  = mysql_result($sql, $i, "id_status"); 
		$id_status  = mysql_result($sql, $i, "id_status"); 
		$nm_status  = mysql_result($sql, $i, "nm_status");
		
		}
		if ( $row == 0 ){
		$msg = "Usuário ou Senha inválida";
		$acesso = "2";
		$_SESSION['msg'] = $msg;
		$_SESSION['acesso'] = $acesso;
		unset($_SESSION['msg_usuario']);
		// log ******************************************* 
		$dt_log = date("Y-m-d");
		$time = mktime(date('H')-3, date('i'), date('s'));
		$hora_local = gmdate("H:i:s", $time);
		$hora = substr($hora_local,0,2).substr($hora_local,2,3);
		$hr_log = $hora;
		$id_acao = 5;
		$nm_objeto = $nm_login;
		$id_usuario = 56;
		$nu_ip = getenv("REMOTE_ADDR");
		$nm_acesso = $nm_login;
		$mobile = FALSE;
   		$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric"); 
   		foreach($user_agents as $user_agent){
     	if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
        $mobile = TRUE;
		$modelo	= $user_agent;
		break;
     	}
   		} 
   		if ($mobile){
      		$nm_dispositivo = strtolower($modelo);
   				}else{
      			$nm_dispositivo = "Computador";
   		}
		
		$inserir = mysql_query("INSERT INTO logs (dt_log,hr_log,id_acao,nm_objeto,id_usuario,nu_ip,nm_dispositivo) 
		VALUES('".$dt_log."','".$hr_log."',".$id_acao.",'".$nm_objeto."',".$id_usuario.",'".$nu_ip."','".$nm_dispositivo."')")
		or die("Erro 1");
	//**************************************************************************************************************************
		header ("location: ../index.php");
		} else {
		$acesso = "1";
		
		$_SESSION['acesso'] = $acesso;
		$_SESSION['id_usuario'] = $id_usuario;
		$_SESSION['id'] = $id;
		$_SESSION['id_id'] = $id_id;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['nm_usuario_dir'] = $nm_usuario;
		$_SESSION['id_status'] = $id_status;
		$_SESSION['nm_status'] = $nm_status;	
		$_SESSION['login'] = $nm_login;
		$_SESSION['login_paratinga'] = $nm_login;
		$_SESSION['titulo'] = "Condomínio Paratinga";
		$_SESSION['icon'] = "img/mansion.png";
		unset($_SESSION['msg_usuario']);
		// log ******************************************* 
		$dt_log = date("Y-m-d");
		$time = mktime(date('H')-3, date('i'), date('s'));
		$hora_local = gmdate("H:i:s", $time);
		$hora = substr($hora_local,0,2).substr($hora_local,2,3);
		$hr_log = $hora;
		$id_acao = 5;
		$nm_objeto = "Login";
		$nu_ip = getenv("REMOTE_ADDR");
		$mobile = FALSE;
   		$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric"); 
   		foreach($user_agents as $user_agent){
     	if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
        $mobile = TRUE;
		$modelo	= $user_agent;
		break;
     	}
   		} 
   		if ($mobile){
      		$nm_dispositivo = strtolower($modelo);
   				}else{
      			$nm_dispositivo = "Computador";
   		}
		$inserir = mysql_query("INSERT INTO logs (dt_log,hr_log,id_usuario,id_acao,nm_objeto,nu_ip,nm_dispositivo) 
		VALUES('".$dt_log."','".$hr_log."',".$_SESSION['id_usuario'].",".$id_acao.",'".$nm_objeto."','".$nu_ip."','".$nm_dispositivo."')");
	
		
	//**************************************************************************************************************************
		// Indicadores
		/*$sql = mysql_query("SELECT * FROM alunos WHERE id_status = 0 AND id_usuario = ".$id_usuario." ");
		$row = mysql_num_rows($sql);
		for ( $i=0; $i < $row; $i++ ){
		$id_aluno  = mysql_result($sql, $i, "id_aluno"); 
		}
		if ( $row > 0 ){
		$_SESSION['qt_alunos'] = "Total de alunos: ".$i;
		} else {
		$_SESSION['qt_alunos'] = "";
		}
		$sql = mysql_query("SELECT * FROM alunos WHERE id_sexo = 1 AND id_status = 0 AND id_usuario = ".$id_usuario." ");
		$row = mysql_num_rows($sql);
		for ( $i=0; $i < $row; $i++ ){
		$id_aluno  = mysql_result($sql, $i, "id_aluno"); 
		}
		if ( $row > 0 ){
		$_SESSION['qt_alunos_mas'] = "Alunos: ".$i;
		} else {
		$_SESSION['qt_alunos_mas'] = "";
		}
		$sql = mysql_query("SELECT * FROM alunos WHERE id_sexo = 2 AND id_status = 0 AND id_usuario = ".$id_usuario." ");
		$row = mysql_num_rows($sql);
		for ( $i=0; $i < $row; $i++ ){
		$id_aluno  = mysql_result($sql, $i, "id_aluno"); 
		}
		if ( $row > 0 ){
		$_SESSION['qt_alunos_fem'] = "Alunas: ".$i;
		} else {
		$_SESSION['qt_alunos_fem'] = "";
		}*/
		
	
	//***************************************************************************************************************
		header ("location: ../index.php");
	//	header ("location: index_off.php");		
		}	
	}
	
public function validarCpfUsuario($nu_cpf){

	$sql = mysql_query("SELECT * FROM usuarios WHERE nu_cpf = '".$nu_cpf."' ") or die ("Erro 48.1");
	$row = mysql_num_rows($sql);
	if ( $row > 0 ){
	return true;
	} else {
	return false;
	}

}

public function validarEmail($nm_login){

	$sql = mysql_query("SELECT * FROM usuarios WHERE nm_login = '".$nm_login."' ") or die ("Erro 48.2");
	$row = mysql_num_rows($sql);
	if ( $row > 0 ){
	return true;
	} else {
	return false;
	}

}


public function inserirUsuario($nm_usuario,$id_sexo,$nu_cpf,$nu_lote,$nm_quadra,$nm_login,$nm_senha){
	$sql = mysql_query("SELECT * FROM usuarios WHERE nm_login = '".$nm_login."' ") or die ("Erro 2");
	$row = mysql_num_rows($sql);
	if ($row == 1){
	$msg_erro = "E-mail já existe!!";
	$_SESSION['msg_excessao'] = $msg_erro;
	unset($_SESSION['msg']);
	header ("location: ../usuario.php");
	} else {
	$dt_cadastro = date("Y-m-d");
	$nu_ip = getenv("REMOTE_ADDR");
	// 
	//
	
	$sql = mysql_query("INSERT INTO usuarios (nm_usuario,id_sexo,nu_cpf,nu_lote,nm_quadra,nm_login,nm_senha,nu_ip,dt_cadastro,id_status) 
	VALUES('".$nm_usuario."',".$id_sexo.",'".$nu_cpf."','".$nu_lote."','".$nm_quadra."','".$nm_login."',password('".$nm_senha."'),'".$nu_ip."','".$dt_cadastro."',3)") or die ("Erro 1");
			
	$msg_sucesso = "Gravado com sucesso: ".$nm_login.". Aguarde liberação";
	
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: ../usuario.php");
	}
	}
	public function alterarUsuario($id_usuario,$nm_usuario,$nm_login,$id_status){
	
	$altera = mysql_query("UPDATE usuarios SET nm_usuario = '".$nm_usuario."' WHERE id_usuario = ".$id_usuario." ");
	$altera = mysql_query("UPDATE usuarios SET nm_login = '".$nm_login."' WHERE id_usuario = ".$id_usuario." ");
	$altera = mysql_query("UPDATE usuarios SET id_status = ".$id_status." WHERE id_usuario = ".$id_usuario." ");	
	
	// log ******************************************* 
	$dt_log = date("Y-m-d");
	$time = mktime(date('H')-3, date('i'), date('s'));
	$hora_local = gmdate("H:i:s", $time);
	$hora = substr($hora_local,0,2).substr($hora_local,2,3);
	$hr_log = $hora;
	$id_acao = 2;
	$nm_objeto = "Usuário";
	$nu_ip = getenv("REMOTE_ADDR");
	$id_indice = $id_usuario;
	$inserir = mysql_query("INSERT INTO logs (dt_log,hr_log,id_usuario,id_acao,nm_objeto,nu_ip) 
	VALUES('".$dt_log."','".$hr_log."',".$_SESSION['id_usuario'].",".$id_acao.",'".$nm_objeto."','".$nu_ip."')");
	//**************************************************************************************************************************	
	
	$msg_sucesso = "Registros editados com sucesso";
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	header ("location: ../usuario_edit.php");
	}
	
public function validarExcluirUsuario($id_usuario){
	
	$sql1 = mysql_query("SELECT * FROM ocorrencias WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 2");
	$row1 = mysql_num_rows($sql1);
	
	/*
	$sql2 = mysql_query("SELECT * FROM blocos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 3");
	$row2 = mysql_num_rows($sql2);
	
	$sql3 = mysql_query("SELECT * FROM curriculos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 4");
	$row3 = mysql_num_rows($sql3);
	
	$sql4 = mysql_query("SELECT * FROM cursos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 5");
	$row4 = mysql_num_rows($sql4);
	
	$sql5 = mysql_query("SELECT * FROM psicanalistas WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 5");
	$row5 = mysql_num_rows($sql5);	
	
	$sql6 = mysql_query("SELECT * FROM psicos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 6");
	$row6 = mysql_num_rows($sql6);
	
	$sql7 = mysql_query("SELECT * FROM servicos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 7");
	$row7 = mysql_num_rows($sql7);
	
	$sql8 = mysql_query("SELECT * FROM solicitacoes WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 8");
	$row8 = mysql_num_rows($sql8);
		
	$sql9 = mysql_query("SELECT * FROM treinos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 9");
	$row9 = mysql_num_rows($sql9);
	*/	
			
	if ( ($row1 > 0) || ($row2 > 0) || ($row3 > 0) || ($row4 > 0) || ($row5 > 0) || ($row6 > 0) || ($row7 > 0) || ($row8 > 0) || ($row9 > 0) ){
	
	return true;
	} else {
	return false;
	}
}

public function excluirUsuario($id_usuario,$opcao){

	$sql = mysql_query("DELETE FROM usuarios  WHERE id_usuario = ".$id_usuario." ") or die ("Erro 3");
	
	$msg_sucesso = "Registro excluido com sucesso";	
	$_SESSION['msg_sucesso'] = $msg_sucesso;

	if ( $opcao == 1 ){
	$_SESSION['id_usuario'] = $id_usuario;
	header ("location: ../usuario.php");
	} else {
	header ("location: ../usuario_lista.php");
	}
}

public function editarSenha($id_usuario,$nm_senha){

	$alterar = mysql_query("UPDATE usuarios SET nm_senha = password('".$nm_senha."') WHERE id_usuario = ".$id_usuario."") or die ("Erro 4");
	
	$msg_sucesso = "Registro editado com sucesso";	
	$_SESSION['msg_sucesso'] = $msg_sucesso;	
	header ("location: ../senha.php");
}

public function gerarConta($email,$nome){

	$sql = mysql_query("UPDATE usuarios SET id_status = 1 WHERE nm_login = '".$email."'");
	$_SESSION['email'] = $email;
	$_SESSION['nome'] = $nome;
	header ("location: ../boas_vindas.php");
}
public function msg_excessao($id_usuario,$nm_senha){

	$alterar = mysql_query("UPDATE usuarios SET nm_senha = password('".$nm_senha."') WHERE id_usuario = ".$id_usuario."") or die ("Erro 5");
	
	$msg_sucesso = "Registro alterado com sucesso";	
	$_SESSION['msg_sucesso'] = $msg_sucesso;	
	header ("location: ../senha.php");
}
//######################################################################################################################################

public function validCPF($nu_cpf){

 $d1 = 0;   
  $d2 = 0;
 $nu_cpf = preg_replace("/[^0-9]/", "", $nu_cpf); 
 $ignore_list = array(   '00000000000', '01234567890', '11111111111', '22222222222', '33333333333', '44444444444', '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'  ); 
  if(strlen($nu_cpf) != 11 || in_array($nu_cpf, $ignore_list)) {
  
  	return false;
  
  	} else {
  
   for($i = 0; $i < 9; $i++){
   
   $d1 += $nu_cpf[$i] * (10 - $i);
   
    }
	
	$r1 = $d1 % 11;	
	$d1 = ($r1 > 1) ? (11 - $r1) : 0;	
	for($i = 0; $i < 9; $i++) {
	
	$d2 += $nu_cpf[$i] * (11 - $i);
	
	}
	
	$r2 = ($d2 + ($d1 * 2)) % 11;	
	$d2 = ($r2 > 1) ? (11 - $r2) : 0;
	
	return (substr($nu_cpf, -2) == $d1.$d2) ? true : false;
	}
	}
	
public function validCnpj($nu_cpf_cnpj)
	 	{
			$nu_cpf_cnpj = preg_replace( "@[./-]@", "", $nu_cpf_cnpj );
    if( strlen( $nu_cpf_cnpj ) <> 14 or !is_numeric( $nu_cpf_cnpj ) )
    {
    return false;
    }
    $k = 6;
    $soma1 = "";
    $soma2 = "";
    for( $i = 0; $i < 13; $i++ )
    {
    $k = $k == 1 ? 9 : $k;
    $soma2 += ( $nu_cpf_cnpj{$i} * $k );
    $k--;
    if($i < 12)
    {
    if($k == 1)
    {
    $k = 9;
    $soma1 += ( $nu_cpf_cnpj{$i} * $k );
    $k = 1;
    }
    else
    {
    $soma1 += ( $nu_cpf_cnpj{$i} * $k );
    }
    }
    }
    $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
    $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
    return ( $nu_cpf_cnpj{12} == $digito1 and $nu_cpf_cnpj{13} == $digito2 );
	
	}
	
 public function extenso($valor = 0, $maiusculas = false) {
 
 	$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
	$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");

	$c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
	$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
	$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
	$u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

	$z = 0;
	$rt = "";

	$valor = number_format($valor, 2, ".", ".");
	$inteiro = explode(".", $valor);
	for($i=0;$i<count($inteiro);$i++)
	for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
		$inteiro[$i] = "0".$inteiro[$i];

	$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
		for ($i=0;$i<count($inteiro);$i++) {
	$valor = $inteiro[$i];
	$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
	$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
	$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

	$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
	$ru) ? " e " : "").$ru;
	$t = count($inteiro)-1-$i;
	$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
		if ($valor == "000")$z++; elseif ($z > 0) $z--;
			if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
				if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
	}

		if(!$maiusculas){
			return($rt ? $rt : "zero");
		} else {

			if ($rt) $rt=ereg_replace(" E "," e ",ucwords($rt));
			return (($rt) ? ($rt) : "Zero");
		}
 
 }

// ######################################################################################################

	public function validarExcluirOcorrencia($id_ocorrencia){
	
	//$sql1 = mysql_query("SELECT * FROM ocorrencias WHERE id_ocorrencia = ".$id_ocorrencia." AND st_relato = 2  ") or die ("Erro 2");
	$sql1 = mysql_query("SELECT * FROM ocorrencias WHERE st_relato <> 0  ") or die ("Erro 2");
	$row1 = mysql_num_rows($sql1);
	
	
	$sql2 = mysql_query("SELECT * FROM ocorrencias WHERE id_ocorrencia = ".$id_ocorrencia." AND st_relato = 1  ") or die ("Erro 3");
	$row2 = mysql_num_rows($sql2);
	
	/*
	$sql3 = mysql_query("SELECT * FROM curriculos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 4");
	$row3 = mysql_num_rows($sql3);
	
	$sql4 = mysql_query("SELECT * FROM cursos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 5");
	$row4 = mysql_num_rows($sql4);
	
	$sql5 = mysql_query("SELECT * FROM psicanalistas WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 5");
	$row5 = mysql_num_rows($sql5);	
	
	$sql6 = mysql_query("SELECT * FROM psicos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 6");
	$row6 = mysql_num_rows($sql6);
	
	$sql7 = mysql_query("SELECT * FROM servicos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 7");
	$row7 = mysql_num_rows($sql7);
	
	$sql8 = mysql_query("SELECT * FROM solicitacoes WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 8");
	$row8 = mysql_num_rows($sql8);
		
	$sql9 = mysql_query("SELECT * FROM treinos WHERE id_usuario = ".$id_usuario."  ") or die ("Erro 9");
	$row9 = mysql_num_rows($sql9);
	*/	
			
	if ( ($row1 > 0) || ($row2 > 0) || ($row3 > 0) || ($row4 > 0) || ($row5 > 0) || ($row6 > 0) || ($row7 > 0) || ($row8 > 0) || ($row9 > 0) ){
	
	return true;
	} else {
	return false;
	}
}


  public function inserirOcorrencia($id_assunto,$dt_relato,$hr_relato,$te_relato,$te_imagem){
   // unlink('test2.log');
  //$te_imagem = substr($te_imagem,13);
  $arq = basename($te_imagem);
  $dt_relato = substr($dt_relato,6,4)."-".substr($dt_relato,3,2)."-".substr($dt_relato,0,2);
  
  $sql = mysql_query("INSERT INTO ocorrencias (id_assunto,dt_relato,hr_relato,te_relato,te_imagem,id_usuario) 
	VALUES(".$id_assunto.",'".$dt_relato."','".$hr_relato."','".$te_relato."','".$arq."',".$_SESSION['id_usuario'].")") 
	or die ("Erro 6");
	
	$sql = mysql_query("SELECT MAX(id_ocorrencia) AS id_ocorrencia FROM ocorrencias") or dir ("Erro 7");
	$row = mysql_num_rows($sql);
	for ( $i=0;$i < $row; $i++ ){
	$id_ocorrencia = mysql_result($sql, $i, "id_ocorrencia");
	}	
  
  // log ******************************************* 
		$dt_log = date("Y-m-d");
		$time = mktime(date('H')-3, date('i'), date('s'));
		$hora_local = gmdate("H:i:s", $time);
		$hora = substr($hora_local,0,2).substr($hora_local,2,3);
		$hr_log = $hora;
		$id_acao = 1;
		$nm_objeto = "Ocorrência";
		$nu_ip = getenv("REMOTE_ADDR");
		$mobile = FALSE;
   		$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric"); 
   		foreach($user_agents as $user_agent){
     	if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
        $mobile = TRUE;
		$modelo	= $user_agent;
		break;
     	}
   		} 
   		if ($mobile){
      		$nm_dispositivo = strtolower($modelo);
   				}else{
      			$nm_dispositivo = "Computador";
   		}
		
		$inserir = mysql_query("INSERT INTO logs (dt_log,hr_log,id_acao,nm_objeto,id_usuario,nu_ip,nm_dispositivo) 
		VALUES('".$dt_log."','".$hr_log."',".$id_acao.",'".$nm_objeto."',".$_SESSION['id_usuario'].",'".$nu_ip."','".$nm_dispositivo."')")
		or die("Erro 8");
	  
	
  		$msg_sucesso = "Registro gravado com sucesso";
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;	
		$_SESSION['msg_sucesso'] = $msg_sucesso;	
		header ("location: ../ocorrencia.php");
  }
  
  public function excluirOcorrencia($id_ocorrencia,$documemnto,$te_imagem,$opcao){
  
   
  if ( ($te_imagem != "") && (!unlink($documemnto)) ){
		$msg_excessao = "Arquivo inválido";
		//$_SESSION['arquivo'] = $documemnto;
		$_SESSION['msg_excessao'] = $documemnto;
		if ($opcao == 2){		
		header ("location: ../ocorrencia_lista.php");		
		} else {		
		header ("location: ../ocorrencia.php");
		}
		} else {
		
	// log ******************************************* 
		$dt_log = date("Y-m-d");
		$time = mktime(date('H')-3, date('i'), date('s'));
		$hora_local = gmdate("H:i:s", $time);
		$hora = substr($hora_local,0,2).substr($hora_local,2,3);
		$hr_log = $hora;
		$id_acao = 3;
		$nm_objeto = "Ocorrência";
		$nu_ip = getenv("REMOTE_ADDR");
		$mobile = FALSE;
   		$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric"); 
   		foreach($user_agents as $user_agent){
     	if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
        $mobile = TRUE;
		$modelo	= $user_agent;
		break;
     	}
   		} 
   		if ($mobile){
      		$nm_dispositivo = strtolower($modelo);
   				}else{
      			$nm_dispositivo = "Computador";
   		}
		
		$inserir = mysql_query("INSERT INTO logs (dt_log,hr_log,id_acao,nm_objeto,id_usuario,nu_ip,nm_dispositivo) 
		VALUES('".$dt_log."','".$hr_log."',".$id_acao.",'".$nm_objeto."',".$_SESSION['id_usuario'].",'".$nu_ip."','".$nm_dispositivo."')")
		or die("Erro 8");

	 $excluir = mysql_query("DELETE FROM ocorrencias WHERE id_ocorrencia = ".$id_ocorrencia."") or die ("Erro 9");
  
  	$msg_sucesso = "Registro excluido com sucesso";
	unset($_SESSION['id_ocorrencia']);
	$_SESSION['msg_sucesso'] = $msg_sucesso;
	$_SESSION['arquivo'] = $arquivo;
		
	if ($opcao == 2){		
		header ("location: ../ocorrencia_lista.php");		
		} else {		
		header ("location: ../ocorrencia.php");
		}
  }
  }
  public function editarOcorrencia($id_ocorrencia,$id_assunto,$dt_relato,$hr_relato,$te_relato,$te_relato_dir,$te_imagem,$opcao,$checkbox,$st_relato,$nm_usuario_dir){
  
 		$arq = substr($te_imagem,13);
	 //	$arq = basename($te_imagem);
  		$dt_relato = substr($dt_relato,6,4)."-".substr($dt_relato,3,2)."-".substr($dt_relato,0,2);
		//$st_relato = 1;
		//$te_relato_dir = $te_relato_dir." Ass. ".$_SESSION['nm_usuario'];
		$altera = mysql_query("UPDATE ocorrencias SET id_assunto = ".$id_assunto." WHERE id_ocorrencia = ".$id_ocorrencia." ") or die("Erro 10");
		$altera = mysql_query("UPDATE ocorrencias SET te_relato = '".$te_relato."' WHERE id_ocorrencia = ".$id_ocorrencia." ") or die("Erro 10.1");
		$altera = mysql_query("UPDATE ocorrencias SET te_relato_dir = '".$te_relato_dir."' WHERE id_ocorrencia = ".$id_ocorrencia." ") or die("Erro 10.2");
		$altera = mysql_query("UPDATE ocorrencias SET nm_diretor = '".$nm_usuario_dir."' WHERE id_ocorrencia = ".$id_ocorrencia." ") or die("Erro 10.3");
		$altera = mysql_query("UPDATE ocorrencias SET st_relato = ".$st_relato." WHERE id_ocorrencia = ".$id_ocorrencia." ") or die("Erro 10.4");
		if ($checkbox){
		$altera = mysql_query("UPDATE ocorrencias SET te_imagem = '".$arq."' WHERE id_ocorrencia = ".$id_ocorrencia." ") or die("Erro 10.5");
		}
  		$msg_sucesso = "Registro editado com sucesso";
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;	
		$_SESSION['msg_sucesso'] = $msg_sucesso;
		
		if ($opcao == 2){		
		header ("location: ../ocorrencia_lista.php");		
		} else {		
		header ("location: ../ocorrencia_edit.php");
		}
  }
  }
?>