<?php // GRAVAR OS DADOS APOS ALTERAR AUTENTICACAO
session_start();
$userid = $_SESSION["user-id"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');

// recebe o e-ail que foi enviado pelo ajax(via jason)

$user = new User();

// Verificar se a senha está correta
$email = $_POST["email"];
$senha = $_POST["senha"];
$senhaHashed = $user->hashedPassword($senha);
//if($user->validarSenha(array(':email'=>$email, ':password'=>$senhaHashed))){
//var_dump($user->validarSenha($email,$senhaHashed));
if($user->validarSenha($email,$senhaHashed)){
	echo json_encode(array(
    'resposta' => true
	));
	//echo json_encode($result);
} else {
	echo json_encode(array(
    'resposta' => false
	));
}

/*$email = $_POST["email"];
if(isset($_POST['password'])){
	$pass = $_POST['password'];
	$passHachada = $user->hashedPassword($pass);
	$user->editarPerfil(array(':id'=>$userid, ':email'=>$email, ':password'=>$passHachada));
} else {
	//verifica se o user tem registo na tabela dados_biometricos
	$user->editarPerfil(array(':id'=>$userid, ':email'=>$email));
}
   
echo json_encode($result);*/

?>
