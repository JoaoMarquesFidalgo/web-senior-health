<?php
class  Conexao {
	private static $instance;
	//private $DB_HOST = 'estga-dev.clients.ua.pt';
	//$DB_NAME = 'ptaw-gr1-2017';
	//$DB_USER = 'ptaw-gr1-2017';
	//$DB_PASS = 'H33!6j8Z';
	
	// se ja existir uma instancia, nao sera preciso fazer nova requisicao
	public static function getInstance() {
		// como o atributo $instance é static, entao precisa usar o self::$instance para acessa-lo
		// se nao fosse static, chamaria atraves da forma this->instance
		if(!isset(self::$instance)) {
			try {
				self::$instance = new PDO('mysql:host=estga-dev.clients.ua.pt;dbname=ptaw-gr1-2017;charset=utf8', 'ptaw-gr1-2017', 'H33!6j8Z');
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		return self::$instance;
	}
	
	// Um método static significa que nao precisa ser criada uma instancia da classe (objeto) para poder acessá-lo
	public static function prepare($sql) {
		return self::getInstance()->prepare($sql);
	}
}
?>