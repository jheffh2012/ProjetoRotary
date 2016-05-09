<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once 'api/vendor/autoload.php';
require_once 'api/class/cidade.php';
require_once 'api/class/estado.php';
require_once 'api/class/pais.php';

header("Content-Type: text/html; charset=utf-8",true);

$app = new Silex\Application();

$app['debug'] = true;

$app->before(function(Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : []);
    }
});

$cidade = $app['controllers_factory'];
$estado = $app['controllers_factory'];
$pais   = $app['controllers_factory'];

$pais->get('/', function () {
	$p = new Pais;
	try {
		$lista = $p->getPaises();
		return $lista;
	} catch (Exception $e) {
		return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
	}
});

$estado->post('/', function (Request $request) {
	$idpais = json_decode($request->getContent());

	if (isset($idpais)) {
		$e = new Estado;
		try {
			$lista = $e->getEstados($idpais);
			return $lista;
		} catch (Exception $e) {
			return json_encode(json_encode($e->getMessage(), JSON_UNESCAPED_UNICODE));
		}
	}
});

$cidade->post('/', function (Request $request) {
	$uf = json_decode($request->getContent());
	if (isset($uf)) {
		$c = new Cidade;
		try {
			$lista = $c->getCidades($uf);
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

$app->mount('cidade', $cidade);
$app->mount('estado', $estado);
$app->mount('pais'  , $pais);

$app->run();