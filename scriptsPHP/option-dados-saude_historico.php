<?php

$utente = $_SESSION['utente-id'];
require_once './class/user.class.php';
$user = new User();

$result = $user->ver_dados_saude($utente);

if(empty($result)){
    echo "<h3>Não tem histórico de saúde para mostrar</h3>"
    . "<p>Para adicionar uma nova ficha, entre em Inserir Dados de Saúde</p>";
}else{
echo "<div id='tirar'><h3>Histórico de saúde</h3>";
echo '<table id="tabledit" class="table-bordered table-striped table">';
echo '<thead> ';
echo '<tr><th style="width: 200px">Data</th>';
foreach ($result as $row) {
    echo "<td>" . $row['data'] . "</td>";
}
echo "</tr>" . '<tr><th style="width: 200px">Hipertensão Arterial</th>';
foreach ($result as $row) {
    echo "<td>" . $row['hipertensao_arterial'] . "</td>";
}
echo "</tr>";
echo '<tr><th style="width: 200px">Diabetes</th>';
foreach ($result as $row) {
    if ($row['diabetes'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['diabetes'] . "</td>";
    }
}
echo "</tr>";
echo '<tr><th style="width: 200px">Artrose</th>';
foreach ($result as $row) {
    if ($row['artrose'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['artrose'] . "</td>";
    }
}
echo "</tr>";
echo '<tr><th style="width: 200px">Espondiloartrose</th>';
foreach ($result as $row) {
    if ($row['espondiloartrose'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['espondiloartrose'] . "</td>";
    }
}
echo "</tr>";
echo '<tr><th style="width: 200px">Patologia Cardiovascular</th>';
foreach ($result as $row) {
    if ($row['patologia_vascular'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['patologia_vascular'] . "</td>";
    }
}
echo "</tr>";
echo '<tr><th style="width: 200px">Patologia Respiratória</th>';
foreach ($result as $row) {
    if ($row['patologia_respiratoria'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['patologia_respiratoria'] . "</td>";
    }
}
echo "</tr>";
echo '<tr><th style="width: 200px">Cancro</th>';
foreach ($result as $row) {
    if ($row['cancro'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['cancro'] . "</td>";
    }
}
echo "</tr>";
echo '<tr><th style="width: 200px">Depressão</th>';
foreach ($result as $row) {
    if ($row['depressao'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['depressao'] . "</td>";
    }
}
echo "</tr>";
echo '<tr><th style="width: 200px">Trombose</th>';
foreach ($result as $row) {
    if ($row['trombose'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['trombose'] . "</td>";
    }
}
echo "</tr>";
echo '<tr><th style="width: 200px">Outra</th>';
foreach ($result as $row) {
    if ($row['outra'] === "") {
        echo "<td>---</td>";
    } else {
        echo "<td>" . $row['outra'] . "</td>";
    }
}
echo "</tr>";
echo "</thead></table>";
$texto = "";
$i = 0;
foreach ($result as $row) {
    $texto[$i] = $row['id'];
    $i++;
}

for ($i = 0; $i < 5; $i++) {
    if (!isset($texto[$i])) {
        $texto[$i] = null;
    } else {
        $result1[$i] = $user->ver_dados_saude_dor($texto[$i]);
    }
}


echo "<h3>Diagnóstico de dor</h3>";
echo '<table id="tabledit" class="table-bordered table-striped table">';
echo '<thead> ';
echo '<tr><th style="width: 200px">Cabeça</th>';
$i=0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo '<td>' . $row['cabeca'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>" . '<tr><th style="width: 200px">Pescoço</th>';






$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['pesoco'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Ombros</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['ombros'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Braços</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['bracos'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Punhos e mãos</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['punhos_maos'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Coluna Torácica</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['coluna_toracica'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Lombar</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['lombar'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Anca</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['anca'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Coxa</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['coxa'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Joelho</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['joelho'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr>";
echo '<tr><th style="width: 200px">Tornozelos e pés</th>';
$i = 0;
while ($result1[$i]) {
        foreach ($result1[$i] as $row) {
            echo "<td>" . $row['tornozelos_pes'] . "</td>";
        }
    if(!isset($result1[$i+1])){
        break;
    }
    $i++;
}
echo "</tr></table></div>";
}
//echo "</tr>";
//echo '<tr><th style="width: 200px">Bracos</th>';
//$i = 0;
//while ($result1[$i]) {
//    foreach ($result1[$i] as $row) {
//        echo "<td>" . $row['bracos'] . "</td>";
//    }
//    $i++;
//}
//echo "</tr>";
