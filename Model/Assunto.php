<?php

	/* @Autor: Dalker Pinheiro
	   Atributos e métodos da classe */
	   
	class Assunto{
		//Atributos
		private $cod;
 		private $nome;
 		private $fk_materias_cod;
 				
		//Métodos Getters e Setters
		public function getCod(){
			return $this->cod;
		}
		public function getNome(){
			return $this->nome;
		}
		public function getFk_materias_cod(){
			return $this->fk_materias_cod;
		}
		
		public function setCod($cod){
			$this->cod=$cod;
		}
		public function setNome($nome){
			$this->nome=$nome;
		}
		public function setFk_materias_cod($fk_materias_cod){
			$this->fk_materias_cod=$fk_materias_cod;
		}
		
	}
?>