<?php
header('Content-Type: application/json');

require_once("../class/user.class.php");
session_start();

$user = new User();
echo $user->graphAtividadeFisicaRepouso($_SESSION["utente-id"]);

 ?>
