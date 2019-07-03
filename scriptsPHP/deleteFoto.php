<?php
session_start();

require_once '../class/user.class.php';
$user = new User();


if($user->updateFoto(array(':image'=>null, ':id'=>$_SESSION['user-id'])))
{
	$resp['status'] = true;
	echo json_encode($resp, JSON_UNESCAPED_UNICODE);
} else {
	$resp['status'] = false;
	echo json_encode($resp, JSON_UNESCAPED_UNICODE);
}


?>
