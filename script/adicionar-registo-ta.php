<?php
session_start();
$userid = $_SESSION["user-id"];
$utenteid = $_SESSION["utente-id"];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  require_once('../class/user.class.php');
  require_once("../class/database.class.php");

  $error = array();
  $resp = array();

  $horata = $_POST["horata"];
  $ta = $_POST["ta"];
  $responsavelta = $_POST["responsavelta"];

	$user = new User();
	$database = new Database();

	$result = $user->get_dbID_fromUtenteID($utenteid);
	$result = $result[0]["id"];

try{
	if($user->inserir_tensao_arterial(array(':datahora'=>$horata, ':tensaoArterial'=>$ta, ':responsavel'=>$responsavelta, ':id_db'=>$result))){

    if (($ta >= 120 && $ta <= 139) || ($ta >= 80 && $ta <= 89)) {
      $user->inserir_alerta(array(':tipo' => '0', ':descricao' => 'Pré-hipertensão', ':id_user' => $userid));
      $resp['has-ta'] = true;
      $resp['erro-ta'] = "Você aparenta ter a tensão arterial anormal, por favor, consulte um médico.";
    } else if (($ta >= 140 && $ta <= 159) || ($ta >= 90 && $ta <= 99)) {
      $user->inserir_alerta(array(':tipo' => '1', ':descricao' => 'Hipertensão arterial estádio 1', ':id_user' => $userid));
      $resp['has-ta'] = true;
      $resp['erro-ta'] = "Você aparenta ter a tensão arterial anormal, por favor, consulte um médico.";
    } else if (($ta > 160) || ($ta > 100)) {
      $user->inserir_alerta(array(':tipo' => '2', ':descricao' => 'Hipertensão arterial estádio 2', ':id_user' => $userid));
      $resp['has-ta'] = true;
      $resp['erro-ta'] = "Você aparenta ter a tensão arterial anormal, por favor, consulte um médico.";
    }

	$resp['status'] = true;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit;
	}else{

	$error[] = "Houve um erro na insereção dos registos!";
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit; }
} catch(exception $ex){ echo $ex->getMessage(); }

}else{
	header("Location: javascript://history.go(-1)");
	exit;
}

?>
