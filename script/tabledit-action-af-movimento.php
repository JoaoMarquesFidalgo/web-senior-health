<?php
header('Content-Type: application/json; charset=UTF-8');

require_once('../class/database.class.php');
$database = new Database();

$input = filter_input_array(INPUT_POST);

if ($input['action'] == 'edit')
{
  if ($user->verificarDataMovimento($data))
  {
    $database->query("UPDATE `ptaw-gr1-2017`.af_andar SET data='" . $input["data"] . "', frequencia='" . $input["frequencia"] . "', duracao='" . $input["duracao"] . "', condicao_saude='" . $input["condicao_saude"] . "' WHERE id='" . $input["id"] . "'");
    $database->execute();
  }
}
else if ($input['action'] == 'delete')
{
  $database->query("DELETE FROM `ptaw-gr1-2017`.af_andar WHERE id='" . $input["id"] ."'");
  $database->execute();
}

echo json_encode($input);
?>
