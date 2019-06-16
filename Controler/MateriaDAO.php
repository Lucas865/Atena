<?php
	/* @Autor: Dalker Pinheiro
	   Classe DAO */
	   
class MateriaDAO{

	//Carrega um elemento pela chave primária
	public function carregar($cod){
		include("../Config/conexao.php");
		$sql = 'SELECT * FROM materias WHERE cod = :cod';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(":cod",$cod);
		$consulta->execute();
		return ($consulta->fetchAll(PDO::FETCH_ASSOC));
	}

	//Lista todos os elementos da tabela
	public function listarTodos(){
		include("../Config/conexao.php");
		$sql = 'SELECT * FROM materias';
		$consulta = $conexao->prepare($sql);
		$consulta->execute();
		return ($consulta->fetchAll(PDO::FETCH_ASSOC));
	}
	
	//Lista todos os elementos da tabela listando ordenados por uma coluna específica

	//Apaga um elemento da tabela
	public function deletar($cod){
		include("../Config/conexao.php");
		$sql = 'DELETE FROM materias WHERE cod = :cod';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(":cod",$cod);
		if($consulta->execute())
			return true;
		else
			return false;
	}
	
	//Insere um elemento na tabela
	public function inserir($materia){
		include("../Config/conexao.php");
		$sql = 'INSERT INTO materias (cod, nome) VALUES (:cod, :nome)';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(':cod',$materia->getCod()); 
		$consulta->bindValue(':nome',$materia->getNome()); 
		if($consulta->execute())
			return true;
		else
			return false;
	}
	
	//Atualiza um elemento na tabela
	public function atualizar($materia){
		include("../Config/conexao.php");
		$sql = 'UPDATE materias SET cod = :cod, nome = :nome WHERE cod = :cod';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(':cod',$materia->getCod()); 
		$consulta->bindValue(':nome',$materia->getNome()); 
		if($consulta->execute())
			return true;
		else
			return false;
	}

}
?>