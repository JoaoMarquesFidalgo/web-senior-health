<?php 
$utente = $_SESSION["utente-id"];
require_once('class/user.class.php');
$user = new User();
$result = $user->getWarning($utente);
echo $result['count(*)'];
?>