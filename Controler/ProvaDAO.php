<?php
class ProvaDAO{
	public function listar($cod){
		include("../Config/conexao.php");
		$sql = 'SELECT * FROM prova WHERE fk_user_cod = :cod ORDER BY cod DESC';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(":cod",$cod);
		$consulta->execute();
		return ($consulta->fetchAll(PDO::FETCH_ASSOC));
	}
	public function deletar($cod){
		include("../Config/conexao.php");
		$sql = 'DELETE FROM prova WHERE cod = :cod';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(":cod",$cod);
		if($consulta->execute()){
			return true;
		}
		else{
			return false;
		}
	}
	public function inserir($prova){
		include("../Config/conexao.php");
		$sql = 'INSERT INTO prova (data,nome,fk_user_cod) VALUES (:data,:titulo,:fk_user_cod)';
		$consulta = $conexao->prepare($sql);
		$consulta->bindValue(':data',$prova->getData()); 
		$consulta->bindValue(':titulo',$prova->getTitulo()); 
		$consulta->bindValue(':fk_user_cod',$prova->getFk_user_cod()); 
		if($consulta->execute())
			return true;
		else
			return false;
	}

}
?>