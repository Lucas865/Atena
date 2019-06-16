<?php

	/* @Autor: Dalker Pinheiro
	Atributos e métodos da classe */

	class Usuario{
		//Atributos
		private $cod;
		private $user;
		private $passwd;
		private $email;
		private $acess_level;

		//Métodos Getters e Setters
		public function getAcessLevel(){
			return $this->acess_level;
		}
		
		public function setAcessLevel($acess_level){
			$this->acess_level=$acess_level;
		}
		public function getCod(){
			return $this->cod;
		}
		public function getUser(){
			return $this->user;
		}
		public function getPasswd(){
			return $this->passwd;
		}
		public function getEmail(){
			return $this->email;
		}
		
		public function setCod($cod){
			$this->cod=$cod;
		}
		public function setUser($user){
			$this->user=$user;
		}
		public function setPasswd($passwd){
			$this->passwd=$passwd;
		}
		public function setEmail($email){
			$this->email=$email;
		}
		
	}
	?>