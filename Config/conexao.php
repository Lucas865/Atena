<?php
$servidor = "localhost";
$usuario_db = "root";
$senha = "";
$nomeDoBanco = "atena";
try {
	$conexao = new PDO("mysql:dbname=$nomeDoBanco; host=$servidor", $usuario_db, $senha);
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conexao -> exec("SET CHARACTER SET utf8");
} catch(PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();
}
?>	
