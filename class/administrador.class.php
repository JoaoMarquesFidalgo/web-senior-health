<?php

require_once('database.class.php');

class Administrador extends Database
{
	// --------------------------------------------------------------
	// Obtém o email do admin
	// --------------------------------------------------------------
	public function getEmailAdmin($adminID) {
		Database::query("SELECT email, password FROM `ptaw-gr1-2017`.admin WHERE id=" . $adminID);
		return Database::resultset();
	}

	// --------------------------------------------------------------
	// Valida a senha do admin para que libere campos para alteracoes 
	// --------------------------------------------------------------
	public function validarSenha($email,$senha) {
		Database::query("SELECT * FROM `ptaw-gr1-2017`.admin WHERE email='".$email."' AND password='".$senha."'");
		  //Database::queryArray(array(':email' => $email, ':senha' => $this->hashedPassword($senha)));
		Database::single();

		if (Database::rowCount() == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	// --------------------------------------------------------------
	// Verifica se existe um determinado email na BD
	// --------------------------------------------------------------
	public function verificaEmailDB($email) {
		Database::query("SELECT email FROM `ptaw-gr1-2017`.admin WHERE email='$email'");
		Database::single();

		if (Database::rowCount() == 1)
		{
		  return false;
		}
		else
		{
		  return true;
		}
	}
	
	// --------------------------------------------------------------
	// Salva as alterações na BD
	// --------------------------------------------------------------
	public function editarPerfil($param) {
		try{
			if(count($param) == 2){
				Database::query("UPDATE `ptaw-gr1-2017`.admin SET email=:email WHERE id=:id");
				Database::queryArray($param);
				Database::execute();
				return true;
			} else if(count($param) == 3) {
				Database::query("UPDATE `ptaw-gr1-2017`.admin SET email=:email, password=:password WHERE id=:id");
				Database::queryArray($param);
				Database::execute();
				return true;
			} else {
			  return false;
			}
		} catch(exception $e){
			echo $e->getMessage();
		}
	}
	// --------------------------------------------------------------
	// Funcao que o admin elimina a usa propria conta
	// --------------------------------------------------------------
	public function eliminarAdmin($param){
		try{
			Database::query("DELETE FROM `ptaw-gr1-2017`.admin WHERE id=:id");
			Database::queryArray($paramId);
			Database::execute();
			return true;
		} catch(exception $e){
			  echo $e->getMessage();
		}
	}
	
	// --------------------------------------------------------------
	// Faz a encriptacao da senha
	// --------------------------------------------------------------
	public function hashedPassword($password) {
		return hash('sha256', $password);
	}
}

 ?>
