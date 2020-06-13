<?php 
session_start();
require_once("../class/persistence.php");
$persistence = new Persistence();

if ( isset($_POST['logar']) ) {
	
		$nm_login = trim(addslashes($_POST['login']));
		$nm_senha = trim(addslashes($_POST['senha']));
	
		$persistence->logar($nm_login,$nm_senha);
	}
if ( isset($_GET['novoUsuario']) ) {		
		unset($_SESSION['nm_usuario']);
		unset($_SESSION['nm_login']);
		unset($_SESSION['nm_senha']);
		unset($_SESSION['re_senha']);
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		header ("location: ../usuario.php");
	}
if ( isset($_GET['logout']) ) {
	session_destroy();
	
	header ("location: ../index.php");
	}
	
if ( isset($_GET['abrirBackup']) )  {
	unset($_SESSION['msg_sucesso']);
	unset($_SESSION['msg_excessao']);
		
	header ("location: ../backup.php");
	}

if ( isset($_GET['excluirArquivo']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		$arquivo = $_GET['arquivo'];
		
		if ( !unlink($arquivo) ){
		$msg_excessao = "Erro";
		$_SESSION['msg_excessao'] = $msg_excessao;
		} else {
		$msg_sucesso = "Excluido com sucesso";
		$_SESSION['msg_sucesso'] = $msg_sucesso;
		header ("location: ../backup.php");
		}
	}

if ( isset($_POST['inserirUsuario']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		$nm_usuario = trim(addslashes($_POST['nm_usuario']));
		$nm_usuario = strtoupper($nm_usuario);
		$id_sexo = addslashes($_POST['id_sexo']);
		$nm_sexo = addslashes($_POST['nm_sexo']);
		$nu_cpf = addslashes($_POST['nu_cpf']);
		$nu_lote = addslashes($_POST['nu_lote']);
		$nm_quadra = addslashes($_POST['nm_quadra']);
		$nm_quadra = strtoupper($nm_quadra);
		$nm_login = trim(addslashes($_POST['nm_login']));
		$nm_senha = addslashes($_POST['nm_senha']);
		$re_senha = addslashes($_POST['re_senha']);
		$termo = addslashes($_POST['termo']);
		
		if ($nm_usuario == ""){
		$msg_excessao = "Nome: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;		
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ($nu_cpf == ""){
		$msg_excessao = "CPF: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ($persistence->validarCpfUsuario($nu_cpf)){
		$msg_excessao = "CPF j� cadastrado";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ($nu_lote == ""){
		$msg_excessao = "Lote: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ( !is_numeric($nu_lote)){
		$msg_excessao = "Lote: Somente n�mero";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ($persistence->validarEmail($nm_login)	){
		$msg_excessao = "Email j� cadastrado";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
				
		
		} else if ($nm_quadra == ""){
		$msg_excessao = "Quadra: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ($nm_login == ""){
		$msg_excessao = "E-mail: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ( !ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$nm_login) ){
		$msg_excessao = "E-mail: Inv�lido.";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ($nm_senha == ""){
		$msg_excessao = "Senha: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
		
		} else if ( ($nm_senha) != ($re_senha)){
		$msg_excessao = "Senha diferente: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");
	
		} else if ($termo == ""){
		$msg_excessao = "Marque Termos e condi��es de uso";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['id_sexo'] = $id_sexo;
		$_SESSION['nm_sexo'] = $nm_sexo;
		$_SESSION['nu_cpf'] = $nu_cpf;
		$_SESSION['nu_lote'] = $nu_lote;
		$_SESSION['nm_quadra'] = $nm_quadra;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['nm_senha'] = $nm_senha;
		$_SESSION['re_senha'] = $re_senha;
		$_SESSION['termo'] = $termo;
		header ("location: ../usuario.php");		
	} else {
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['nm_usuario']);
		unset($_SESSION['id_sexo']);
		unset($_SESSION['nm_sexo']);
		unset($_SESSION['nu_cpf']);
		unset($_SESSION['nu_lote']);
		unset($_SESSION['nm_quadra']);
		unset($_SESSION['nm_login']);
		unset($_SESSION['nm_senha']);
		unset($_SESSION['re_senha']);
		unset($_SESSION['termo']);
	
	$persistence->inserirUsuario($nm_usuario,$id_sexo,$nu_cpf,$nu_lote,$nm_quadra,$nm_login,$nm_senha);
	}
	}
if ( isset($_POST['alterarUsuario']) ) {
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		$id_usuario = addslashes($_POST['id_usuario']);
		$nm_usuario = addslashes($_POST['nm_usuario']);
		$nm_login = addslashes($_POST['nm_login']);
		$nm_senha = addslashes($_POST['nm_senha']);
		$re_senha = addslashes($_POST['re_senha']);
		$id_status = addslashes($_POST['id_status']);
		
		if ($nm_senha != $re_senha){
		$msg_excessao = "Campo Senha diferente";
		$_SESSION['nm_usuario'] = $nm_usuario;
		$_SESSION['nm_login'] = $nm_login;
		$_SESSION['msg_excessao'] = $msg_excessao;
		header ("location: ../usuario_edit.php");
		} else {
		unset($_SESSION['nm_usuario']);
		unset($_SESSION['nm_login']);
		unset($_SESSION['msg_excessao']);
		$persistence->alterarUsuario($id_usuario,$nm_usuario,$nm_login,$id_status);
		}
		}
		
if ( isset($_GET['abrirUsuarioLista']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		header ("location: ../usuario_lista.php");
	}
	
if ( isset($_GET['abrirUsuarioAlt']) ) {		
	   unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['opcao']);
		unset($_SESSION['in_status']);
		$id_usuario = addslashes($_GET['id_usuario']);
		$_SESSION['id_usuario'] = $id_usuario;
		header ("location: ../usuario_edit.php");
	}
	
if ( isset($_GET['abrirBoasVindas']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_macom']);
		unset($_SESSION['nm_macom']);
		unset($_SESSION['opcao']);
		
		$id_usuario = addslashes($_GET['id_usuario']);
		$_SESSION['id_usuario'] = $id_usuario;
		
		header ("location: ../boas_vindas.php");
	}	
	
if ( isset($_GET['abrirUsuarioNovo']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['te_email']);
		unset($_SESSION['nu_cpf']);
		unset($_SESSION['opcao']);
		unset($_SESSION['nu_telefone']);
				
		header ("location: ../usuario_novo.php");
	}
if ( isset($_GET['gerarConta']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['te_email']);
		unset($_SESSION['nu_cpf']);
		unset($_SESSION['nu_telefone']);
		$email = addslashes($_GET['email']);
		$nome = addslashes($_GET['nome']);
		
		$persistence->gerarConta($email,$nome);
		
	}
if ( isset($_GET['abrirSenhaLista']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		$id_usuario_log = addslashes($_GET['id_usuario_log']);
		$_SESSION['id_usuario_log'] = $id_usuario_log;
		
		header ("location: ../senha_lista.php");
	}
if ( isset($_GET['abrirSenha']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		$id_usuario = addslashes($_GET['id_usuario']);
		$_SESSION['id_usuario'] = $id_usuario;
		header ("location: ../senha.php");
	}

if ( isset($_POST['editarSenha']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		$id_usuario = addslashes($_POST['id_usuario']);
		$nm_senha = addslashes($_POST['nm_senha']);
		$re_senha = addslashes($_POST['re_senha']);
		
		if ( $nm_senha == "" ){
		$msg_excessao = "Senha: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;		
		header ("location: ../senha.php");
		
		} else if ( $nm_senha != $re_senha ){
		$msg_excessao = "Senhas diferentes";
		$_SESSION['msg_excessao'] = $msg_excessao;		
		header ("location: ../senha.php");
		} else {
		
		$persistence->editarSenha($id_usuario,$nm_senha);
		}
	}
if ( isset($_POST['editarSenha']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		$id_usuario = addslashes($_POST['id_usuario']);
		$nm_senha = addslashes($_POST['nm_senha']);
		$re_senha = addslashes($_POST['re_senha']);
		
		if ( $nm_senha == "" ){
		$msg_erro = "Senha: Preenchimento obrigat�rio";
		$_SESSION['msg_excessao'] = $msg_excessao;		
		header ("location: ../senha.php");
		
		} else if ( $nm_senha != $re_senha ){
		$msg_excessao = "Senhas diferentes";
		$_SESSION['msg_excessao'] = $msg_excessao;		
		header ("location: ../senha.php");
		} else {
		
		$persistence->editarSenha($id_usuario,$nm_senha);
		}
		}

if ( isset($_GET['excluirUsuario']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		$opcao = addslashes($_GET['opcao']);
		$id_usuario = addslashes($_GET['id_usuario']);
		
		if ( $persistence->validarExcluirUsuario($id_usuario) ){
		$msg_excessao = "Exclus�o n�o permitida";
		$_SESSION['msg_excessao'] = $msg_excessao;
		//$_SESSION['id_tipo'] = $id_tipo;
		//$_SESSION['nm_produto'] = $nm_produto;
		header ("location: ../usuario_lista.php");
		
		/*} else if ( $id_usuario != $_SESSION['id_usuario'] ){
		$msg_excessao = "Opera��o n�o permitida";
		$_SESSION['msg_excessao'] = $msg_excessao;
		//$_SESSION['id_tipo'] = $id_tipo;
		//$_SESSION['nm_produto'] = $nm_produto;
		header ("location: ../usuario_lista.php");		
		*/
		} else {
				
		$persistence->excluirUsuario($id_usuario,$opcao);
	}
	}


	if ( isset($_GET['copiarDados']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
				
		$persistence->copiarDados();
		
		}
if ( isset($_GET['abrirInformacoes']) ) {		
		unset($_SESSION['nm_usuario']);
		unset($_SESSION['nm_login']);
		unset($_SESSION['nm_senha']);
		unset($_SESSION['re_senha']);
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_erro']);
		header ("location: ../informacoes.php");
	}
	
if ( isset($_GET['abrirLogLista']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		header ("location: ../log_lista.php");
	}
	
if ( isset($_GET['imprimirLogLista']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		header ("location: ../log_lista_pdf.php");
	}

if ( isset($_GET['imprimirContrato']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		header ("location: ../contrato_uso_resumido.pdf");
	}
	
if ( isset($_GET['imprimirContratoOnline']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		header ("location: ../contrato_online_resumido.pdf");
	}


if ( isset($_GET['abrirRecibo']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		
		header ("location: ../recibo.php");
	}

if ( isset($_POST['inserirRecibo']) ) {
                
        unset($_SESSION['msg_sucesso']);
        unset($_SESSION['msg_excessao']);
        
        $nu_valor = addslashes($_POST['nu_valor']);
		$te_correspondente = addslashes($_POST['te_correspondente']);
        
        if ($nu_valor == ""){
        $msg_excessao = "Valor R$: Preenchimento obrigat�rio";
        $_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nu_valor'] = $nu_valor;
		$_SESSION['te_correspondente'] = $te_correspondente;
		
        header ("location: ../recibo.php");
		
		} else if ($te_correspondente == ""){
        $msg_excessao = "Correspondente: Preenchimento obrigat�rio";
        $_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['nu_valor'] = $nu_valor;
		$_SESSION['te_correspondente'] = $te_correspondente;
        
        header ("location: ../recibo.php");
      
        } else {
        unset($_SESSION['msg_excessao']);
        unset($_SESSION['nu_valor']);
		unset($_SESSION['te_correspondente']);
        $persistence->inserirRecibo($nu_valor,$te_correspondente);
        }
    
}

?>