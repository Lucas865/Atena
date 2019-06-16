<?php

	/* @Autor: Dalker Pinheiro
	   Classe DAO */
	   
class AssuntoDAO{

	//Carrega um elemento pela chave primária
	public function carregar($cod){
		include("../Config/conexao.php");
		$sql = 'SELECT * FROM assuntos WHERE fk_materias_cod = :cod';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(":cod",$cod);
		$consulta->execute();
		return ($consulta->fetchAll(PDO::FETCH_ASSOC));
	}
		public function carregarCod($cod){
		include("../Config/conexao.php");
		$sql = 'SELECT * FROM assuntos WHERE cod = :cod';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(":cod",$cod);
		$consulta->execute();
		return ($consulta->fetchAll(PDO::FETCH_ASSOC));
	}

	//Lista todos os elementos da tabela
	public function listarTodos(){
		include("../Config/conexao.php");
		$sql = 'SELECT * FROM assuntos';
		$consulta = $conexao->prepare($sql);
		$consulta->execute();
		return ($consulta->fetchAll(PDO::FETCH_ASSOC));
	}
	

	//Apaga um elemento da tabela
	public function deletar($cod){
		include("../Config/conexao.php");
		$sql = 'DELETE FROM assuntos WHERE cod = :cod';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(":cod",$cod);
		if($consulta->execute())
			return true;
		else
			return false;
	}
	
	//Insere um elemento na tabela
	public function inserir($assunto){
		include("../Config/conexao.php");
		$sql = 'INSERT INTO assuntos (cod, nome, fk_materias_cod) VALUES (:cod, :nome, :fk_materias_cod)';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(':cod',$assunto->getCod()); 
		$consulta->bindValue(':nome',$assunto->getNome()); 
		$consulta->bindValue(':fk_materias_cod',$assunto->getFk_materias_cod()); 
		if($consulta->execute())
			return true;
		else
			return false;
	}
	
	//Atualiza um elemento na tabela
	public function atualizar($assunto){
		include("../Config/conexao.php");
		$sql = 'UPDATE assuntos SET  nome = :nome WHERE cod = :cod';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(':cod',$assunto->getCod()); 
		$consulta->bindValue(':nome',$assunto->getNome());
		if($consulta->execute())
			return true;
		else
			return false;
	}

}
?>