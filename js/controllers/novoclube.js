rotary.controller('novoclubeController', function ($scope, clubesService, distritosService) {
	$scope.clube = {};
	$scope.distritos = [];
	$scope.cidades = [];

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
				window.location = "http://localhost/projetoRotary/index.php#/clubes";
			} else {
				console.log($scope.retorno.mensagem);
			}
		}, function (err) {
			console.log(err.data);
		})
	};

	$scope.getDistritos();
})