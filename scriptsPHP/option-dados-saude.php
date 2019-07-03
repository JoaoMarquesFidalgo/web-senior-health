<?php
$utente = $_SESSION['utente-id'];
require_once './class/user.class.php';
$user = new User();

$result = $user->ver_dados_saude($utente);

echo "<select id='select_data'>";
    echo "<option value='0'>Selecione uma data</option>";
    foreach ($result as $row) {
    echo "<option value='" . $row['id'] . "'>" . $row['data'] . "</option>";
    }
    echo "</select>";