<?php

$dbhost = "localhost";
$dbname = "ptweb";
$dbusername = "root";
$dbpassword = "";
$link = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = filter_input(INPUT_POST, "id");

$statement = $link->query("SELECT * FROM `historico_saude` WHERE id=?");
$statement->execute(array($id));

var_dump($statement);
$json = $statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($json);
