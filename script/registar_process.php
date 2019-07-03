<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  require_once('../class/user.class.php');

  $error = array();
  $resp = array();

  $email = $_POST["email"];

  $user = new User();

  if ($user->verificaEmailDB($email))
  {
    $user->registarConta(
      array(':nome' => $_POST["nome"], ':data_nascimento' => $_POST["datepicker"],
      ':gender' => $_POST["sexo"], ':email' => $_POST["email"],
      ':password' => $user->hashedPassword($_POST["password"])
    ),
    array(':descricao' => $_POST["edformal"]),
    array(':telemovel' => $_POST["literacia_informatica"], ':computador_ou_tablet' => $_POST["computador_ou_tablet"])
    );

    $resp['status'] = true;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);

    exit;
  }
  else
  {
    $error[] = "O e-mail já se encontra registado! Por favor, insira um novo para se registar.";
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit;
  }
}
else
{
  header("Location: javascript://history.go(-1)");
  exit;
}

?>
