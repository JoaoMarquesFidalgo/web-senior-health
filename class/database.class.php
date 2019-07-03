<?php

class Database
{

  private $connection = [
    'host' => 'estga-dev.clients.ua.pt',
    'user' => 'ptaw-gr1-2017',
    'password' => 'H33!6j8Z',
    'database' => 'ptaw-gr1-2017'
  ];

  private $dbh;
  private $error;
  private $stmt;

  public function __construct()
  {
    $dsn = 'mysql:host=' . $this->connection["host"] . ';dbname=' . $this->connection["database"];
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try
    {
      $this->dbh = new PDO($dsn, $this->connection["user"], $this->connection["password"], $options);

    } catch (Exception $e)
    {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  /*
  * query function; Prepara o SQL
  * @param string $query Instrução SQL
  */

  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  /*
  * bind function; Atribui valores (placeholder) do SQL
  * @param string $param Placeholder a instrução SQL, ex.: :nome
  * @param string $value Valor do placeholder SQL, ex.: João
  * @param string $type datatype do $param, ex.: string
  */

  public function bind($param, $value, $type = null)
  {
    if(is_null($type))
    {
      switch(true)
      {
        case is_int($value):
        $type = PDO::PARAM_INT;
        break;
        case is_bool($value):
        $type = PDO::PARAM_BOOL;
        break;
        case is_null($value):
        $type = PDO::PARAM_NULL;
        break;
        default:
        $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  /*
  * queryArray function; Atribui key e value em array e executa a função bind
  * @param string $array Placeholder e value a instrução SQL, ex.: :nome
  * ex.: $database->queryArray(array(':user' => 'João', ':pass' => 'teste'));
  */

  public function queryArray($array)
  {
    foreach($array as $key => $item)
    {
      if ($key[0] != ':')
      {
        $key = ':' . $key;
      }
      $this->bind($key, $item);
    }
  }
  /*
  * execute function; Executa o SQL
  * @return boolean
  */

  public function execute()
  {
    return $this->stmt->execute();
  }

  /*
  * resultset function; Retorna em array do resultado da query
  * @return array
  */

  public function resultset()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /*
  * single function; Retorna um único resultado da base de dados
  * @return array
  */

  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  /*
  * rowCount function; Retorna o número de rows afectadas
  * @return integer
  */

  public function rowCount()
  {
    return $this->stmt->rowCount();
  }

  /*
  * lastInsertId function; Retorna o id da última row inserida
  * @return integer
  */

  public function lastInsertId()
  {
    return $this->dbh->lastInsertId();
  }

  /*
  * transactions functions; Começa a transação
  * Em múltiplas querys que estejam associadas, por exemplo:
  * contas e movimentos (sector da banca)... Se houver um erro numa query convém que a outra query
  * não sofra alterações porque uma depende da outra.
  * @return boolean
  */

  public function beginTransaction()
  {
    return $this->dbh->beginTransaction();
  }

  public function endTransaction()
  {
    return $this->dbh->commit();
  }

  public function cancelTransaction()
  {
    return $this->dbh->rollBack();
  }
}

?>
