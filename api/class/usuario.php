<?php
	require_once "/../bd/bd.php";
	require_once '/../vendor/autoload.php';

	use \Firebase\JWT\JWT;

	/**
	* 
	*/
	class Login
	{
		public $logado;
		public $admin;
		public $token;
	}

	/**
	* 
	*/
	class Usuario {
		private $key = "rotary.distritos.2016";
		public function Login ($usuario, $senha) {
			$app = new App;
			$l = new Login;
			$jwt = new JWT;
			try {
				$sql = "SELECT nome, usuario, admin FROM usuario WHERE usuario = :usuario AND $senha = :senha";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->bindParam(':usuario', $usuario, PDO::PARAM_STR);
				$stm->bindParam(':senha', $senha, PDO::PARAM_STR);
				$stm->execute();
				if ($stm->rowCount() == 1) {
					$user = $stm->fetch(PDO::FETCH_OBJ);
					$retorno = $jwt->encode($user, $this->key);
					$l->logado = true;
					$l->token = $retorno;
					if ($user->admin == 1) {
						$l->admin = true;
					} else {
						$l->admin = false;
					}
					return json_encode($l);
				} else {
					$l->logado = false;
					$l->admin = false;
					return json_encode($l);
				}
			} catch (PDOException $e) {
				$l->logado = false;
				$l->admin = false;
				return json_encode($l);
			}
		}

		public function getUsuarios () {
			$app = new App;
			try {
				$sql = "SELECT idusuario, nome FROM usuario";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				return json_encode($stm->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode("Erro ao buscar dados!", JSON_UNESCAPED_UNICODE);
			}
		}

		public function userExists ($username) {
			$app = new App;
			$retorno = new Retorno;
			try {
				$sql = "SELECT idusuario FROM usuario WHERE usuario = :username";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->bindParam(':username', $username, PDO::PARAM_STR);
				$stm->execute();
				if ($stm->rowCount() > 0) {
					$retorno->retorno = false;
					$retorno->mensagem = "usuário não existe no banco de dados!";
				} else {
					$retorno->retorno = true;
					$retorno->mensagem = "usuário já cadastrado! Verifique!";
				}
			} catch (PDOException $e) {
				$retorno->retorno = true;
				$retorno->mensagem = "Ocorreram erros ao consultar dados do usuário! Verifique! Erro: ". $e->getMessage();
			}
		}

		public function getUser($token) {
			$app = new App;
			$retorno = new Retorno;
			$jwt = new JWT;
			try {
				if (isset($token)) {
					$dados = $jwt->decode($token, $this->key);
					if (isset($dados)) {
						$retorno->retorno = true;
					} else {
						$retorno->retorno = false;
						$retorno->mensagem = "Token inválido";
					}
				} else {
					$retorno->retorno = false;
					$retorno->mensagem = "Token não informado!";
				}
			} catch (PDOException $e) {
				$retorno->retorno = false;
				$retorno->mensagem = "Erro ao buscar Token! Erro: ". $e->getMessage();
			}
			return json_encode($retorno);
		}
	}