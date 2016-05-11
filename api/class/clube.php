<?php
	require_once "/../bd/bd.php";

	class Clube {
		public function getClubes () {
			$app = new App;
			try {
				$sql = "SELECT * FROM clubes";
				$app->connectbd();
				$stm = $app->conexao->preprare($sql);
				$stm->execute();
				$lista = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($lista, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getClube ($idClube) {
			$app = new App;
			try {
				$sql = "SELECT * FROM clubes WHERE idclubes = ". $idClube;
				$app->connectbd();
				$stm = $app->conexao->preprare($sql);
				$stm->execute();
				$lista = $stm->fetch(PDO::FETCH_OBJ);
				return json_encode($lista, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getClubesCidade ($idCidade) {
			$app = new App;
			try {
				$sql = "SELECT * FROM clubes WHERE codigo_cidade = ".$idCidade;
				$app->connectbd();
				$stm = $app->conexao->preprare($sql);
				$stm->execute();
				$lista = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($lista, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getClubesDistrito ($idDistrito) {
			$app = new App;
			try {
				$sql = "SELECT c.* FROM clubes c INNER JOIN cidades cd ON (c.codigo_cidade = cd.idcidades) INNER JOIN distrito_cidades dc on (cd.idcidades = dc.codigo_cidade) WHERE dc.codigo_distrito = ".$idDistrito;
				$app->connectbd();
				$stm = $app->conexao->preprare($sql);
				$stm->execute();
				$lista = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($lista, JSON_UNESCAPED_UNICODE);
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
					$sql = "UPDATE clubes SET descricao = :descricao, codigo_cidade = :codigo_cidade, associados = :associados WHERE idclubes = ". $dados->idclubes;
				} else {
					$sql = "INSERT INTO clubes (descricao, codigo_cidade, associados) VALUES (:descricao, :codigo_cidade, :associados)";
				}

				$stm = $app->conexao->preprare($sql);
				$stm->bindParam(':descricao', $dados->descricao, PARAM_STR);
				$stm->bindParam(':codigo_cidade', $dados->codigo_cidade, PARAM_INT);
				$stm->bindParam(':associados', $dados->associados, PARAM_INT);
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