<?php
require_once('database.class.php');

class User extends Database
{
  public function registarConta($param, $edformal, $literacia)
  {
    try
    {
      Database::beginTransaction();

      Database::query("INSERT INTO `ptaw-gr1-2017`.user (nome, data_nascimento, gender,
      email, password, data_conta,tipo) VALUES (:nome, :data_nascimento, :gender, :email, :password, CURDATE(),'utente')");
      Database::queryArray($param);
      Database::execute();

      $lastid = Database::lastInsertId();

      Database::query("INSERT INTO `ptaw-gr1-2017`.utente (id_user) VALUES (".$lastid.")");
      Database::execute();

      Database::query("INSERT INTO `ptaw-gr1-2017`.educacao_formal (descricao, id_user) VALUES (:descricao, ".$lastid.")");
      Database::queryArray($edformal);
      Database::execute();

      Database::query("INSERT INTO `ptaw-gr1-2017`.literacia_informatica (telemovel, computador_ou_tablet, id_user) VALUES (:telemovel, :computador_ou_tablet, ".$lastid.")");
      Database::queryArray($literacia);
      Database::execute();

      Database::endTransaction();

    } catch (Exception $e)
    {
      Database::cancelTransaction();
    }

  }
	public function registarFamiliar($param,$utenteid)
  {
    try
    {
      Database::beginTransaction();

      Database::query("INSERT INTO `ptaw-gr1-2017`.user (nome, data_nascimento, gender,
      email, password, data_conta,tipo) VALUES (:nome, :data_nascimento, :gender, :email, :password, CURDATE(),'familiar')");
      Database::queryArray($param);
      Database::execute();

      $lastid = Database::lastInsertId();

      Database::query("INSERT INTO `ptaw-gr1-2017`.familiar (id_user,id_utente_associado,grau_parentesco) VALUES (".$lastid.",".$utenteid.",'nada')");
      Database::execute();

      Database::endTransaction();

    } catch (Exception $e)
    {
      Database::cancelTransaction();
    }

  }

	public function registarFamiliar2($id,$utenteid){
		Database::query("INSERT INTO `ptaw-gr1-2017`.familiar (id_user,id_utente_associado,grau_parentesco) VALUES ('$id','$utenteid','nada')");
      Database::execute();

	}

  public function verificaEmailDB($email)
  {
    Database::query("SELECT email FROM `ptaw-gr1-2017`.user WHERE email='$email'");
    Database::single();

    if (Database::rowCount() == 1)
    {
      return false;
    }
    else
    {
      return true;
    }
  }

public function login($email, $password)
  {
    Database::query("SELECT * FROM `ptaw-gr1-2017`.user WHERE email=:email AND password=:password");
    Database::queryArray(array(':email' => $email, ':password' => $this->hashedPassword($password)));
    $dados = Database::single();

    if (Database::rowCount() == 1)
    {
      if(!isset($_SESSION))
    {
        session_start();
    }

	  if($dados["tipo"]=='utente'){
	  Database::query("SELECT id_utente FROM `ptaw-gr1-2017`.utente WHERE id_user=:iduser");
      Database::queryArray(array(':iduser' => $dados["id"]));

      $_SESSION["user-id"] = $dados["id"];
      $_SESSION["utente-id"] = Database::single()['id_utente'];
      $_SESSION["user-nome"] = $dados["nome"];
		return 1;
	  //return 1 é para tipo utente
	  } else if ($dados["tipo"]=='familiar'){
	  Database::query("SELECT id_familiar FROM `ptaw-gr1-2017`.familiar WHERE id_user=:iduser");
      Database::queryArray(array(':iduser' => $dados["id"]));
	  $_SESSION["user-id"] = $dados["id"];
      $_SESSION["familiar-id"] = Database::single()['id_familiar'];
      $_SESSION["user-nome"] = $dados["nome"];
	  return 2;
	  //return 1 é para tipo utente
		}
    }

	Database::query("SELECT * FROM `ptaw-gr1-2017`.admin WHERE email=:email AND password=:password");
    Database::queryArray(array(':email' => $email, ':password' => $this->hashedPassword($password)));
    $dados = Database::single();

    if (Database::rowCount() == 1)
    {
      if(!isset($_SESSION))
    {
        session_start();
    }

      $_SESSION["admin-id"] = $dados["id"];
      $_SESSION["admin-nome"] = $dados["nome"];
	  return 3;
	}

    return 4;

  }

