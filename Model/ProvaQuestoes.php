<?php
	class ProvaQuestoes{

		private $fk_prova_cod;
 		private $cod;
 		private $fk_questoes_cod;
 				
		public function getFk_prova_cod(){
			return $this->fk_prova_cod;
		}
		public function getCod(){
			return $this->cod;
		}
		public function getFk_questoes_cod(){
			return $this->fk_questoes_cod;
		}
		
		public function setFk_prova_cod($fk_prova_cod){
			$this->fk_prova_cod=$fk_prova_cod;
		}
		public function setCod($cod){
			$this->cod=$cod;
		}
		public function setFk_questoes_cod($fk_questoes_cod){
			$this->fk_questoes_cod=$fk_questoes_cod;
		}
		
	}
?>