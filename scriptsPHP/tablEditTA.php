<?php
header("Content-Type: application/json; charset=UTF-8");
require_once("../class/database.class.php");

$database = new Database();

$input = filter_input_array(INPUT_POST);

if ($input['action'] == 'edit') {
	$database->query("UPDATE `ptaw-gr1-2017`.tensao_arterial SET datahora='" . $input['data'] . "', tensao_arterial='" . $input['tensao_arterial'] . "', responsavel='" . $input['responsavel'] . "' WHERE id='" . $input['id'] . "'"); 
	$database->execute();
	} else if ($input['action'] == 'delete') {
    $database->query("delete from `ptaw-gr1-2017`.tensao_arterial WHERE id='" . $input['id'] . "'");
	$database->execute();
	}

echo json_encode($input);

?>
