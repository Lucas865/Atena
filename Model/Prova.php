<?php
	class Prova{
		private $data;
		private $cod;
		private $fk_user_cod;
		private $titulo;

		public function getData(){
			return $this->data;
		}
		public function getCod(){
			return $this->cod;
		}
		
		public function setData($data){
			$this->data=$data;
		}
		public function setCod($cod){
			$this->cod=$cod;
		}
		public function setFk_user_cod($fk_user_cod){
			$this->fk_user_cod=$fk_user_cod;
		}
		public function getFk_user_cod(){
			return $this->fk_user_cod;
		}
		public function setTitulo($titulo){
			$this->titulo=$titulo;
		}
		public function getTitulo(){
			return $this->titulo;
		}

	}
	?>