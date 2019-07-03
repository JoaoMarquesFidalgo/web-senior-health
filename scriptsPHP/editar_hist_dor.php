<?php
    
try{
    session_start();
    $utente = $_SESSION['utente-id'];
    require_once '../class/user.class.php';
    $user = new User();
    
    var_dump($_POST);
    $array_historico = array(
                   ':data'=>$_POST['data'], 
                   ':hip_art'=>$_POST['hipertensao_arterial'], 
                   ':dia'=>$_POST['diabetes'], 
                   ':art'=>$_POST['artrose'], 
                   ':esp'=>$_POST['espondiloartrose'], 
                   ':pat_vas'=>$_POST['patologia_vascular'], 
                   ':pat_res'=>$_POST['patologia_respiratoria'], 
                   ':can'=>$_POST['cancro'], 
                   ':dep'=>$_POST['depressao'], 
                   ':tro'=>$_POST['trombose'], 
                   ':outra'=>$_POST['outra'],
                   ':id'=>$_POST['id'] );
    
    $result = $user->update_historico($array_historico);
    
    
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
                    ':id'=>$_POST['id']
        );
    $statement1 = $user->update_dor($array_dor);
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}
    