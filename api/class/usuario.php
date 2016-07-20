<?php
	require_once("/../bd/bd.php");
	require_once("/../vendor/autoload.php");

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
				$sql = "SELECT idusuario, nome, usuario, admin FROM usuario WHERE usuario = :usuario AND senha = :senha";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->bindParam(':usuario', $usuario, PDO::PARAM_STR);
				$stm->bindParam(':senha', $senha, PDO::PARAM_STR);
				$stm->execute();
				if ($stm->rowCount() == 1) {
					$user = $stm->fetch(PDO::FETCH_OBJ);
					$data = [
						'iat'  => time(),         // Issued at: time when the token was generated
						'exp'  => time() + (60*60*15),           // Expire
						'data' => [                  // Data related to the signer user
							'userId'   => $user->idusuario, // userid from the users table
							'userName' => $user->nome, // User name
						]
					];
					$retorno = $jwt->encode($data, $this->key);
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

		public function getUsuarios ($userId) {
			$app = new App;
			try {
				$sqlAdm = "SELECT admin FROM usuario WHERE idusuario = ".$userId;

				$app->connectbd();

				$stmAdm = $app->conexao->prepare($sqlAdm);
				$stmAdm->execute();
				$u = $stmAdm->fetch(PDO::FETCH_OBJ);
				if (isset($u)) {
					if ($u->admin == 1) {
						$sql = "SELECT idusuario, nome FROM usuario";
						$stm = $app->conexao->prepare($sql);
						$stm->execute();
						return json_encode($stm->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
					} else {
						$u = [];
						return json_encode($u);
					}
				} else {
					return json_encode($u);
				}				
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
				if ($stm->rowCount() == 0) {
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
			if (isset($retorno)) {
				return json_encode($retorno);
			} else {
				return json_encode("Retorno Vazio");
			}
		}

		public function getUser($token) {
			$app = new App;
			$retorno = new Retorno;
			$jwt = new JWT;
			try {
				if (isset($token)) {
					$dados = $jwt->decode($token, $this->key, array('HS256'));
					if (isset($dados)) {
						$retorno->retorno = true;
						$retorno->mensagem = "Token Válido";
					} else {
						$retorno->retorno = false;
						$retorno->mensagem = "Token inválido";
					}
				} else {
					$retorno->retorno = false;
					$retorno->mensagem = "Token não informado!";
				}
			} catch (Exception $e) {
				$retorno->retorno = false;
				$retorno->mensagem = "Erro ao buscar Token! Erro: ". $e->getMessage();
			}
			return $retorno;
		}

		public function newToken($token) {
			$app = new App;
			$jwt = new JWT;
			try {
				if (isset($token)) {
					$dados = $jwt->decode($token, $this->key, array('HS256'));
					if (isset($dados)) {
						$sql = "SELECT usuario, senha FROM usuario WHERE idusuario = ". $dados->data->userId;
						$app->connectbd();
						$stm = $app->conexao->prepare($sql);
						$stm->execute();
						$user = $stm->fetch(PDO::FETCH_OBJ);
						$newT = json_decode($this->Login($user->usuario, $user->senha));
						return $newT->token; 
					}
				}
			} catch (Exception $e) {
				$retorno->retorno = false;
				$retorno->mensagem = "Erro ao buscar Token! Erro: ". $e->getMessage();
			}
			return $retorno;
		}

		public function getUserId($token) {
			$app = new App;
			$jwt = new JWT;
			$retorno = "";
			try {
				if (isset($token)) {
					$dados = $jwt->decode($token, $this->key, array('HS256'));
					if (isset($dados)) {
						$retorno = $dados->data->userId;
					} else {
						$retorno = -1;
					}
				} else {
					$retorno = -1;
				}
			} catch (Exception $e) {
				$retorno = -1;
			}
			return $retorno;
		}

		public function getDadosUser ($userId) {
			$app = New App;
			try {
				$sql = "SELECT idusuario, nome, usuario, admin FROM usuario WHERE idusuario = ". $userId;
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$u = $stm->fetch(PDO::FETCH_OBJ);
				return json_encode($u, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode("Erro ao buscar usuário! Erro: " . $e->getMessage());
			}
		}

		public function getDistritosUser ($userId) {
			$app = New App;
			try {
				$sql = "SELECT d.iddistritos, d.descricao FROM usuario u INNER JOIN usuario_distritos ud ON (u.idusuario = ud.usuario_idusuario) INNER JOIN distritos d ON (ud.distritos_iddistritos = d.iddistritos) WHERE idusuario = ". $userId;
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				if ($stm->rowCount() > 0) {
					$u = $stm->fetchAll(PDO::FETCH_OBJ);
				} else {
					$u = [];
				}
				return json_encode($u);
			} catch (PDOException $e) {
				return json_encode("Erro ao buscar distritos do usuário! Erro: " . $e->getMessage());
			}
		}

		public function insertOrUpdate  ($usuario) {
			$app = new App;
			$retorno = new Retorno;
			$userId = "";
			try {
				$app->connectbd();
				$app->conexao->beginTransaction();
				if (isset($usuario->idusuario)) {
					$sql = "UPDATE usuario SET nome = :nome, usuario = :usuario, admin = :admin WHERE idusuario = ". $usuario->idusuario;
					$stm = $app->conexao->prepare($sql);
					$stm->bindParam(':nome', $usuario->nome, PDO::PARAM_STR);
					$stm->bindParam(':usuario', $usuario->usuario, PDO::PARAM_STR);
					if (isset($usuario->admin) && ($usuario->admin)) {
						$admin = 1;
					} else {
						$admin = 0;						
					}
					$stm->bindParam(':admin',  $admin, PDO::PARAM_INT);
					$stm->execute();
					if (!$usuario->admin) {
						$dados = $this->insertDistritosUser($usuario->idusuario, $usuario->distritos, $app, $retorno);
					}
				} else {
					$sql = "INSERT INTO usuario (nome, usuario, senha, admin) VALUES (:nome, :usuario, :senha, :admin)";
					$stm = $app->conexao->prepare($sql);
					$stm->bindParam(':nome', $usuario->nome, PDO::PARAM_STR);
					$stm->bindParam(':usuario', $usuario->usuario, PDO::PARAM_STR);
					$stm->bindParam(':senha', $usuario->senha, PDO::PARAM_STR);
					if (isset($usuario->admin) && ($usuario->admin)) {
						$admin = 1;
					} else {
						$admin = 0;						
					}
					$stm->bindParam(':admin',  $admin, PDO::PARAM_INT);
					
					$stm->execute();

					$userId = $app->conexao->lastInsertId('idusuario');
					if (!isset($usuario->admin) || (!$usuario->admin)) {
						$dados = $this->insertDistritosUser($userId, $usuario->distritos, $app, $retorno);
					} else {
						$retorno->retorno = true;
					}
				}
				$app->conexao->commit();
			} catch (PDOException $e) {
				$retorno->retorno = false;
				$retorno->mensagem = "Erro ao salvar usuario! Erro:" . $e->getMessage();
			}
			return $retorno;
		}

		public function insertDistritosUser ($idusuario, $distritos, $app, $retorno) {
			$sqlDelete = "DELETE FROM usuario_distritos WHERE usuario_idusuario = ".$idusuario;
			$sqlInsert = "INSERT INTO usuario_distritos (usuario_idusuario, distritos_iddistritos) VALUES (:usuario_idusuario, :distritos_iddistritos)";
			try {
				$stmDelete = $app->conexao->prepare($sqlDelete);
				$stmDelete->execute();
			} catch (PDOException $e) {
				$retorno->retorno = false;
				$retorno->mensagem = "Erro ao deletar distritos do usuario! Erro: ".$e->getMessage();
			}
			try {
				$stmInsert = $app->conexao->prepare($sqlInsert);
				foreach ($distritos as $distrito) {
					$stmInsert->bindParam(':distritos_iddistritos', $distrito->iddistritos, PDO::PARAM_INT);
					$stmInsert->bindParam(':usuario_idusuario', $idusuario, PDO::PARAM_INT);
					$stmInsert->execute();
				}
				$retorno->retorno = true;
			} catch (PDOException $e) {
				$retorno->retorno = false;
				$retorno->mensagem = "Erro ao salvar distritos do usuario! Erro: ".$e->getMessage();
			}
		}
	}
