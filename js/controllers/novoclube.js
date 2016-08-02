rotary.controller('novoclubeController', function ($scope, clubesService, distritosService) {
	$scope.clube = {};
	$scope.distritos = [];
	$scope.cidades = [];
	$scope.titulo = "Novo Clube";

	$scope.getDistritos = function () {
		distritosService.getDistritos().then(function (data) {
			if (data.data.length > 0) {
				$scope.distritos = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.getCidadesDistrito = function (codigoDistrito) {
		distritosService.getCidadesDistrito(codigoDistrito).then(function (data) {
			if (data.data.length > 0) {
				$scope.cidades = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.salvarClube = function () {
		clubesService.insertOrUpdate($scope.clube).then(function (data) {
			$scope.retorno = data.data;
			if ($scope.retorno.retorno) {
				$scope.clube.descricao = '';
				$scope.clube.cidade = '';
				$scope.formClube.$setPristine();
				document.getElementById("inputCidades").focus();
			} else {
				console.log($scope.retorno.mensagem);
			}
		}, function (err) {
			console.log(err.data);
		})
	};
	
	$scope.onSelect = function (item, model, label, event) {
		$scope.getCidadesDistrito(item.iddistritos);
	};

	$scope.onSelectClubesCidades = function (item, model, label, event) {
		console.log(item);
		clubesService.getClubesCidade(item.idcidades).then(function (data) {
			$scope.clubescidade = data.data;
		}, function (err) {
			console.log(err);
		});
	};

	$scope.getDistritos();
})