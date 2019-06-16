<?php

	/* @Autor: Dalker Pinheiro
	   Atributos e métodos da classe */
	   
	class Materia{
		//Atributos
		private $cod;
 		private $nome;
 				
		//Métodos Getters e Setters
		public function getCod(){
			return $this->cod;
		}
		public function getNome(){
			return $this->nome;
		}
		
		public function setCod($cod){
			$this->cod=$cod;
		}
		public function setNome($nome){
			$this->nome=$nome;
		}
		
	}
?>