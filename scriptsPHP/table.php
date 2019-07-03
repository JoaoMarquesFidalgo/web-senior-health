<?php
session_start();
$userid = $_SESSION["user-id"];
$utenteid = $_SESSION["utente-id"];
$typo = $_POST["tipo"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');
require_once("../class/database.class.php");

$user = new User();
$database = new Database();
//verifica se o user tem registo na tabela dados_biometricos
$result = $user->verificar_id_dados_biometricos($utenteid);
if (empty($result)) { 
   //results are empty, do something here 
	//inserir registo na tabela dados biometricos
	$database->query("insert into `ptaw-gr1-2017`.dados_biometricos (id_utente) values ('$utenteid')");
	$database->execute();
}

if($typo=='fc'){
	$result2 = $user->mostrarFC($utenteid);
	echo json_encode($result2);
}else if ($typo=='ta'){
	$result3 = $user->mostrarTA($utenteid);
	echo json_encode($result3);
}

 ?>
