<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  require_once('../class/user.class.php');

  $error = array();
  $resp = array();

  $email = $_POST["email"];
  $password = $_POST["password"];

  $user = new User();

  if ($user->login($email, $password)==1)
  {
	//verifica tipo e manda juntamente com o resp
	//1 para utente
    $resp['status'] = true;
	$resp['tipo']= 'utente';
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit;
  } else if ($user->login($email, $password)==2){
	//verifica tipo e manda juntamente com o resp
	//2 para utente
    $resp['status'] = true;
	$resp['tipo']= 'familiar';
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit;
  } else if ($user->login($email, $password)==3){
	//verifica tipo e manda juntamente com o resp
	//2 para utente
    $resp['status'] = true;
	$resp['tipo']= 'admin';
	$resp['tipo']= 'admin';
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit;
  }
  else
  {
    $error[] = "Os dados do login estão incorrectos!";
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit;
  }
}
else
{
  //header("Location: javascript://history.go(-1)");
  exit;
}

?>
