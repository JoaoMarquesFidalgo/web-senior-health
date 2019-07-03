<?php # remover um user
header('Content-Type: application/json; charset=UTF-8');
require_once('../class/user.class.php');

// recebe o id do user passado pelo arquivo listar-users-js
$idUser = $_POST['id'];

$user = new User();
$result = $user->removerUser(array(':id'=>$idUser));
echo json_encode(array("result" => true));
?>