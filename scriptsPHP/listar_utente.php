<?php
$utente = $_SESSION["utente-id"];
require_once('class/user.class.php');
$user = new User();
$result = $user->listar_utente($utente);
?>
