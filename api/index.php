<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Firebase\JWT\JWT;

require_once("vendor/autoload.php");
require_once("class/cidade.php");
require_once("class/estado.php");
require_once("class/pais.php");
require_once("class/distrito.php");
require_once("class/clube.php");
require_once("class/usuario.php");

header("Content-Type: text/html; charset=utf-8",true);

$app = new Silex\Application();

$app['debug'] = true;

$app->before(function(Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : []);
    }
});

$app->after(function (Request $request, Response $response) {
	if (!strpos($request->getUri(), 'login')) {
		$token = $request->headers->get('tokenRotary');
		$user = new Usuario;
		try {
			$retorno = $user->getUser($token);
			if ($retorno->retorno) {
				$novotoken = $user->newToken($token);
				if (isset($novotoken)) {
					$response->headers->set('tokenRotary', $novotoken);
				}
			} else {
				return new Response($retorno->mensagem, 401);
			}
		} catch (Exception $e) {
			
		}
	}
	
 });

$cidade   = $app['controllers_factory'];
$estado   = $app['controllers_factory'];
$pais     = $app['controllers_factory'];
$distrito = $app['controllers_factory'];
$clube    = $app['controllers_factory'];
$usuario  = $app['controllers_factory'];
$relatorios = $app['controllers_factory'];

