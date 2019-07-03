<?php
session_start();
$userid = $_SESSION["user-id"];

header('Content-Type: application/json; charset=UTF-8');

require_once('../class/user.class.php');

$user = new User();

$result = $user->listar_utentes_associados($userid);

echo json_encode($result);

?>
