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
	}