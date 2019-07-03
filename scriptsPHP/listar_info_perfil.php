<?php
session_start();
$userid = $_SESSION["user-id"];

header('Content-Type: application/json; charset=UTF-8');
require_once('../class/user.class.php');
$user = new User();
$result = $user->get_user($userid);

echo json_encode($result);

?>

