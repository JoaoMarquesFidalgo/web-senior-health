<?php
session_start();
$utenteid = $_SESSION["utente-id"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');

$user = new User();
$result = $user->mostrarAtividadeFisicaMovimento($utenteid);

echo json_encode($result);

 ?>
