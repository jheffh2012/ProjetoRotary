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
				return json_encode($dados, JSON_UNESCAPED_UNICODE);
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
					return json_encode($dados, JSON_UNESCAPED_UNICODE);
				} catch (PDOException $e) {
					return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
				}
			}
		}

		public function getCidadesDistrito ($idDistrito) {
			if (isset($idDistrito)) {
				$app = new App;
				try {
					$sql = "SELECT * FROM distrito_cidades dc INNER JOIN cidades c ON dc.codigo_cidades = c.idcidades WHERE codigo_distrito = ".$idDistrito;
					$app->connectbd();
					$stm = $app->conexao->prepare($sql);
					$stm = execute();
					$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($dados, JSON_UNESCAPED_UNICODE);
				} catch (PDOException $e) {
					return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
				}
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
						if (isset($dados->iddistritos)) {
							$sql = "INSERT INTO distritos (descricao) VALUES (:descricao)";
						} else {
							$sql = "UPDATE distritos SET descricao = :descricao WHERE iddistritos = ".$dados->iddistritos;
						}
						$stm = $app->conexao->prepare($sql);
						$stm->bindParam(':descricao', $dados->descricao, PARAM_STR);
						$stm->execute();
						$app->conexao->commit();
						$retorno->retorno = true;
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);
					} catch (PDOException $e) {
						$app->conexao->rollback();
						$retorno->retorno = false;
						$retorno->mensagem = $e->getMessage();
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);
					}
				} catch (PDOException $e) {
					$retorno->retorno = false;
					$retorno->mensagem = $e->getMessage();
					return json_encode($retorno, JSON_UNESCAPED_UNICODE);
				}
			}
		}

		public function insertOrUpdateCidades ($iddistrito, $cidades) {
			if (isset($iddistrito)) {
				$app = new App;
				$retorno = new Retorno;
				try {
					$app->connectbd();
					$app->conexao->beginTransaction();
					$sqlVerifica = "SELECT * FROM distrito_cidades WHERE codigo_distrito = ".$iddistrito;
					$sqlExiste = "SELECT * FROM distrito_cidades WHERE codigo_distrito = ". $iddistrito. " AND codigo_cidades = :codigo_cidades";
					$sqlInsert = "INSERT INTO distrito_cidades (codigo_distrito, codigo_cidades) VALUES (:codigo_distrito, :codigo_cidades)";
					$stm = $app->conexao->prepare($sqlVerifica);
					$stm->execute();
					$cidadesVinculadas = $stm->fetchAll(PDO::FETCH_ASSOC);

					$stm = $app->conexao->prepare($sqlExiste);
					foreach ($cidadesVinculadas as $cv) {
						$achou = false;
						foreach ($cidades as $c) {
							$stm->bindParam(':codigo_cidades', $c->codigo_cidades, PARAM_INT);
							$stm->execute();
							if ($stm->rowCount() = 0) {
								$sqlDelete = "DELETE FROM distrito_cidades WHERE codigo_distrito = ".$idDistrito." AND codigo_cidades = ".$c->codigo_cidades;
								$stmDel = $app->conexao->prepare($sqlDelete);
								$stmDel->execute();
							}
						}						
					}

					try {
						$stm = $app->conexao->prepare($sqlExiste);
						foreach ($cidades as $c) {
							$stm->bindParam(':codigo_cidades', $c->codigo_cidades);
							$stm->execute();
							if ($stm->rowCount() = 0) {
								$stmInsert = $app->conexao->prepare($sqlInsert);
								$stmInsert->bindParam(':codigo_distrito', $c->codigo_distrito, PARAM_INT);
								$stmInsert->bindParam(':codigo_cidades', $c->codigo_cidades, PARAM_INT);
								$stmInsert->execute();
							}

						}
						$retorno->retorno = true;
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);	
					} catch (Exception $e) {
						$retorno->retorno = false;
						$retorno->mensagem = $e->getMessage();
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);	
					}
					$app->conexao->commit();
					
				} catch (PDOException $e) {
					$app->conexao->rollback();
					$retorno->retorno = false;
					$retorno->mensagem = $e->getMessage();
					return json_encode($retorno, JSON_UNESCAPED_UNICODE);
				}
			}
		}

	}