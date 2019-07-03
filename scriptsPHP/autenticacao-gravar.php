<?php // GRAVAR OS DADOS APOS ALTERAR AUTENTICACAO
session_start();
$userid = $_SESSION["user-id"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');
require_once("../class/database.class.php");

$error = array();
$resp = array();

// recebe o e-ail que foi enviado pelo ajax(via jason)
$email = $_POST["email"];
$pass = $_POST["password"];

$user = new User();
$database = new Database();

if ($user->verificaEmailDB($email)){
	
	if($pass != ""){
		$passHachada = $user->hashedPassword($pass);
		$user->editarPerfil(array(':id'=>$userid, ':email'=>$email, ':password'=>$passHachada));
	} else {
		//verifica se o user tem registo na tabela dados_biometricos
		$user->editarPerfil(array(':id'=>$userid, ':email'=>$email));
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