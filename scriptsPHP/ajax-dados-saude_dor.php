<?php

header('content-type: application/json; charset=utf-8');

$dbhost = "estga-dev.clients.ua.pt";
    $dbname = "ptaw-gr1-2017";
    $dbusername = "ptaw-gr1-2017";
    $dbpassword = "H33!6j8Z";
try {
    $link = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
    $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Erro PDO: " . $e->getMessage();
}
$id = filter_input(INPUT_POST, "id");

$statement = $link->query("SELECT * FROM `dor` WHERE id_historico_saude=$id");

$json = $statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($json);
?>
