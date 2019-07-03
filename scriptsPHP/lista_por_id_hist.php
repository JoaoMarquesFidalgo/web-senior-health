<?php

try {
    require_once('../class/user.class.php');
    $id = $_POST['id'];

    $user = new User();
    $result = $user->get_historico($id);
    echo json_encode($result);
    
} catch (Exception $ex) {
    echo $ex;
}
?>
