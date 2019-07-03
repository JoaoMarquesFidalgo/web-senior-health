<?php
header("Content-type:application/pdf");
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1
header('Pragma: no-cache'); // HTTP 1.0
header('Expires: 0'); // Proxies

session_start();
$utenteid = $_SESSION["utente-id"];

require_once('../class/user.class.php');
require('../lib/fpdf181/fpdf.php');

$user = new User();
$result = $user->mostrarAtividadeFisicaRepouso($utenteid);

$count = $user->rowCount();

$pdf = new FPDF('l', 'mm', 'A4');
$pdf->AddPage();

$pdf->Image('../img/logo.png', 10, 10);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(270, 60, 'Dados de Atividade Física (repouso)', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(70, 5, 'Dia da Semana', 1, 0, 'C');
$pdf->Cell(70, 5, 'Data', 1, 0, 'C');
$pdf->Cell(60, 5, 'Duração', 1, 0, 'C');
$pdf->Cell(70, 5, 'Condição de Saúde', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);

for ($i = 0; $i < $count; $i++)
{
  $pdf->Cell(70, 5, diaSemana($result[$i]['data']), 1, 0, 'C');
  $pdf->Cell(70, 5, $result[$i]['data'], 1, 0, 'C');
  $pdf->Cell(60, 5, $result[$i]['duracao'], 1, 0, 'C');
  $pdf->Cell(70, 5, $result[$i]['condicao_saude'], 1, 1, 'C');
}

$pdf->Output('I', 'smartwalk-atividade-fisica-movimento.pdf');

function diaSemana($date) {
    $diaSemana = date('w', strtotime($date));

    switch ($diaSemana)
    {
      case 0:
      return 'Domingo';
      break;

      case 1:
      return 'Segunda-feira';
      break;

      case 2:
      return 'Terça-feira';
      break;

      case 3:
      return 'Quarta-feira';
      break;

      case 4:
      return 'Quinta-feira';
      break;

      case 5:
      return 'Sexta-feira';
      break;

      case 6:
      return 'Sábado';
      break;
    }
}
 ?>
