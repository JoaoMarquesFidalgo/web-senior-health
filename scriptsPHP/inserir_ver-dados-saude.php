<?php
session_start();

try {
$dbhost = "estga-dev.clients.ua.pt";
$dbname = "ptaw-gr1-2017";
$dbusername = "ptaw-gr1-2017";
$dbpassword = "H33!6j8Z";

$link = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
$link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Erro PDO: " . $e->getMessage();
}
try{
$today = date("Y-m-d H:i:s");

$array_historico = array( 
                   $today,
                   filter_input(INPUT_POST, 'hip_art'), 
                   filter_input(INPUT_POST, 'dia'),
                   filter_input(INPUT_POST, 'art'),
                   filter_input(INPUT_POST, 'esp'),
                   filter_input(INPUT_POST, 'pat_vas'), 
                   filter_input(INPUT_POST, 'pat_res'),
                   filter_input(INPUT_POST, 'can'),
                   filter_input(INPUT_POST, 'dep'),
                   filter_input(INPUT_POST, 'tro_avc'), 
                   filter_input(INPUT_POST, 'outra'),
                    (int)filter_input(INPUT_POST, 'id')
        );
        $statement = $link->prepare("UPDATE `historico_saude` 
            SET `data`=?,`hipertensao_arterial`=?,`diabetes`=?,`artrose`=?,
            `espondiloartrose`=?,`patologia_vascular`=?,`patologia_respiratoria`=?,
            `cancro`=?,`depressao`=?,`trombose`=?,`outra`=?
            WHERE id=?");
        
        $statement->execute(array($array_historico[0], $array_historico[1],$array_historico[2],$array_historico[3],
            $array_historico[4],$array_historico[5],$array_historico[6],$array_historico[7],
            $array_historico[8],$array_historico[9],$array_historico[10],$array_historico[11]));
    
        
    header("Location: http://localhost/projeto-web-cuidados-seniores/success.php");
    die();
} catch (Exception $ex) {
echo $ex->getMessage();
}
?>
