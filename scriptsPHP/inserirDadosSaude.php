<?php
    
try{
    session_start();
    $utente = $_SESSION['utente-id'];
    
    require_once '../class/user.class.php';
    $user = new User();
    $data = date ("Y-m-d H:i:s");
    $array_historico = array(
                   ':utente'=> $utente,
                   ':data'=>$data, 
                   ':hip_art'=>$_POST['hip_art'], 
                   ':dia'=>$_POST['dia'], 
                   ':art'=>$_POST['art'], 
                   ':esp'=>$_POST['esp'], 
                   ':pat_vas'=>$_POST['pat_car'], 
                   ':pat_res'=>$_POST['pat_res'], 
                   ':can'=>$_POST['can'], 
                   ':dep'=>$_POST['dep'], 
                   ':tro'=>$_POST['tro'], 
                   ':outra'=>$_POST['outra'],
        );
    
    $result = $user->novo_dados_saude($array_historico);
    $array_dor = array(':cabeca'=>$_POST['cabeca'], 
                    ':pesoco'=>$_POST['pescoco'], 
                    ':ombros'=>$_POST['ombros'], 
                    ':bracos'=>$_POST['bracos'], 
                    ':punhos_maos'=>$_POST['punhos_maos'], 
                    ':coluna_toracica'=>$_POST['coluna_toracica'], 
                    ':lombar'=>$_POST['lombar'], 
                    ':anca'=>$_POST['anca'],
                    ':coxa'=>$_POST['coxa'],
                    ':joelho'=>$_POST['joelho'],
                    ':tornozelos_pes'=>$_POST['tornozelos_pes'],
                    ':id_hist_saude'=>$result
        );
    $statement1 = $user->novo_dados_saude_ins_dor($array_dor);
    echo $statement1;
	
} catch (Exception $ex) {
    echo $ex->getMessage();
}
    