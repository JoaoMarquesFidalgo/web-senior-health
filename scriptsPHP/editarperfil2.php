<?php
session_start();

require_once '../class/user.class.php';
$user = new User();

$result = $user->get_user($_SESSION["user-id"]);
if(isset($_FILES["inputImage"])){

	$filetmp = $_FILES["inputImage"]["tmp_name"];
	$filetype = $_FILES["inputImage"]["type"];
	$filename = $_FILES["inputImage"]["name"];
	$filepath =  "../images-folder/".$filename;

	move_uploaded_file($filetmp,$filepath);
	
	$img = "images-folder/".$filename;
} else {
	$img = $result[0]["image"];
}

if($result[0]["tipo"]=='familiar'){
	
	if($user->updatePerfilFamiliar(array(':nome'=>$_POST['nome'],':data_nascimento'=>$_POST['data_nascimento'], ':gender'=>$_POST['sexo'],':image'=>$img, ':id'=>$_SESSION['user-id'])))
	{
		$resp['status'] = true;
		echo json_encode($resp, JSON_UNESCAPED_UNICODE);
	} else {
		$resp['status'] = false;
		echo json_encode($resp, JSON_UNESCAPED_UNICODE);
	}
	
} else {
	$telemovel = $_POST["telemovel"];

	if($telemovel=='1'){
		if(isset($_POST["internet"])){
			$telemovel = '3';
		} else if(isset($_POST["sms"])){
			$telemovel = '2';
		} else if(isset($_POST["chamadas"])){
			$telemovel = '1';
		} 
	}

	if($_POST["edformal"]=='Outro'){
		$edformal = $_POST["outroedformal"];
	} else {
		$edformal = $_POST["edformal"];
	}

	if($user->updatePerfil(array(':nome'=>$_POST['nome'],':data_nascimento'=>$_POST['data_nascimento'], ':gender'=>$_POST['sexo'],':image'=>$img, ':id'=>$_SESSION['user-id']),array(':descricao'=>$edformal, ':id_user'=>$_SESSION['user-id']),array(":telemovel"=>$telemovel, "computador_ou_tablet"=>$_POST['computador'], "id_user"=>$_SESSION['user-id']))){
		$resp['status'] = true;
		echo json_encode($resp, JSON_UNESCAPED_UNICODE);
	} else {
		$resp['status'] = false;
		echo json_encode($resp, JSON_UNESCAPED_UNICODE);
	}
}

?>