  public function ver_dados_saude($utente) {
        Database::query("SELECT * FROM `historico_saude` WHERE historico_saude.id_utente = " . $utente);
        return Database::resultset();
    }

    public function verificarDataMovimento($data)
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $idutente = $_SESSION["utente-id"];

    Database::query("SELECT data FROM `ptaw-gr1-2017`.af_andar AS andar
    LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON andar.id_af = af.id
     WHERE af.id_utente = '".$idutente."' AND data='".$data."'");
    Database::execute();

    if (Database::rowCount() == 1)
    {
      return false;
      exit;
    }
    return true;
  }

  public function verificarDataRepouso($data)
 {
   if (session_status() == PHP_SESSION_NONE) {
     session_start();
   }
   $idutente = $_SESSION["utente-id"];

   Database::query("SELECT data FROM `ptaw-gr1-2017`.af_sentado AS sentado
   LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON sentado.id_af = af.id
    WHERE af.id_utente = '".$idutente."' AND data='".$data."'");
   Database::execute();

   if (Database::rowCount() == 1)
   {
     return false;
     exit;
   }
   return true;
 }

  public function mostrarAtividadeFisicaMovimento($utenteid)
  {
    Database::query("SELECT andar.* FROM `ptaw-gr1-2017`.af_andar AS andar
	  LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON andar.id_af = af.id
	  LEFT JOIN `ptaw-gr1-2017`.utente AS u ON u.id_utente = af.id_utente WHERE u.id_utente =" . $utenteid . " ORDER BY data DESC");
    return Database::resultset();
  }

  public function mostrarAtividadeFisicaRepouso($utenteid)
  {
    Database::query("SELECT repouso.* FROM `ptaw-gr1-2017`.af_sentado AS repouso
    LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON repouso.id_af = af.id
    LEFT JOIN `ptaw-gr1-2017`.utente AS u ON u.id_utente = af.id_utente WHERE u.id_utente =" . $utenteid . " ORDER BY data DESC");
    return Database::resultset();
  }

  public function graphAtividadeFisicaMovimento($utenteid)
  {
    Database::query("SELECT andar.* FROM `ptaw-gr1-2017`.af_andar AS andar
	  LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON andar.id_af = af.id
	  LEFT JOIN `ptaw-gr1-2017`.utente AS u ON u.id_utente = af.id_utente WHERE u.id_utente = " . $utenteid . " ORDER BY data");
    Database::execute();

    if (Database::rowCount() > 0)
    {
      $result = Database::resultset();
      return json_encode($result);
    }
  }

  public function graphAtividadeFisicaRepouso($utenteid)
  {
    Database::query("SELECT repouso.* FROM `ptaw-gr1-2017`.af_sentado AS repouso
    LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON repouso.id_af = af.id
    LEFT JOIN `ptaw-gr1-2017`.utente AS u ON u.id_utente = af.id_utente WHERE u.id_utente = " . $utenteid . " ORDER BY data");
    Database::execute();

    if (Database::rowCount() > 0)
    {
      $result = Database::resultset();
      return json_encode($result);
    }
  }

  public function graphAtividadeFisicaMovimentoMes($utenteid)
  {
    Database::query("SELECT andar.* FROM `ptaw-gr1-2017`.af_andar AS andar
	  LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON andar.id_af = af.id
	  LEFT JOIN `ptaw-gr1-2017`.utente AS u ON u.id_utente = af.id_utente WHERE u.id_utente = ". $utenteid ." AND MONTH(data) = MONTH(CURRENT_DATE()) ORDER BY data");
    Database::execute();

    if (Database::rowCount() > 0)
    {
      $result = Database::resultset();
      return json_encode($result);
    }
    else {
      return 0;
    }
  }

  public function graphAtividadeFisicaRepousoMes($utenteid)
  {
    Database::query("SELECT repouso.* FROM `ptaw-gr1-2017`.af_sentado AS repouso
    LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON repouso.id_af = af.id
    LEFT JOIN `ptaw-gr1-2017`.utente AS u ON u.id_utente = af.id_utente WHERE u.id_utente = " . $utenteid . " AND MONTH(data) = MONTH(CURRENT_DATE()) ORDER BY data");
    Database::execute();

    if (Database::rowCount() > 0)
    {
      $result = Database::resultset();
      return json_encode($result);
    }
    else {
      return json_encode(0);
    }
  }

  public function mostrarFC($utenteid){
	Database::query("SELECT fc.* FROM `ptaw-gr1-2017`.frequencia_cardiaca AS fc
	LEFT JOIN `ptaw-gr1-2017`.dados_biometricos AS db ON fc.id_dados_biometricos = db.id
	WHERE db.id_utente =" . $utenteid . " ORDER BY datahora DESC");
	return Database::resultset();
  }

  public function graphMostrarFC($utenteid){
  Database::query("SELECT fc.* FROM `ptaw-gr1-2017`.frequencia_cardiaca AS fc
  LEFT JOIN `ptaw-gr1-2017`.dados_biometricos AS db ON fc.id_dados_biometricos = db.id
  WHERE db.id_utente =" . $utenteid . " ORDER BY datahora");
  Database::execute();

  if (Database::rowCount() > 0)
  {
    $result = Database::resultset();
    return json_encode($result);
  }
  }

  public function graphMostrarFCMes($utenteid){
  Database::query("SELECT fc.* FROM `ptaw-gr1-2017`.frequencia_cardiaca AS fc
  LEFT JOIN `ptaw-gr1-2017`.dados_biometricos AS db ON fc.id_dados_biometricos = db.id
  WHERE db.id_utente =" . $utenteid . " AND MONTH(datahora) = MONTH(CURRENT_DATE()) ORDER BY datahora");
  Database::execute();

  if (Database::rowCount() > 0)
  {
    $result = Database::resultset();
    return json_encode($result);
  }    else {
        return 0;
      }
  }


	public function mostrarTA($utenteid){
	Database::query("SELECT ta.* FROM `ptaw-gr1-2017`.tensao_arterial AS ta
	LEFT JOIN `ptaw-gr1-2017`.dados_biometricos AS db ON ta.id_dados_biometricos = db.id
 	WHERE db.id_utente =" . $utenteid . " ORDER BY datahora DESC");
	return Database::resultset();
  }

  public function graphMostrarTA($utenteid){
  Database::query("SELECT ta.* FROM `ptaw-gr1-2017`.tensao_arterial AS ta
  LEFT JOIN `ptaw-gr1-2017`.dados_biometricos AS db ON ta.id_dados_biometricos = db.id
  WHERE db.id_utente =" . $utenteid . " ORDER BY datahora");
  Database::execute();

  if (Database::rowCount() > 0)
  {
    $result = Database::resultset();
    return json_encode($result);
  }
  }

  public function graphMostrarTAMes($utenteid){
  Database::query("SELECT ta.* FROM `ptaw-gr1-2017`.tensao_arterial AS ta
  LEFT JOIN `ptaw-gr1-2017`.dados_biometricos AS db ON ta.id_dados_biometricos = db.id
  WHERE db.id_utente =" . $utenteid . " AND MONTH(datahora) = MONTH(CURRENT_DATE()) ORDER BY datahora");
  Database::execute();

  if (Database::rowCount() > 0)
  {
    $result = Database::resultset();
    return json_encode($result);
  }    else {
        return 0;
      }
  }

  public function verificar_id_dados_biometricos($utenteid){
	Database::query("select * from `ptaw-gr1-2017`.dados_biometricos
	where id_utente =" . $utenteid);
	return Database::resultset();
  }

  public function inserir_frequencia_cardiaca($param){
	try{
		Database::query("insert into `ptaw-gr1-2017`.frequencia_cardiaca (datahora,frequencia_cardiaca,responsavel,id_dados_biometricos)
		values (:datahora,:frequencia,:responsavel,:id_db)");
		Database::queryArray($param);
		Database::execute();
		return true;
	} catch(exception $ex){
		echo $ex->getMessage();
	}
  }

	public function inserir_tensao_arterial($param){
	try{
		Database::query("insert into `ptaw-gr1-2017`.tensao_arterial (datahora,tensao_arterial,responsavel,id_dados_biometricos)
		values (:datahora,:tensaoArterial,:responsavel,:id_db)");
		Database::queryArray($param);
		Database::execute();
		return true;
	} catch(exception $ex){
		echo $ex->getMessage();
	}
  }

  public function inserir_alerta($param) {
    Database::query("INSERT INTO `ptaw-gr1-2017`.alertas (tipo, descricao, id_user) VALUES (:tipo, :descricao, :id_user)");
    Database::queryArray($param);
    Database::execute();
  }

  public function getSexo($userid) {
    Database::query("SELECT gender FROM `ptaw-gr1-2017`.user WHERE id=" . $userid . "");
    Database::execute();

    return Database::single()['gender'];
  }

  public function verificar_id_atividade_fisica($utenteid)
  {
    Database::query("select an.id from `ptaw-gr1-2017`.af_andar as an
	LEFT JOIN `ptaw-gr1-2017`.atividade_fisica AS af ON an.id_af = af.id
	LEFT JOIN `ptaw-gr1-2017`.utente AS u ON af.id_utente = u.id_utente
	WHERE u.id_utente =" . $utenteid);
  }
	public function verificar_familiar_associado($utenteid)
  {
    Database::query("select * from `ptaw-gr1-2017`.familiar where id_utente_associado =" . $utenteid);
	return Database::resultset();
  }
	public function listar_utentes_associados()
  {
    Database::query("SELECT u.nome, u.id, u.image, ut.id_utente FROM `ptaw-gr1-2017`.user AS u
	LEFT JOIN `ptaw-gr1-2017`.utente AS ut ON u.id = ut.id_user
	LEFT JOIN `ptaw-gr1-2017`.familiar AS f ON ut.id_utente = f.id_utente_associado WHERE f.id_user = ".$_SESSION["user-id"]);
	return Database::resultset();
  }

	public function listar_familiar($utenteid)
  {
    Database::query("select * from `ptaw-gr1-2017`.user u
	left join `ptaw-gr1-2017`.familiar f on u.id=f.id_user where id_utente_associado =" . $utenteid);
	return Database::resultset();
  }

	public function listar_utente($utenteid)
  {
    Database::query("select * from `ptaw-gr1-2017`.user u
	left join `ptaw-gr1-2017`.utente ut on u.id=ut.id_user where id_utente =" . $utenteid);
	return Database::resultset();
  }

	public function get_user($userid)
  {
    Database::query("select * from `ptaw-gr1-2017`.user u
	left join `ptaw-gr1-2017`.educacao_formal edf on u.id=edf.id_user
	left join `ptaw-gr1-2017`.literacia_informatica li on u.id=li.id_user where u.id =" . $userid);
	return Database::resultset();
  }

	public function removerFamiliarAssociado($utenteid)
  {
    Database::query("delete from `ptaw-gr1-2017`.familiar where id_utente_associado =" . $utenteid);
	Database::execute();
  }

  public function inserirDadosAtividadeFisicaMovimento($param)
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $idutente = $_SESSION["utente-id"];

    try {
      Database::beginTransaction();

      Database::query("INSERT INTO `ptaw-gr1-2017`.atividade_fisica (id_utente) VALUES (".$idutente.")");
      Database::execute();

      $lastid = Database::lastInsertId();

      Database::query("INSERT INTO `ptaw-gr1-2017`.af_andar (frequencia, duracao, condicao_saude, data, id_af) VALUES (:frequencia, :duracao, :condicao_saude, :data, ". $lastid . ")");
      Database::queryArray($param);

      Database::execute();

      Database::endTransaction();
      return true;

    } catch (Exception $e) {
      Database::cancelTransaction();
      echo $e->getMessage();
    }

  }

  public function inserirDadosAtividadeFisicaRepouso($param)
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $idutente = $_SESSION["utente-id"];

    try {
      Database::beginTransaction();

      Database::query("INSERT INTO `ptaw-gr1-2017`.atividade_fisica (id_utente) VALUES (" . $idutente .")");
      Database::execute();

      $lastid = Database::lastInsertId();

      Database::query("INSERT INTO `ptaw-gr1-2017`.af_sentado (duracao, condicao_saude, data, id_af) VALUES (:duracao, :condicao_saude, :data,". $lastid . ")");
      Database::queryArray($param);

      Database::execute();

      Database::endTransaction();
      return true;

    } catch (Exception $e) {
      Database::cancelTransaction();
      echo $e->getMessage();
    }

  }

	public function get_dbID_fromUtenteID($utenteid){
		Database::query("SELECT id from `ptaw-gr1-2017`.dados_biometricos where id_utente = " . $utenteid);
    return Database::resultset();
	}

  public function verificar_familiar($email)
  {
	Database::query("SELECT * from `ptaw-gr1-2017`.user where email = '" . $email."'");
    return Database::resultset();
  }

	public function verificar_utente_associado($user,$utenteid)
  {
	Database::query("SELECT * FROM `ptaw-gr1-2017`.user AS u
	LEFT JOIN `ptaw-gr1-2017`.utente AS ut ON u.id = ut.id_utente
	LEFT JOIN `ptaw-gr1-2017`.familiar AS f ON f.id_utente_associado = ut.id_utente
	where f.id_user= ".$user." and ut.id_utente= ".$utenteid."");
    return Database::resultset();
  }

	public function validarSenha($email,$senha)
  {
	  /*require_once ("alternativa/conexao.php");
	  $sql = "SELECT * FROM `ptaw-gr1-2017`.user WHERE email=:email AND password=:senha";
	  $stmt = Conexao::prepare($sql); //statment
	  $stmt->bindParam(':email', $email);
	  $stmt->bindParam(':senha', $senha);
	  $stmt->execute();
	  $stmt->fetch(PDO::FETCH_ASSOC);
	  print_r($stmt);
	  $count = $stmt->rowCount();
	  echo $count;
	  return $count;*/

	Database::query("SELECT * FROM `ptaw-gr1-2017`.user WHERE email='".$email."' AND password='".$senha."'");
	  //Database::queryArray(array(':email' => $email, ':senha' => $this->hashedPassword($senha)));
    Database::single();

    if (Database::rowCount() == 1) {
		return true;
	} else {
		return false;
	}
  }

	public function mostrarDadosAutenticacao($userID)
  {
	Database::query("SELECT email, password FROM `ptaw-gr1-2017`.user WHERE id=" . $userID);
	return Database::resultset();
  }

  public function editarPerfil($param)
  {
	  try{
		  if(count($param) == 2){
			Database::query("UPDATE `ptaw-gr1-2017`.user SET email=:email WHERE id=:id");
			Database::queryArray($param);
			Database::execute();
			return true;
		  } else if (count($param) == 3) {
			Database::query("UPDATE `ptaw-gr1-2017`.user SET email=:email, password=:password WHERE id=:id");
			Database::queryArray($param);
			Database::execute();
			return true;
		  } else {
			  return false;
		  }

	} catch(exception $e){
		  echo $e->getMessage();
	}
  }

  public function hashedPassword($password)
  {
    return hash('sha256', $password);
  }

	// ------------------------------------
	// by Dante
	// ------------------------------------
	public function getAllUsers()
  {
    Database::query("select * from `ptaw-gr1-2017`.user");
	return Database::resultset();
  }
	public function getWarning($utente){
    Database::query("select count(*) from `ptaw-gr1-2017`.alertas a
	left join `ptaw-gr1-2017`.user u on u.id=a.id_user
	left join `ptaw-gr1-2017`.utente ut on u.id=ut.id_user 
	where ut.id_utente = $utente");
	
	return Database::single();
  }

	public function removerUser($paramId)
  {
	  try{
			Database::query("DELETE FROM `ptaw-gr1-2017`.user WHERE id=:id");
			Database::queryArray($paramId);
			Database::execute();
			return true;
	} catch(exception $e){
		  echo $e->getMessage();
	}
  }

	public function bloquearUser($param)
  {
	  try{
			Database::query("UPDATE `ptaw-gr1-2017`.user SET bloqueado='1' WHERE id=:id");
			Database::queryArray($param);
			Database::execute();
			return true;
	} catch(exception $e){
		  echo $e->getMessage();
	}
  }

	// o admin desbloqueia um user
	public function desbloquearUser($param)
  {
	  try{
			Database::query("UPDATE `ptaw-gr1-2017`.user SET bloqueado='0' WHERE id=:id");
			Database::queryArray($param);
			Database::execute();
			return true;
	} catch(exception $e){
		  echo $e->getMessage();
	}
  }

	public function updatePerfil($param1,$param2,$param3)
  {
    try
    {
      Database::beginTransaction();

      Database::query("UPDATE `ptaw-gr1-2017`.`user` SET nome=:nome, data_nascimento=:data_nascimento, gender=:gender, image=:image WHERE id=:id");
      Database::queryArray($param1);
      Database::execute();

      Database::query("UPDATE `ptaw-gr1-2017`.`educacao_formal` set descricao=:descricao where id_user=:id_user");
      Database::queryArray($param2);
      Database::execute();

      Database::query("UPDATE `ptaw-gr1-2017`.`literacia_informatica`
	  set telemovel=:telemovel, computador_ou_tablet=:computador_ou_tablet where id_user=:id_user");
      Database::queryArray($param3);
      Database::execute();
      Database::endTransaction();
		return true;
    } catch (Exception $e)
    {
      Database::cancelTransaction();
    }

  }public function updatePerfilFamiliar($param1)
  {
    try
    {
      Database::query("UPDATE `ptaw-gr1-2017`.`user` SET nome=:nome, data_nascimento=:data_nascimento, gender=:gender, image=:image WHERE id=:id");
      Database::queryArray($param1);
      Database::execute();
	  return true;
    } catch (Exception $ex) {
      return false;
    }

  }public function updateFoto($param1)
  {
    try
    {
      Database::query("UPDATE `ptaw-gr1-2017`.`user` SET image=:image WHERE id=:id");
      Database::queryArray($param1);
      Database::execute();
	  return true;
    } catch (Exception $ex) {
      return false;
    }

  }

    public function ver_dados_saude_dor($hist_saude) {
        Database::query("SELECT * FROM `dor` WHERE  id_historico_saude= " . $hist_saude);
        return Database::resultset();
    }

    public function novo_dados_saude($array_historico) {
        try {
            Database::query("INSERT INTO `ptaw-gr1-2017`.historico_saude(id_utente, data, hipertensao_arterial,diabetes,artrose, espondiloartrose, patologia_vascular, patologia_respiratoria, cancro,depressao, trombose, outra)
        VALUES(:utente,:data,:hip_art,:dia,:art,:esp,:pat_vas,:pat_res,:can,:dep,:tro,:outra)");
            Database::queryArray($array_historico);
            Database::execute();
            $lastid = Database::lastInsertId();
            return $lastid;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function novo_dados_saude_ins_dor($array) {
        try {
            Database::query("INSERT INTO `ptaw-gr1-2017`.dor(`cabeca`, `pesoco`, `ombros`, `bracos`, `punhos_maos`, `coluna_toracica`, `lombar`, `anca`, `coxa`, `joelho`, `tornozelos_pes`, `id_historico_saude`)
        VALUES(:cabeca,:pesoco,:ombros,:bracos,:punhos_maos,:coluna_toracica,:lombar,:anca,:coxa,:joelho,:tornozelos_pes,:id_hist_saude)");
            Database::queryArray($array);
            Database::execute();
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function get_historico($id) {
        Database::query("select * from `ptaw-gr1-2017`.historico_saude where id=$id");
        return Database::resultset();
    }
    public function get_dor($id) {
        Database::query("select * from `ptaw-gr1-2017`.dor where id_historico_saude=$id");
        return Database::resultset();
    }

    public function update_historico($array_historico) {
        try {
            Database::query("UPDATE `ptaw-gr1-2017`.historico_saude SET
                data=:data, hipertensao_arterial=:hip_art,diabetes=:dia,artrose=:art, espondiloartrose=:esp,
                patologia_vascular=:pat_vas, patologia_respiratoria=:pat_res, cancro=:can,depressao=:dep,
                trombose=:tro, outra=:outra
                WHERE id=:id");
            Database::queryArray($array_historico);
            Database::execute();
            $lastid = Database::lastInsertId();
            return $lastid;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update_dor($array) {
        try {
            Database::query("UPDATE `ptaw-gr1-2017`.dor SET `cabeca`=:cabeca, `pesoco`=:pesoco, `ombros`=:ombros, bracos=:bracos, punhos_maos=:punhos_maos, coluna_toracica=:coluna_toracica, lombar=:lombar, anca=:anca, coxa=:coxa, joelho=:joelho, tornozelos_pes=:tornozelos_pes  WHERE id_historico_saude=:id");
            Database::queryArray($array);
            Database::execute();
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function estaBloqueado($userid) {
      Database::query("SELECT bloqueado FROM `ptaw-gr1-2017`.user WHERE id=" . $userid . "");
      $result = Database::single();

      if ($result['bloqueado'] == 1) {
        return true;
      } else {
        return false;
      }
    }

}




?>
