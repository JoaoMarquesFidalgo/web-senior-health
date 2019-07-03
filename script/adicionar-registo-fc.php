<?php
session_start();
$userid = $_SESSION["user-id"];
$utenteid = $_SESSION["utente-id"];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  require_once('../class/user.class.php');
  require_once("../class/database.class.php");

  $error = array();
  $resp = array();

  //$datafc = $_POST["datafc"];
  $horafc = $_POST["horafc"];
  $fc = $_POST["fc"];
  $responsavelfc = $_POST["responsavelfc"];

	$user = new User();
	$database = new Database();

	$result = $user->get_dbID_fromUtenteID($utenteid);
	$result = $result[0]["id"];

try{
	// if($user->inserir_frequencia_cardiaca(array(':data'=>$datafc, ':hora'=>$horafc, ':frequencia'=>$fc, ':responsavel'=>$responsavelfc, ':id_db'=>$result))){
  if($user->inserir_frequencia_cardiaca(array(':datahora'=>$horafc, ':frequencia'=>$fc, ':responsavel'=>$responsavelfc, ':id_db'=>$result))){

    $sexo = $user->getSexo($userid);

    if ($sexo == "Masculino") {
      if (!($fc >= 68 && $fc <= 75)) {
        $user->inserir_alerta(array(':tipo' => '3', ':descricao' => 'Frequencia cardiaca anomala', ':id_user' => $userid));
        $resp['has-fc'] = true;
        $resp['erro-fc'] = "Você aparenta ter a frequência cardíaca anormal, por favor, consulte um médico.";
      }
    } else if ($sexo == "Feminino") {
      if (!($fc >= 72 && $fc <= 80)) {
        $user->inserir_alerta(array(':tipo' => '3', ':descricao' => 'Frequencia cardiaca anomala', ':id_user' => $userid));
        $resp['has-fc'] = true;
        $resp['erro-fc'] = "Você aparenta ter a frequência cardíaca anormal, por favor, consulte um médico.";
      }
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
