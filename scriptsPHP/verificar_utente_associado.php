<?php
session_start();
$userid = $_SESSION["user-id"];
header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');
$user = new User();

$utenteid = $_POST["idutente"];

$result = $user->verificar_utente_associado($userid,$utenteid);
if (!empty($result)) { 
	$_SESSION["utente-id"] = $utenteid;
	echo json_encode(array('resp' => true));
}
else {
	echo json_encode(array('resp' => false));
}

?>
