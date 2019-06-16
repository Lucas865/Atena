<?php
class Cronjob{
	public function Deletar(){
		include("../Config/conexao.php");
		$sql = 'DELETE FROM questoes_prova WHERE fk_prova_cod  is null';
		$consulta = $conexao->prepare($sql);
		$consulta->execute();
	}
}
$cronjob = new Cronjob();
$cronjob->Deletar();
?>