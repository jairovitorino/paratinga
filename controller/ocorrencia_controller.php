<?php 
session_start();
require_once("../class/persistence.php");
$persistence = new Persistence();

	
if ( isset($_GET['testarRadio']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['arquivo']);	
		
		
		header ("location: ../ocorrencia.php");
	}
	
	if ( isset($_GET['abrirOcorrencia']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['arquivo']);	
		
		//$id_associado = addslashes($_GET['id_associado']);		
		
		//$persistence->abrirBloco($id_associado);
		header ("location: ../ocorrencia.php");
	}
	
	if ( isset($_POST['inserirOcorrencia']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);	
		
		$id_assunto = addslashes($_POST['id_assunto']);
		$nm_assunto = addslashes($_POST['nm_assunto']);
		$dt_relato = addslashes($_POST['dt_relato']);
		$hr_relato = addslashes($_POST['hr_relato']);
		$te_relato = trim(addslashes($_POST['te_relato']));
		$te_imagem = addslashes($_POST['te_imagem']);
		
		$upextensao['extensoes'] = array('jpg','pdf','doc','docx');
		$extensao = strtolower(end(explode('.', $_FILES['upload']['name'])));
		$uptamanho['tamanho'] = 2097152; // 2Mb
		
		$imagem = $_FILES["upload"]["name"]; //pega o nome do arquivo
   		$temp_imagem = $_FILES["upload"]["tmp_name"]; //pega o "temp" do arquivo
   		$tipo = $_FILES["upload"]["type"]; //pega o tipo do arquivo
   		$tamanho = $_FILES["upload"]["size"]; //pega o tamanho do arquivo
   		$t_maximo = 2000000; //tamanho máximo do arquivo - em bytes
   		$uploaddir = '../arquivos/';
		$uploadfile = $uploaddir . $_FILES['upload']['name'];
		
		if ( $id_assunto == 0 ){
		$msg_excessao = "Assunto: Preenchimento obrigatório";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		
		header ("location: ../ocorrencia.php");
		
		} else if ( $dt_relato == "" ){
		$msg_excessao = "Data: Preenchimento obrigatório";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		header ("location: ../ocorrencia.php");
		
		} else if ( $hr_relato == "" ){
		$msg_excessao = "Hora: Preenchimento obrigatório";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		header ("location: ../ocorrencia.php");
		
		} else if ( $te_relato == "" ){
		$msg_excessao = "Relato: Preenchimento obrigatório";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		header ("location: ../ocorrencia.php");
		
		} else if ( $tamanho > $t_maximo ){
		$msg_excessao = "Arquivo: tamanho máximo permitido é de 2MB";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		header ("location: ../ocorrencia.php");	
		
		} else if ( ($imagem != "") && (file_exists("$uploaddir"."$imagem")) ){	
		$msg_excessao = "Já existe um arquivo com este nome $imagem, por favor, renomeie-o";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		header ("location: ../ocorrencia.php");		
		
		} else {				
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['dt_relato']);
		unset($_SESSION['hr_relato']);
		unset($_SESSION['te_relato']);		
		move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile) ;
			
		$persistence->inserirOcorrencia($id_assunto,$dt_relato,$hr_relato,$te_relato,$te_imagem);
	
	}
	}
	
	if ( isset($_GET['abrirOcorrenciaEdit']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['arquivo']);	
		
		$id_ocorrencia = addslashes($_GET['id_ocorrencia']);
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;
		$opcao = addslashes($_GET['opcao']);		
		$_SESSION['opcao'] = $opcao;
		
		header ("location: ../ocorrencia_edit.php");
	}
	
	if ( isset($_POST['editarOcorrencia']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);	
		
		$id_assunto = addslashes($_POST['id_assunto']);
		$nm_assunto = addslashes($_POST['nm_assunto']);
		$dt_relato = addslashes($_POST['dt_relato']);
		$hr_relato = addslashes($_POST['hr_relato']);
		$te_relato = trim(addslashes($_POST['te_relato']));
		$te_relato_dir = trim(addslashes($_POST['te_relato_dir']));
		$te_imagem = addslashes($_POST['te_imagem']);
		$id_ocorrencia = addslashes($_POST['id_ocorrencia']);
		$opcao = addslashes($_POST['opcao']);
		$checkbox = addslashes($_POST['checkbox']);
		$st_relato = addslashes($_POST['st_relato']);
		$nm_usuario_dir = addslashes($_POST['nm_usuario_dir']);
		
		$upextensao['extensoes'] = array('jpg','pdf','doc','docx','mp4');
		$extensao = strtolower(end(explode('.', $_FILES['upload']['name'])));
		$uptamanho['tamanho'] = 2097152; // 2Mb
		
		$imagem = $_FILES["upload"]["name"]; //pega o nome do arquivo
   		$temp_imagem = $_FILES["upload"]["tmp_name"]; //pega o "temp" do arquivo
   		$tipo = $_FILES["upload"]["type"]; //pega o tipo do arquivo
   		$tamanho = $_FILES["upload"]["size"]; //pega o tamanho do arquivo
   		$t_maximo = 4000000; //tamanho máximo do arquivo - em bytes
   		$uploaddir = '../arquivos/';
		$uploadfile = $uploaddir . $_FILES['upload']['name'];
		
		if ( $id_assunto == 0 ){
		$msg_excessao = "Assunto: Preenchimento obrigatório";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		$_SESSION['te_relato_dir'] = $te_relato_dir;		
		header ("location: ../ocorrencia_edit.php");
		
		} else if ( $dt_relato == "" ){
		$msg_excessao = "Data: Preenchimento obrigatório";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		$_SESSION['te_relato_dir'] = $te_relato_dir;		
		header ("location: ../ocorrencia_edit.php");
		
		} else if ( $hr_relato == "" ){
		$msg_excessao = "Hora: Preenchimento obrigatório";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		$_SESSION['te_relato_dir'] = $te_relato_dir;		
		header ("location: ../ocorrencia_edit.php");
		
		} else if ( $te_relato == "" ){
		$msg_excessao = "Relato: Preenchimento obrigatório";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		$_SESSION['te_relato_dir'] = $te_relato_dir;		
		header ("location: ../ocorrencia_edit.php");
		
		} else if ( ($te_relato_dir != "") && ($st_relato == 0) ){
		$msg_excessao = "Status: Marque Resolvido ou Análise";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		$_SESSION['te_relato_dir'] = $te_relato_dir;		
		header ("location: ../ocorrencia_edit.php");
		
		} else if ( $tamanho > $t_maximo ){
		$msg_excessao = "Arquivo: tamanho máximo permitido é de 2MB";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		$_SESSION['te_relato_dir'] = $te_relato_dir;		
		header ("location: ../ocorrencia_edit.php");		
				
		/*} else if ( ($imagem) && (file_exists("$uploaddir"."$imagem")) ){				
		$msg_excessao = "Já existe um arquivo com este nome $imagem, por favor, renomeie-o";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_assunto'] = $id_assunto;
		$_SESSION['nm_assunto'] = $nm_assunto;
		$_SESSION['dt_relato'] = $dt_relato;
		$_SESSION['hr_relato'] = $hr_relato;
		$_SESSION['te_relato'] = $te_relato;
		header ("location: ../ocorrencia_edit.php");		
		*/
		} else {
		unset($_SESSION['te_relato_dir']);
		move_uploaded_file($_FILES['upload']['tmp_name'], $uploadfile) ;
		
		$persistence->editarOcorrencia($id_ocorrencia,$id_assunto,$dt_relato,$hr_relato,$te_relato,$te_relato_dir,$te_imagem,$opcao,$checkbox,$st_relato,$nm_usuario_dir);
		}
		}
	
	if ( isset($_GET['excluirOcorrencia']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);	
		
		$id_ocorrencia = addslashes($_GET['id_ocorrencia']);
		$opcao = addslashes($_GET['opcao']);
		$te_imagem = addslashes($_GET['te_imagem']);
				
		if ( $persistence->validarExcluirOcorrencia($id_ocorrencia) ){
		$msg_excessao = "Exclusão ná permitida";
		$_SESSION['msg_excessao'] = $msg_excessao;
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;		
		if ($opcao == 2){		
		header ("location: ../ocorrencia_lista.php");		
		} else {		
		header ("location: ../ocorrencia.php");
		}
		
		} else {
		
		$arquivo = $te_imagem;
		
		/* Diretorio que deve ser lido */
    	$dir = '../arquivos/';   	 
		$documemnto = $dir.$arquivo; 
			
		$persistence->excluirOcorrencia($id_ocorrencia,$documemnto,$te_imagem,$opcao);
		}
	}
	if ( isset($_GET['abrirOcorrenciaLista']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['arquivo']);		
		
		header ("location: ../ocorrencia_lista.php");
	}
	
if ( isset($_GET['imprimirOcorrenciaLista']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['arquivo']);		
		
		header ("location: ../ocorrencia_lista_pdf.php");
	}
	
if ( isset($_GET['imprimirOcorrenciaRelato']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['arquivo']);
		
		$id_ocorrencia = addslashes($_GET['id_ocorrencia']);		
		$_SESSION['id_ocorrencia'] = $id_ocorrencia;
		header ("location: ../ocorrencia_relato_pdf.php");
	}

if ( isset($_GET['abrirPainel']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['arquivo']);
		
		header ("location: ../painel.php");
	}

if ( isset($_GET['abrirLogLista']) ) {
				
		unset($_SESSION['msg_sucesso']);
		unset($_SESSION['msg_excessao']);
		unset($_SESSION['id_ocorrencia']);
		unset($_SESSION['te_relato']);
		unset($_SESSION['id_assunto']);
		unset($_SESSION['nm_assunto']);
		unset($_SESSION['arquivo']);
		
		$id_acao = addslashes($_GET['id_acao']);		
		$_SESSION['id_acao'] = $id_acao;
		header ("location: ../log_lista.php");
	}

?>