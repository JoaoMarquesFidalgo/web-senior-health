<?php
session_start();
$userid = $_SESSION["user-id"];
$utenteid = $_SESSION["utente-id"];

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  require_once('../class/user.class.php');

  $error = array();
  $resp = array();

  $email = $_POST["emailF"];

  $user = new User();

  if ($user->verificaEmailDB($email))
  {
    $user->registarFamiliar(
      array(':nome' => $_POST["nomeF"], ':data_nascimento' => $_POST["dateF"],
      ':gender' => $_POST["sexoF"], ':email' => $_POST["emailF"],
      ':password' => $user->hashedPassword($_POST["passwdF"])
    ),$utenteid);

    $resp['status'] = true;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);

    exit;
  }
  else
  {
    $result = $user->verificar_familiar($email);
	$user->registarFamiliar2($result[0]["id"],$utenteid);
	
	$resp['status'] = true;
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
