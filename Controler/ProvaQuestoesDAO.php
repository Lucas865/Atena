<?php
	class ProvaQuestoesDAO{
		public function carregar($cod){
			include("../Config/conexao.php");
			$sql = 'SELECT * FROM questoes_prova WHERE fk_prova_cod = :cod';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(":cod",$cod);
			$consulta->execute();
			return ($consulta->fetchAll(PDO::FETCH_ASSOC));
		}
		public function listarTodosOrgenandoPor($coluna){
			include("../Config/conexao.php");
			$sql = 'SELECT * FROM questoes_prova ORDER BY '.$coluna;
			$consulta = $conexao->prepare($sql);
			$consulta->execute();
			return ($consulta->fetchAll(PDO::FETCH_ASSOC));
		}
		public function inserir($questoes_prova){
			include("../Config/conexao.php");
			$sql = 'INSERT INTO questoes_prova (fk_prova_cod, fk_questoes_cod) VALUES (:fk_prova_cod, :fk_questoes_cod)';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(':fk_prova_cod',$questoes_prova->getFk_prova_cod()); 
			$consulta->bindValue(':fk_questoes_cod',$questoes_prova->getFk_questoes_cod()); 
			if($consulta->execute())
				return true;
			else
				return false;
		}
	}
	?>