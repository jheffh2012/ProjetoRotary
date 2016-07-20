<?php
	require_once("/../bd/bd.php");

	class Clube {
		public function getClubes ($idusuario) {
			$app = new App;
			try {
				$sqlUsuario = "SELECT admin FROM usuario WHERE idusuario = ". $idusuario;
				
				$app->connectbd();

				$stmUsuario = $app->conexao->prepare($sqlUsuario);
				$stmUsuario->execute();
				$user = $stmUsuario->fetch(PDO::FETCH_OBJ);
				if (isset($user)) {
					if ($user->admin == 1) {
						$sql = "SELECT c.idclubes, c.descricao as clube, d.descricao as distrito, cd.descricao as cidade, cd.populacao FROM clubes c INNER JOIN distritos d ON (c.distritos_iddistritos = d.iddistritos) INNER JOIN cidades cd ON (c.codigo_cidade = cd.idcidades)";
					} else {
						$sql = "SELECT c.idclubes, c.descricao as clube, d.descricao as distrito, cd.descricao as cidade, cd.populacao FROM clubes c INNER JOIN distritos d ON (c.distritos_iddistritos = d.iddistritos) INNER JOIN usuario_distritos ud ON (d.iddistritos = ud.distritos_iddistritos) INNER JOIN cidades cd ON (c.codigo_cidade = cd.idcidades) WHERE ud.usuario_idusuario = ". $idusuario;
					}
					$app->connectbd();
					$stm = $app->conexao->prepare($sql);
					$stm->execute();
					$lista = $stm->fetchAll(PDO::FETCH_ASSOC);
					return json_encode($lista, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
				}
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getClube ($idClube) {
			$app = new App;
			try {
				$sql = "SELECT * FROM clubes c WHERE c.idclubes = ". $idClube;
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$lista = $stm->fetch(PDO::FETCH_OBJ);
				return json_encode($lista, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getSociosClube ($idClube) {
			$app = new App;
			try {
				$sql = "SELECT * FROM clubes_socios WHERE clubes_idclubes = ". $idClube . " ORDER BY data";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$lista = $stm->fetchAll(PDO::FETCH_OBJ);
				return json_encode($lista, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function deleteSociosClube ($idclubesocios) {
			$app = new App;
			$retorno = new Retorno;
			try {
				$sql = "DELETE FROM clubes_socios WHERE id = ". $idclubesocios;
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

		public function insertClubesSocios ($data, $clubes) {
			$app = new App;
			$retorno = new Retorno;
			try {
				$sql = "SELECT * FROM clubes_socios WHERE data = :data AND clubes_idclubes = :clubes_idclubes";
				$sqlUpdate = "UPDATE clubes_socios SET socios = :socios WHERE clubes_idclubes = :clubes_idclubes AND data = :data";
				$sqlInsert = "INSERT INTO clubes_socios (clubes_idclubes, data, socios) VALUES (:clubes_idclubes, :data, :socios)";
				$app->connectbd();
				if (count($clubes) > 0) {
					$app->conexao->beginTransaction();
					$stm = $app->conexao->prepare($sql);
					$stmUpdate = $app->conexao->prepare($sqlUpdate);
					$stmInsert = $app->conexao->prepare($sqlInsert);
					try {
						foreach ($clubes as $clube) {
							$stm->bindParam(':data', $data, PDO::PARAM_STR);
							$stm->bindParam(':clubes_idclubes', $clube->idclubes, PDO::PARAM_INT);
							$stm->execute();
							$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
							if (count($dados) > 0) {
								$stmUpdate->bindParam(':data', $data, PDO::PARAM_DATE);
								$stmUpdate->bindParam(':socios', $clube->socios, PDO::PARAM_INT);
								$stmUpdate->bindParam(':clubes_idclubes', $clubes->idclubes, PDO::PARAM_INT);
								$stmUpdate->execute();
							} else {
								$dateTemp = new Datetime($data);
								$temp = $dateTemp->format('Y-m-d');
								$stmInsert->bindParam(':data', $temp, PDO::PARAM_STR);
								$stmInsert->bindParam(':socios', $clube->socios, PDO::PARAM_INT);
								$stmInsert->bindParam(':clubes_idclubes', $clube->idclubes, PDO::PARAM_INT);
								$stmInsert->execute();
							}
						}
						$app->conexao->commit();
						$retorno->retorno = true;
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);
					} catch (Exception $e) {
						$app->conexao->rollback();
						$retorno->retorno = false;
						$retorno->mensagem = $e->getMessage();
						return json_encode($retorno, JSON_UNESCAPED_UNICODE);
					}					
				}
			} catch (PDOException $e) {
				$retorno->retorno = false;
				$retorno->mensagem = $e->getMessage();
				return json_encode($retorno, JSON_UNESCAPED_UNICODE);
			}
		}

		public function getClubesCidade ($idCidade) {
			$app = new App;
			try {
				$sql = "SELECT c.idclubes, c.descricao as clube, d.descricao as distrito, cd.descricao as cidade, cd.populacao FROM clubes c INNER JOIN distritos d ON (c.distritos_iddistritos = d.iddistritos) INNER JOIN cidades cd ON (c.codigo_cidade = cd.idcidades) WHERE c.codigo_cidade = ".$idCidade;
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$lista = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($lista, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getClubesDistrito ($idDistrito) {
			$app = new App;
			try {
				$sql = "SELECT c.idclubes, c.descricao as clube, d.descricao as distrito, cd.descricao as cidade, cd.populacao FROM clubes c INNER JOIN distritos d ON (c.distritos_iddistritos = d.iddistritos) INNER JOIN cidades cd ON (c.codigo_cidade = cd.idcidades) WHERE d.iddistritos = ".$idDistrito;
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$lista = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($lista, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function insertOrUpdate ($dados) {
			$app = new App;
			$retorno = new Retorno;
			try {
				$app->connectbd();
				if (isset($dados->idclubes)) {
					$sql = "UPDATE clubes SET descricao = :descricao, codigo_cidade = :codigo_cidade, distritos_iddistritos = :distritos_iddistritos WHERE idclubes = ". $dados->idclubes;
				} else {
					$sql = "INSERT INTO clubes (descricao, codigo_cidade, distritos_iddistritos) VALUES (:descricao, :codigo_cidade, :distritos_iddistritos)";
				}

				$stm = $app->conexao->prepare($sql);
				$stm->bindParam(':descricao', $dados->descricao, PDO::PARAM_INT);
				$stm->bindParam(':codigo_cidade', $dados->cidade->idcidades, PDO::PARAM_INT);
				$stm->bindParam(':distritos_iddistritos', $dados->distrito->iddistritos, PDO::PARAM_INT);
				$stm->execute();

				$retorno->retorno = true;
				return json_encode($retorno, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				$retorno->retorno = false;
				$retorno->mensagem = $e->getMessage();
				return json_encode($retorno, JSON_UNESCAPED_UNICODE);
			}
		}

		public function deleteClube ($codigoClube) {
			if ($codigoClube) {
				$app = new App;
				$retorno = new Retorno;
				try {
					$sql = "DELETE FROM clubes WHERE idclubes = ". $codigoClube;
					$app->connectbd();
					$stm = $app->conexao->prepare($sql);
					$stm->execute();

					$retorno->retorno = true;
					return json_encode($retorno, JSON_UNESCAPED_UNICODE);
				} catch (PDOException $e) {
					$retorno->retorno = false;
					$retorno->mensagem = $e->getMessage();
					return json_encode($retorno, JSON_UNESCAPED_UNICODE);
				}
			}
		}
	}