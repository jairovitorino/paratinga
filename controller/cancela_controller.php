<?php
session_start();
require_once("../class/persistence.php");
$persistence = new Persistence();

if ( isset($_GET['cancelarOperacao']) ) {		
	
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_sexo']);
		unset($_SESSION['nm_sexo']);
		unset($_SESSION['id_associado']);
		unset($_SESSION['nm_associado']);
		unset($_SESSION['dt_nascimento']);
		unset($_SESSION['nu_cpf']);
		unset($_SESSION['nu_rg']);
		unset($_SESSION['nu_ano']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['nm_ocorrencia']);
		unset($_SESSION['arquivo']);
		unset($_SESSION['checkbox']);
							
		unset($_SESSION['nu_telefone']);
		unset($_SESSION['nu_whatsapp']);
		unset($_SESSION['nm_logra']);
		unset($_SESSION['nu_logra']);				
		unset($_SESSION['te_email']);
		unset($_SESSION['nm_compl']);
		unset($_SESSION['nm_bairro']);
		unset($_SESSION['nu_cep']);
		unset($_SESSION['nm_cidade']);
		unset($_SESSION['nm_uf']);
		unset($_SESSION['opcao']);
		unset($_SESSION['te_obs']);		
				
		header ("location: ../index.php");
	}


?>