<?php
header('Content-Type: application/json; charset=UTF-8');
require_once('../class/user.class.php');
$user = new User();
$result = $user->getAllUsers();
echo json_encode($result);
?>