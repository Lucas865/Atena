<?php
	class UsuarioDAO{
		public	function verificaDados($email,$user){
			if (!empty($email)) {
				$bool = false;
				include("../Config/conexao.php");
				$sql ="SELECT email,user FROM usuario  WHERE email = :email or user = :user";
				$verificar = $conexao->prepare($sql);
				$verificar->bindValue(':email',$email);
				$verificar->bindValue(':user',$user);		
				$verificar->execute();	
				$verificar = $verificar->fetchAll(PDO::FETCH_NUM);
				if(count($verificar) > 0 ) {
					return $bool = true;
				}
				return $bool;
			}
		}
		public function listarPorSenha ($user,$password){
			include("../Config/conexao.php");
			$sql = 'SELECT * FROM usuario WHERE passwd = :passwd and user = :user';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(":user",$user);
			$consulta->bindValue(":passwd",$password);
			if ($consulta->execute()){
				return ($consulta->fetchAll(PDO::FETCH_ASSOC));
			}
			else{
				return false;
			}
		}
		public function inserir($usuario){
			include("../Config/conexao.php");
			$sql = 'INSERT INTO usuario (user, passwd, email) VALUES (:user, :passwd, :email)';
			$consulta = $conexao->prepare($sql);
			$consulta->bindValue(':user',$usuario->getUser()); 
			$consulta->bindValue(':passwd',$usuario->getPasswd()); 
			$consulta->bindValue(':email',$usuario->getEmail()); 
			if($consulta->execute())
				return true;
			else
				return false;
		}
	}
?>