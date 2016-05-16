<?php
	require_once "/../bd/bd.php";
	/**
	* Classe País
	*/
	class Pais	{
		
		public function getPaises () {
			$app = new App;
			try {
				$sql = "SELECT * FROM pais";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($dados, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);				
			}
		}

		public function getPaisesAtivos () {
			$app = new App;
			try {
				$sql = "SELECT * FROM pais WHERE status = 1";
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($dados, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);				
			}
		}

		public function insertOrUpdate ($dados) {
			$app = New App;
			try {
				$sql = "INSERT INTO pais (nome, status) VALUES (:nome, 0)";
				$app->connectbd;
				$stm = $app->conexao->prepare();
				$stm->bindParam(':nome', $dados->nome_pais, PARAM_STR);
				$stm->bindParam(':sigla', $dados->sigla, PARAM_STR);
				$stm->execute();
				return json_encode("Deu Certo!", JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}
	}