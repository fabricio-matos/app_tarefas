<?php
	
	
	
	require "../../app_lista_tarefas/tarefa.model.php";
	require "../../app_lista_tarefas/tarefa.service.php";
	require "../../app_lista_tarefas/conexao.php";
	
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	//echo $acao;
	
	if ($acao == 'inserir') {
	//echo '<pre>';
	//print_r($_POST);
	//echo '</pre>';

	$tarefa = new Tarefa();
	$tarefa->__set('tarefa', $_POST['tarefa']);

	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefaService->inserir();
	header('Location: nova_tarefa.php?inclusao=1');
	//echo '<pre>';
	//print_r($tarefaService);
	//echo '</pre>';
	}else if($acao == 'recuperar') {
		$tarefa = new Tarefa();
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperar();// variavel tarefa recebe o resultado da consulta
	}else if($acao == 'atualizar') {
		
		$tarefa = new Tarefa();
		// quando o metodo e retornado pode se fazer um set colado no outro
		$tarefa->__set('id',$_POST['id'])->__set('tarefa',$_POST['tarefa']);

		//$tarefa->__set('id',$_POST['id']);
		//$tarefa->__set('tarefa',$_POST['tarefa']);

		$conexao = new Conexao();
			
		$tarefaService = new TarefaService($conexao, $tarefa);
		if($tarefaService->atualizar()) {
		 	header('location: todas_tarefas.php'); //redirecionando para 
		 } 


		
	}else if($acao == 'remover') {

		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->remover();

		header('location: todas_tarefas.php');
	}else if($acao == 'marcarRealizada') {
		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id'])->__set('id_status', 2);

		$conexao = new Conexao();
		
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->marcarRealizada();
		header('location: todas_tarefas.php');
	
	}else if($acao == 'recuperarTarefasPendentes') {
		$tarefa = new Tarefa();
		$tarefa->__set('id_status',1);

		$conexao = new Conexao();
		
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperarTarefasPendentes();
?>