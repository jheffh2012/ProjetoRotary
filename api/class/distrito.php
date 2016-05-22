<?php
	require_once "/../bd/bd.php";

	class Distrito {
		public function getDistritos () {
			$app = new App;
			try {
				$sql = "SELECT * FROM distritos";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getDistrito ($idDistrito) {
			if (isset($idDistrito)) {
				$app = new App;
				try {
					$sql = "SELECT * FROM distritos WHERE iddistritos = ". $idDistrito;
					$app->connectbd();
					$stm = $app->conexao->prepare($sql);
					$stm->execute();
					$dados = $stm->fetch(PDO::FETCH_OBJ);
					return json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
				} catch (PDOException $e) {
					return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
				}
			}
		}

		public function getCidadesDistrito ($idDistrito) {
			if (isset($idDistrito)) {
				$app = new App;
				try {
					$sql = "SELECT c.idcidades, c.descricao, c.populacao, e.sigla, e.estado FROM distrito_cidades dc INNER JOIN cidades c ON dc.codigo_cidades = c.idcidades INNER JOIN estados e ON (c.estados_idestados = e.idestados) WHERE codigo_distrito = ".$idDistrito;
					$app->connectbd();
					$stm = $app->conexao->prepare($sql);
					$stm->execute();
					$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
				} catch (PDOException $e) {
					return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
				}
			}
		}

		public function deleteDistrito ($idDistrito) {
			$retorno = new Retorno;
			try {
				if (isset($idDistrito)) {
					$app = new App;
					try {
						$sql = "DELETE FROM distritos WHERE iddistritos = ".$idDistrito;
						$app->connectbd();
						$stm = $app->conexao->prepare($sql);
						$stm->execute();
						$retorno->retorno = true;
						return json_encode($retorno, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
					} catch (PDOException $e) {
						$retorno->retorno = false;
						$retorno->mensagem = $e->getMessage();
						return json_encode($retorno, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
					}
				}
			} catch (Exception $e) {
				$retorno->retorno = false;
				$retorno->mensagem = $e->getMessage();
				return json_encode($retorno, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			}
		}

		public function insertOrUpdate ($dados) {
			if (isset($dados)) {
				$app = new App;
				$retorno = new Retorno;
				try {
					$app->connectbd();
					$app->conexao->beginTransaction();
					try {
						if (!isset($dados->iddistritos)) {
							$sql = "INSERT INTO distritos (descricao) VALUES (:descricao)";
						} else {
							$sql = "UPDATE distritos SET descricao = :descricao WHERE iddistritos = ".$dados->iddistritos;
						}
						$stm = $app->conexao->prepare($sql);
						$stm->bindParam(':descricao', $dados->descricao, PDO::PARAM_STR);
						$stm->execute();
						$retorno->retorno = true;
						if ($retorno->retorno) {
							if (isset($dados->iddistritos)) {
								$codigo = $dados->iddistritos;
							} else {
								$codigo = $app->conexao->lastInsertId('iddistritos');
							}							
							if ($codigo) {
								$this->insertOrUpdateCidades($codigo, $dados->cidades, $app, $retorno);
							} else {
								$retorno->retorno = false;
								$retorno->mensagem = 'Não pegou o ultimo ID';
								return json_encode($retorno, JSON_UNESCAPED_UNICODE);
							}
						}
						$app->conexao->commit();
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);
					} catch (PDOException $e) {
						$app->conexao->rollback();
						$retorno->retorno = false;
						$retorno->mensagem = 'Erro aqui: '.$e->getMessage();
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);
					}
				} catch (PDOException $e) {
					$retorno->retorno = false;
					$retorno->mensagem = 'Erro aqui:'.$e->getMessage();
					return json_encode($retorno, JSON_UNESCAPED_UNICODE);
				}
			}
		}

		public function insertOrUpdateCidades ($iddistrito, $cidades, $app, $retorno) {
			if (isset($iddistrito)) {
				try {
					// $app->connectbd();
					// $app->conexao->beginTransaction();
					$sqldelete = "DELETE FROM distrito_cidades WHERE codigo_distrito = ".$iddistrito;
					$sqlInsert = "INSERT INTO distrito_cidades (codigo_distrito, codigo_cidades) VALUES (:codigo_distrito, :codigo_cidades)";
					
					try {
						$stmdelete = $app->conexao->prepare($sqldelete);
						$stmdelete->execute();
						$stmInsert = $app->conexao->prepare($sqlInsert);
						foreach ($cidades as $c) {
								$stmInsert->bindParam(':codigo_distrito', $iddistrito, PDO::PARAM_INT);
								$stmInsert->bindParam(':codigo_cidades', $c->idcidades, PDO::PARAM_INT);
								$stmInsert->execute();
						}
						$retorno->retorno = true;
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);	
					} catch (Exception $e) {
						$retorno->retorno = false;
						$retorno->mensagem = 'Erro aqui '.$e->getMessage();
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);	
					}
					// $app->conexao->commit();
					
				} catch (PDOException $e) {
					// $app->conexao->rollback();
					$retorno->retorno = false;
					$retorno->mensagem = 'Erro aqui: '.$e->getMessage();
					return json_encode($retorno, JSON_UNESCAPED_UNICODE);
				}
			}
		}

	}