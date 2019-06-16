<?php

	/* @Autor: Dalker Pinheiro
	Classe DAO */

	class QuestoesDAO{

	//Carrega um elemento pela chave primária
		public function carregar($cod){
			include("../Config/conexao.php");
			$sql = 'SELECT * FROM questoes WHERE fk_assunto_cod = :cod';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(":cod",$cod);
			$consulta->execute();
			return ($consulta->fetchAll(PDO::FETCH_ASSOC));
		}
		public function carregarCod($cod){
			include("../Config/conexao.php");
			$sql = 'SELECT * FROM questoes WHERE cod = :cod';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(":cod",$cod);
			$consulta->execute();
			return ($consulta->fetchAll(PDO::FETCH_ASSOC));
		}
		public function carregarQ($cod){
			include("../Config/conexao.php");
			$sql = 'SELECT * FROM questoes WHERE cod = :cod';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(":cod",$cod);
			$consulta->execute();
			return ($consulta->fetchAll(PDO::FETCH_ASSOC));
		}
	//Lista todos os elementos da tabela
		public function listarTodos(){
			include("../Config/conexao.php");
			$sql = 'SELECT * FROM questoes';
			$consulta = $conexao->prepare($sql);
			$consulta->execute();
			return ($consulta->fetchAll(PDO::FETCH_ASSOC));
		}


	//Apaga um elemento da tabela
		public function deletar($cod){
			include("../Config/conexao.php");
			$sql = 'DELETE FROM questoes WHERE cod = :cod';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(":cod",$cod);
			if($consulta->execute()){
				echo("<script>location.href='../view/verquestoes.php';</script>");
			}
			else{
				return false;
			}
		}

	//Insere um elemento na tabela
		public function inserir($questoes){
			include("../Config/conexao.php");
			$sql = 'INSERT INTO questoes (cod, corpo, imagem, fk_assunto_cod,comando,item_a,item_b,item_c,item_d,item_e) VALUES (:cod, :corpo, :imagem, :fk_assunto_cod,:comando,:item_a,:item_b,:item_c,:item_d,:item_e)';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(':cod',$questoes->getCod()); 
			$consulta->bindValue(':corpo',$questoes->getCorpo()); 
			$consulta->bindValue(':imagem',$questoes->getImagem()); 
			$consulta->bindValue(':fk_assunto_cod',$questoes->getFk_assunto_cod());
			$consulta->bindValue(':item_a',$questoes->getItem_a());
			$consulta->bindValue(':item_b',$questoes->getItem_b()); 
			$consulta->bindValue(':item_c',$questoes->getItem_c()); 
			$consulta->bindValue(':item_d',$questoes->getItem_d());  
			$consulta->bindValue(':item_e',$questoes->getItem_e()); 
			$consulta->bindValue(':comando',$questoes->getComando());
			if($consulta->execute())
				return true;
			else
				return false;
		}

	//Atualiza um elemento na tabela
		public function atualizar($questoes,$cod){
			include("../Config/conexao.php");
			$sql = 'UPDATE questoes SET corpo = :corpo,imagem =  :imagem, fk_assunto_cod = :fk_assunto_cod, item_a = :item_a, item_b = :item_b, item_c = :item_c, item_d = :item_d, item_e = :item_e, comando = :comando WHERE  cod = :cod';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(':cod',$cod); 
			$consulta->bindValue(':corpo',$questoes->getCorpo()); 
			$consulta->bindValue(':imagem',$questoes->getImagem()); 
			$consulta->bindValue(':fk_assunto_cod',$questoes->getFk_assunto_cod());
			$consulta->bindValue(':item_a',$questoes->getItem_a());
			$consulta->bindValue(':item_b',$questoes->getItem_b()); 
			$consulta->bindValue(':item_c',$questoes->getItem_c()); 
			$consulta->bindValue(':item_d',$questoes->getItem_d());  
			$consulta->bindValue(':item_e',$questoes->getItem_e()); 
			$consulta->bindValue(':comando',$questoes->getComando());
			if($consulta->execute()){
				echo("<script>alert('Editou');</script>");
				echo("<script>location.href='verquestoes.php';</script>");
				unset($_SESSION['cod_ed']);
			}else{
				return false;
			}
		}


	}
	?>