<?php

	/* @Autor: Dalker Pinheiro
	Atributos e métodos da classe */

	class Questoes{
		//Atributos
		private $cod;
		private $corpo;
		private $imagem;
		private $fk_assunto_cod;
		private $item_a;
		private $item_b;
		private $item_c;
		private $item_d;
		private $item_e;
		private $comando;

		//Métodos Getters e Setters
		public function getCod(){
			return $this->cod;
		}
		public function getItem_a(){
			return $this->item_a;
		}
		public function getItem_b(){
			return $this->item_b;
		}
		public function getItem_c(){
			return $this->item_c;
		}
		public function getItem_d(){
			return $this->item_d;
		}
		public function getItem_e(){
			return $this->item_e;
		}

		public function getCorpo(){
			return $this->corpo;
		}
		public function getImagem(){
			return $this->imagem;
		}
		public function getFk_assunto_cod(){
			return $this->fk_assunto_cod;
		}
		
		public function setCod($cod){
			$this->cod=$cod;
		}
		public function getComando(){
			return $this->comando;
		}
		
		public function setComando($comando){
			$this->comando=$comando;
		}

		public function setItem_a($item_a){
			$this->item_a=$item_a;
		}
		public function setItem_b($item_b){
			$this->item_b=$item_b;
		}
		public function setItem_c($item_c){
			$this->item_c=$item_c;
		}
		public function setItem_d($item_d){
			$this->item_d=$item_d;
		}
		public function setItem_e($item_e){
			$this->item_e=$item_e;
		}
		public function setCorpo($corpo){
			$this->corpo=$corpo;
		}
		public function setImagem($imagem){
			$this->imagem=$imagem;
		}
		public function setFk_assunto_cod($fk_assunto_cod){
			$this->fk_assunto_cod=$fk_assunto_cod;
		}
		
	}
	?>