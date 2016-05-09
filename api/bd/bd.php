<?php
	class App {
		public $conexao;
		public $bd_host = "localhost";
		public $bd_name = "rotary";
		public $bd_user = "root";
		public $bd_pass = "";
		private $opcoes = "";

		public function connectbd() {
			try {
				$this->opcoes = array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
				);
				$this->conexao = new PDO('mysql:host:'.$this->bd_host.';port=3306;dbname='.$this->bd_name.';charset=utf8', $this->bd_user, $this->bd_pass, $this->opcoes);
				$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo "Erro ao conectar ao Banco de dados: ". $e->getMessage();
			};
		}
	}

	class Retorno {
		public $retorno;
		public $mensagem;
	}
