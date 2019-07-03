<?php
$email = $_POST["email"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');

$user = new User();
//verifica se o email do familiar encontra-se registado
$result = $user->verificar_familiar($email);
if (!empty($result)) {
	//esta registado
	echo json_encode(array(
    'resp' => true
	));
} else {
	//não esta registado
	echo json_encode(array(
    'resp' => false
	));
}
	
 ?>
