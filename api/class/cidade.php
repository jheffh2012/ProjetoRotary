<?php
	require_once "/../bd/bd.php";

	class Cidade {
		public function getCidades ($idestado) {
			$app = new App;
			try {
				$sql = "SELECT * FROM cidades WHERE estados_idestados = ".$idestado;
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$dados = $stm->fetchAll(PDO::FETCH_ASSOC);
				return json_encode($dados, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function getCidade ($idcidade) {
			$app = new App;
			try {
				$sql = "SELECT * FROM cidades WHERE idcidades = ".$idcidade;
				$app->connectbd();
				$stm = $app->conexao->prepare($sql);
				$stm->execute();
				$dados = $stm->fetch(PDO::FETCH_OBJ);
				return json_encode($dados, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}

		public function insertOrUpdate ($dados) {
			$app = new App;
			$retorno = new Retorno;
			try {
				$app->connectbd();
				if (isset($dados->idcidades)) {
					$sql = "UPDATE cidades SET descricao = :descricao, estados_idestados = :estados_idestados populacao = :populacao WHERE idcidades = ".$dados->idcidades;
				} else {
					$sql = "INSERT INTO cidades (descricao, estados_idestados, populacao) VALUES (:descricao, :estados_idestados, :populacao)";
				}
				$stm = $app->conexao->prepare($sql);
				$stm->bindParam(':descricao', $dados->descricao, PARAM_STR);
				$stm->bindParam(':estados_idestados', $dados->estados_idestados, PARAM_INT);
				$stm->bindParam(':populacao', $dados->populacao, PARAM_INT);
				$stm->execute();

				$retorno->retorno = true;
				return json_encode($retorno, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				$retorno->retorno = false;
				$retorno->mensagem = $e->getMessage();
				return json_encode($retorno, JSON_UNESCAPED_UNICODE);
			}
		}

		public function deleteCidade ($idcidades) {
			$app = new App;
			$retorno = new Retorno;
			try {
				$sql = "DELETE FROM cidades WHERE idcidades = ".$idcidades;
				$retorno->retorno = true;
				return json_encode($retorno, JSON_UNESCAPED_UNICODE);
			} catch (PDOException $e) {
				$retorno->retorno = false;
				$retorno->mensagem = $e->getMessage();
				return json_encode($retorno, JSON_UNESCAPED_UNICODE);
			}
		}
	}