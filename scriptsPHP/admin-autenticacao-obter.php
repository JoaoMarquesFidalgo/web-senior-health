<?php // OBTER DADOS DE AUTENTICACAO 
session_start();
$userid = $_SESSION["admin-id"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/administrador.class.php');
require_once("../class/database.class.php");

$user = new Administrador();
//$database = new Database();

// retorna o nome e password do user
$result = $user->getEmailAdmin($userid);

echo json_encode($result);

 ?>
