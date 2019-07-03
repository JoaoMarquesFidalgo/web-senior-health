<?php
session_start();
$userid = $_SESSION["user-id"];
$utenteid = $_SESSION["utente-id"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');

$user = new User();

$result = $user->verificar_familiar_associado($utenteid);
if (empty($result)) { 
	echo json_encode(array('resp' => true));
}
else {
	echo json_encode(array('resp' => false));
}

?>