$pais->get('/', function () {
	$p = new Pais;
	try {
		$lista = $p->getPaises();
		return $lista;
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$pais->get('/ativos', function () {
	$p = new Pais;
	try {
		$lista = $p->getPaisesAtivos();
		return $lista;
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$estado->get('/', function () {
	$e = new Estado;
	try {
		return $lista = $e->getEstados();
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$estado->get('/{idestado}', function ($idestado) {
	$e = new Estado;
	try {
		return $lista = $e->getEstado($idestado);
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$estado->post('/', function (Request $request) {
	$idpais = json_decode($request->getContent());

	if (isset($idpais)) {
		$e = new Estado;
		try {
			$lista = $e->getEstadosPais($idpais);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$cidade->get('/', function () {
	$c = new Cidade;
	try {
		return $lista = $c->getCidades();
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$cidade->post('/', function (Request $request) {
	$uf = json_decode($request->getContent());
	if (isset($uf)) {
		$c = new Cidade;
		try {
			$lista = $c->getCidadesEstado($uf);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$cidade->get('/{idcidade}', function ($idcidade) {
	$c = new Cidade;
	try {
		$lista = $c->getCidade($idcidade);
		return $lista;
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$cidade->put('/', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$c = new Cidade;
		try {
			$lista = $c->insertOrUpdate($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$cidade->post('/delete', function (Request $request) {
	$dados = $request->getContent();
	if (isset($dados)) {
		$c = new Cidade;
		try {
			$lista = $c->deleteCidade($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$cidade->put('/atualizapopulacao', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$c = new Cidade;
		try {
			$lista = $c->atualizaPopulacao($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$distrito->get('/', function (Request $request) {
	$token = $request->headers->get('tokenRotary');
	if ($token) {
		$u = new Usuario;
		try {
			$userId = $u->getUserId($token);
		} catch (Exception $e) {
			return json_encode("Erro ao buscar usuario! Erro:" . $e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
		if ($userId >= 0) {
			$d = new Distrito;
			try {
				$lista = $d->getDistritos($userId);
				return $lista;
			} catch (Exception $e) {
				return json_encode("Erro ao buscar distritos! Erro:" . $e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}
	}
});

$distrito->get('/{id}', function ($id) {
	$d = new Distrito;
	try {
		$lista = $d->getDistrito($id);
		return $lista;
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$distrito->get('/{id}/cidades', function ($id) {
	if (isset($id)) {
		$d = new Distrito;
		try {
			$lista = $d->getCidadesDistrito($id);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$distrito->put('/', function (Request $request){
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$d = new Distrito;
		try {
			$lista = $d->insertOrUpdate($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$distrito->put('/{id}/cidades', function ($id) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$d = new Distrito;
		try {
			$lista = $d->insertOrUpdateCidades($id, $dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$distrito->post('/delete', function (Request $request) {
	$dados = json_decode($request->getContent());
	$token = $request->headers->get('tokenRotary');
	if (isset($token)) {
		$user = new Usuario;
		try {
			$retorno = $user->getUser($token);
			if ($retorno->retorno) {
				if (isset($dados)) {
					$d = new Distrito;
					try {
						$lista = $d->deleteDistrito($dados);
						return $lista;
					} catch (Exception $e) {
						return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
					}
				}
			} else {
				return new Response($retorno->mensagem, 401);
			}
		} catch (Exception $e) {
			
		}
	}
});

$clube->get('/', function (Request $request) {
	$token = $request->headers->get('tokenRotary');
	if (isset($token)) {
		$u = new Usuario;
		try {
			$userId = $u->getUserId($token);
		} catch (Exception $e) {
			return json_encode("Erro ao buscar usuario! Erro:" . $e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
		if (isset($userId)) {
			$c = new Clube;
			try {
				$lista = $c->getClubes($userId);
				return $lista;
			} catch (Exception $e) {
				return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
			}
		}
	}
});

$clube->get('/{id}', function ($id) {
	$c = new Clube;
	try {
		$lista = $c->getClube($id);
		return $lista;
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$clube->get('/{id}/socios', function ($id) {
	$c = new Clube;
	try {
		$lista = $c->getSociosClube($id);
		return $lista;
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
	}
});

$clube->post('/deletesocios', function (Request $request) {
	$clubesocios = $request->getContent();
	if ($clubesocios) {
		$c = new Clube;
		try {
			$lista = $c->deleteSociosClube($clubesocios);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$clube->post('/distrito', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$c = new Clube;
		try {
			$lista = $c->getClubesDistrito($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$clube->post('/cidade', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$c = new Clube;
		try {
			$lista = $c->getClubesCidade($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$clube->put('/', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$c = new Clube;
		try {
			$lista = $c->insertOrUpdate($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$clube->post('/delete', function (Request $request) {
	$dados = json_decode($request->getContent());
	$token = $request->headers->get('tokenRotary');
	if (isset($token)) {
		$user = new Usuario;
		try {
			$retorno = $user->getUser($token);
			if ($retorno->retorno) {
				if (isset($dados)) {
					$c = new Clube;
					try {
						$lista = $c->deleteClube($dados);
						return $lista;
					} catch (Exception $e) {
						return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
					}
				}
			} else {
				return new Response($retorno->mensagem, 401);
			}
		} catch (Exception $e) {
			
		}
	}
});

$clube->post('/socios', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$c = new Clube;
		try {
			$lista = $c->insertClubesSocios($dados->data, $dados->clubes);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$clube->post('/datasocios', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$c = new Clube;
		try {
			$lista = $c->getSociosDataDistrito($dados->data, $dados->distrito);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$usuario->get('/', function (Request $request) {
	$token = $request->headers->get("tokenRotary");
	if (isset($token)) {
		$u = new Usuario;
		try {
			$userId = $u->getUserId($token);
			$dados = $u->getUsuarios($userId);
			return $dados;
		} catch (Exception $e) {
			
		}
	}
});

$usuario->post('/userexists', function (Request $request) {
	$username = $request->getContent();
	if (isset($username)) {
		$u = New Usuario;
		try {
			$retorno = $u->userExists($username);
			return $retorno;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	} else {
		return json_encode("Usuario não informado!");
	}
});

$usuario->post('/login', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$u = new Usuario;
		try {
			$retorno = $u->Login($dados->usuario, $dados->senha);
			return $retorno;
		} catch (Exception $e) {
			return json_encode("Erro ao efetuar Login! ".$e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$usuario->post('/token', function (Request $request) {
	$token = $request->headers->get('tokenRotary');
	// $token = json_decode($request->headers->get("token"));
	$user = new Usuario;
	try {
		$retorno = $user->getUser($token);
		if ($retorno->retorno) {
			return new Response($retorno->mensagem, 200);
		} else {
			return new Response($retorno->mensagem, 401);
		}
		return $retorno;
	} catch (Exception $e) {
		return json_encode("Erro ao buscar dados do Token! Erro: ". $e->getMessage());
	}
});

$usuario->post('/insert', function (Request $request) {
	$dados = json_decode($request->getContent());
	$u = new Usuario;
	try {
		$retorno = $u->insertOrUpdate($dados);
		return json_encode($retorno);
	} catch (Exception $e) {
		return json_encode("Erro ao inserir dados do usuario! Erro: " . $e->getMessage());
	}
});

$usuario->get('/{userId}', function ($userId) {
	$u = new Usuario;
	try {
		$retorno = $u->getDadosUser($userId);
		return $retorno;
	} catch (Exception $e) {
		return json_encode("Erro ao inserir dados do usuario! Erro: " . $e->getMessage());
	}
});

$usuario->get('/{userId}/distritos', function ($userId) {
	$u = new Usuario;
	try {
		$retorno = $u->getDistritosUser($userId);
		return $retorno;
	} catch (Exception $e) {
		return json_encode("Erro ao inserir dados do usuario! Erro: " . $e->getMessage());
	}
});

$relatorios->post('/percapita', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$d = new Distrito;
		try {
			$lista = $d->getPercapta($dados, 1);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(). JSON_UNESCAPED_UNICODE);
		}
	} else {
		return json_encode("Vazio");
	}
});

$relatorios->post('/melhorarpercapita', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$d = new Distrito;
		try {
			$lista = $d->getPercapta($dados, 0);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(). JSON_UNESCAPED_UNICODE);
		}
	} else {
		return json_encode("Vazio");
	}
});

$relatorios->post('/maioresclubes', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$d = new Distrito;
		try {
			$lista = $d->getTamanhoClubes($dados, 0);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(). JSON_UNESCAPED_UNICODE);
		}
	}
});

$relatorios->post('/menoresclubes', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$d = new Distrito;
		try {
			$lista = $d->getTamanhoClubes($dados, 1);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(). JSON_UNESCAPED_UNICODE);
		}
	}
});

$relatorios->post('/cidadesemrotary', function (Request $request) {
	$dados = $request->getContent();
	if (isset($dados)) {
		$d = new Distrito;
		try {
			$lista = $d->getCidadesSemRotaryDistrito($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(). JSON_UNESCAPED_UNICODE);
		}
	}
});

$app->mount('cidade', $cidade);
$app->mount('estado', $estado);
$app->mount('pais'  , $pais);
$app->mount('distrito', $distrito);
$app->mount('clube', $clube);
$app->mount('usuario', $usuario);
$app->mount('relatorios', $relatorios);

$app->run();