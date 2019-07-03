<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  require_once('../class/user.class.php');

  $error = array();
  $resp = array();

  $duracao = $_POST["duracao"];
  $condicao_saude = $_POST["condicao_fisica"];
  $data = $_POST["data"];

  $user = new User();

  if ($user->verificarDataRepouso($data))
  {

    if ($user->inserirDadosAtividadeFisicaRepouso(
      array(':duracao' => $duracao, ':condicao_saude' => $condicao_saude, ':data' => $data)))
      {
        $resp['status'] = true;
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
        exit;
      }
      else
      {
        $error[] = "Houve um erro na insereção dos registos!";
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
        exit;
      }
    }
    else {
      $error[] = "O registo com a data: <b>".$data."</b> já se encontra na base de dados. Se deseja alterar o campo referente a esta data, edite na tabela.";
      $resp['msg'] = $error;
      $resp['status'] = false;
      echo json_encode($resp, JSON_UNESCAPED_UNICODE);
      exit;
    }
  }
  else
  {
    header("Location: javascript://history.go(-1)");
    exit;
  }

  ?>
