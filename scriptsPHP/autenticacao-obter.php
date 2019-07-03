<?php // OBTER DADOS DE AUTENTICACAO 
session_start();
$userid = $_SESSION["user-id"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');
require_once("../class/database.class.php");

$user = new User();
//$database = new Database();

// retorna o nome e password do user
$result = $user->mostrarDadosAutenticacao($userid);

echo json_encode($result);

 ?>
