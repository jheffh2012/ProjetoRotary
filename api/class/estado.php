<?php
	require_once("/../bd/bd.php");
	
	class Estado {
		public function getEstados () {
			$app = new App;
			try {
				$sql = "SELECT * FROM estados";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getEstado ($codigoestado) {
			$app = new App;
			try {
				$sql = "SELECT * FROM estados WHERE idestados = ". $codigoestado;
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$dados = $stm->fetch(PDO::FETCH_OBJ);
				return json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getEstadosPais ($idpais) {
			$app = new App;
			try {
				$sql = "SELECT * FROM estados WHERE pais_id = ".$idpais;
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