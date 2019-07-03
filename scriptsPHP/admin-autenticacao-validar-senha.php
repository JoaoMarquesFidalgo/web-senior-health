<?php // GRAVAR OS DADOS APOS ALTERAR AUTENTICACAO
session_start();
$adminid = $_SESSION["admin-id"];
header('Content-Type: application/json; charset=UTF-8');
require_once('../class/administrador.class.php');

// Cria instancia da classe Administrador
$admin = new Administrador();

// recebe o e-ail que foi enviado pelo ajax(via jason)
$email = $_POST["email"];
$senha = $_POST["senha"];
$senhaHashed = $admin->hashedPassword($senha);

// Verificar se a senha está correta
if($admin->validarSenha($email, $senhaHashed)){
	echo json_encode(array(
    'resposta' => true
	));
	//echo json_encode($result);
} else {
	echo json_encode(array(
    'resposta' => false
	));
}
?>