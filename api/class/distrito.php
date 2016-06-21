<?php
	require_once "/../bd/bd.php";

	/**
	* 
	*/
	class Percapita	{
		public $idcidade;
		public $cidade;
		public $clubes;
		public $associados;
		public $populacao;
		public $percapita;
		public $media;
	}

	/**
	* 
	*/
	class ListaClubes {
		public $idclube;
		public $nome;
		public $associados;
	}

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

		public function getTamanhoClubes ($idDistrito, $tipo) {
			if (isset($idDistrito)) {
				$arrClubes = [];
				$sqlMaiores = "SELECT idclubes, descricao, socios FROM(SELECT c.idclubes,c.descricao,(SELECT cs.socios FROM clubes_socios cs WHERE cs.clubes_idclubes = c.idclubes ORDER BY cs.DATA DESC LIMIT 1) as socios FROM clubes c WHERE c.distritos_iddistritos = :distritos_iddistritos) AS teste ORDER BY socios DESC";
				$sqlMenores = "SELECT idclubes, descricao, socios FROM(SELECT c.idclubes,c.descricao,(SELECT cs.socios FROM clubes_socios cs WHERE cs.clubes_idclubes = c.idclubes ORDER BY cs.DATA DESC LIMIT 1) as socios FROM clubes c WHERE c.distritos_iddistritos = :distritos_iddistritos) AS teste ORDER BY socios";

				$app = New App;
				try {
					$app->connectbd();
					if ($tipo == 0) {
						$stm = $app->conexao->prepare($sqlMaiores);
					} else {
						$stm = $app->conexao->prepare($sqlMenores);
					}
					$stm->bindParam(':distritos_iddistritos', $idDistrito, PDO::PARAM_INT);
					$stm->execute();
					$totalDados = $stm->rowCount();
					$clubes = $stm->fetchAll(PDO::FETCH_OBJ);
					$quant = 0;
					foreach ($clubes as $clube) {
						array_push($arrClubes, $clube);
						$quant = $quant + 1;
						if (intval($totalDados / 2) == $quant) {
							break;
						}
					}
					
					return json_encode($arrClubes, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
				} catch (PDOException $e) {
					return json_encode("Erro ao buscar clubes! Erro: " . $e->getMessage());
				}
			}
		}

		public function getPercapta ($idDistrito, $tipo) {
			if (isset($idDistrito)) {
				$arrDados = [];
				$arrPercapitas = [];
				$sql = "SELECT C.idcidades, C.descricao, C.populacao FROM distritos D INNER JOIN distrito_cidades DC ON (D.iddistritos = DC.codigo_distrito) INNER JOIN cidades C ON (DC.codigo_cidades = C.idcidades) WHERE EXISTS (SELECT CL.idclubes FROM clubes CL WHERE CL.codigo_cidade = DC.codigo_cidades) AND (D.iddistritos = :iddistritos)";
				$sqlclubes = "SELECT c.idclubes FROM clubes c WHERE c.codigo_cidade = :codigo_cidade";
				$sqlassociados = "SELECT cs.socios FROM clubes_socios cs WHERE cs.clubes_idclubes = :clubes_idclubes ORDER BY cs.DATA DESC LIMIT 1";
				$app = new App;
				try {
					$app->connectbd();
					$stm = $app->conexao->prepare($sql);
					$stm->bindParam(':iddistritos', $idDistrito, PDO::PARAM_INT);
					$stm->execute();
					$dados = $stm->fetchAll(PDO::FETCH_OBJ);
					$stmclubes = $app->conexao->prepare($sqlclubes);
					$stmassociados = $app->conexao->prepare($sqlassociados);
					foreach ($dados as $d) {
						$percapita = new Percapita;
						$percapita->idcidade = $d->idcidades;
						$percapita->cidade = $d->descricao;
						$percapita->populacao = $d->populacao;
						$stmclubes->bindParam(':codigo_cidade', $percapita->idcidade, PDO::PARAM_INT);
						$stmclubes->execute();
						$percapita->clubes = $stmclubes->rowCount();
						$percapita->associados = 0;
						$clubes = $stmclubes->fetchAll(PDO::FETCH_OBJ);
						foreach ($clubes as $c) {
							$stmassociados->bindParam(':clubes_idclubes', $c->idclubes, PDO::PARAM_INT);
							$stmassociados->execute();
							$ass = $stmassociados->fetch(PDO::FETCH_OBJ);
							$percapita->associados = $percapita->associados + $ass->socios;
						}
						$percapita->percapita = intval($percapita->populacao / $percapita->associados);

						array_push($arrDados, $percapita);
					}
					$percapitaTotal = 0;
					$quantidadeCidades = 0;
					foreach ($arrDados as $perc) {
						$percapitaTotal = $percapitaTotal + $perc->percapita;
						$quantidadeCidades = $quantidadeCidades + 1;
					}
					$percapitaMedia = intval($percapitaTotal / $quantidadeCidades);
					foreach ($arrDados as $a) {
						if ($tipo == 0) {
							if ($a->percapita >= $percapitaMedia) {
								$a->media = $percapitaMedia;
								array_push($arrPercapitas, $a);
							}
						} else {
							if ($a->percapita < $percapitaMedia) {
								$a->media = $percapitaMedia;
								array_push($arrPercapitas, $a);
							}
						}
					}
					return json_encode($arrPercapitas, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
				} catch (PDOException $e) {
					return json_encode("Erro ao buscar percapita: ". $e->getMessage());
				}
			} else {
				return json_encode("Vazio");
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