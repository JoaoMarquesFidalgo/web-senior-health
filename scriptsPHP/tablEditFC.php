<?php
header("Content-Type: application/json; charset=UTF-8");
require_once("../class/database.class.php");

$database = new Database();

$input = filter_input_array(INPUT_POST);

if ($input['action'] == 'edit') {
	$database->query("UPDATE `ptaw-gr1-2017`.frequencia_cardiaca SET datahora='" . $input['data'] . "', frequencia_cardiaca='" . $input['frequencia_cardiaca'] . "', responsavel='" . $input['responsavel'] . "' WHERE id='" . $input['id'] . "'");
	$database->execute();
	} else if ($input['action'] == 'delete') {
    $database->query("delete from `ptaw-gr1-2017`.frequencia_cardiaca WHERE id='" . $input['id'] . "'");
	$database->execute();
	}

echo json_encode($input);

?>
