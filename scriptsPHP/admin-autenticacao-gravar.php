<?php // GRAVAR OS DADOS APOS ALTERAR AUTENTICACAO
session_start();
$adminID = $_SESSION["admin-id"];
header('Content-Type: application/json; charset=UTF-8');
require_once('../class/administrador.class.php');
require_once("../class/database.class.php");

$error = array();
$resp = array();

// recebe o e-ail que foi enviado pelo ajax(via jason)
$email = $_POST["email"];
$pass = $_POST["password"];

$admin = new Administrador();
$database = new Database();

# $admin->verificaEmailDB($email) retorna FALSE se encontrar o email especificado na BD
if ($admin->verificaEmailDB($email)){
	
	if($pass != ""){
		$passHachada = $admin->hashedPassword($pass);
		$admin->editarPerfil(array(':id'=>$adminID, ':email'=>$email, ':password'=>$passHachada));
	} else {
		$admin->editarPerfil(array(':id'=>$adminID, ':email'=>$email));
	}
	 $resp['status'] = true;
	echo json_encode($resp, JSON_UNESCAPED_UNICODE);
	exit;
} else {
	$error[] = "O e-mail que digitou já se encontra registado! Por favor, escolha um e-mail diferente.";
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit;
}
?>