<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Firebase\JWT\JWT;

require_once 'vendor/autoload.php';
require_once 'class/cidade.php';
require_once 'class/estado.php';
require_once 'class/pais.php';
require_once 'class/distrito.php';
require_once 'class/clube.php';
require_once 'class/usuario.php';

header("Content-Type: text/html; charset=utf-8",true);

$app = new Silex\Application();

$app['debug'] = true;

$app->before(function(Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : []);
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
		return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
	}
});

$pais->get('/ativos', function () {
	$p = new Pais;
	try {
		$lista = $p->getPaisesAtivos();
		return $lista;
	} catch (Exception $e) {
		return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
	}
});

$estado->get('/', function () {
	$e = new Estado;
	try {
		return $lista = $e->getEstados();
	} catch (Exception $e) {
		return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
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
			return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
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
			return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
		}
	}
});

$cidade->get('/{idcidade}', function ($idcidade) {
	$c = new Cidade;
	try {
		$lista = $c->getCidade($idcidade);
		return $lista;
	} catch (Exception $e) {
		return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
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
			return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
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
			return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
		}
	}
});

$distrito->get('/', function () {
	$d = new Distrito;
	try {
		$lista = $d->getDistritos();
		return $lista;
	} catch (Exception $e) {
		return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
	}
});

$distrito->get('/{id}', function ($id) {
	$d = new Distrito;
	try {
		$lista = $d->getDistrito($id);
		return $lista;
	} catch (Exception $e) {
		return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
	}
});

$distrito->get('/{id}/cidades', function ($id) {
	if (isset($id)) {
		$d = new Distrito;
		try {
			$lista = $d->getCidadesDistrito($id);
			return $lista;
		} catch (Exception $e) {
			return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
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
			return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
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

$distrito->delete('/', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$d = new Distrito;
		try {
			$lista = $d->deleteDistrito($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
		}
	}
});

$clube->get('/', function () {
	$c = new Clube;
	try {
		$lista = $c->getClubes();
		return $lista;
	} catch (Exception $e) {
		return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
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

$clube->delete('/', function (Request $request) {
	$dados = json_decode($request->getContent());
	if (isset($dados)) {
		$c = new Clube;
		try {
			$lista = $c->deleteClube($dados);
			return $lista;
		} catch (Exception $e) {
			return json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE);
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

$usuario->get('/', function (Request $request) {
	$token = json_decode($request->getHeader());
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

$app->mount('cidade', $cidade);
$app->mount('estado', $estado);
$app->mount('pais'  , $pais);
$app->mount('distrito', $distrito);
$app->mount('clube', $clube);
$app->mount('usuario', $usuario);
$app->mount('relatorios', $relatorios);

$app->run();