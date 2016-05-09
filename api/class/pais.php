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
		public function insertOrUpdate ($dados) {
			$app = New App;
			try {
				$sql = "INSERT INTO pais (nome, sigla) VALUES (:nome, :sigla)";
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