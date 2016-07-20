rotary.controller('clubesController', function ($scope, clubesService, distritosService) {
	$scope.clubes = [];
	$scope.distritos = [];
	$scope.cidades = [];
	$scope.socios = [];
	$scope.titulo = "Cadastro de Clubes";

	$scope.getSociosClube = function (clube) {
		if (clube.socios && clube.socios.length > 0) {
			clube.socios = [];
		} else {
			clubesService.getSociosClube(clube.idclubes).then(function (data) {
				clube.socios = data.data;
			}, function (err) {
				console.log(err.data);
			})
		}
	};

	$scope.getClubes = function () {
		clubesService.getClubes().then(function (data) {
			if (data.data.length > 0) {
				$scope.clubes = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.getClubesDistrito = function (codigoDistrito) {
		$scope.clubes = [];
		clubesService.getClubesDistrito(codigoDistrito).then(function (data) {
			if (data.data.length > 0) {
				$scope.clubes = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.getClubesCidade = function (codigoCidade) {
		clubesService.getClubesCidade(codigoCidade).then(function (data) {
			if (data.data.length > 0) {
				$scope.clubes = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

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

	$scope.deleteClube = function (codigoClube) {
		clubesService.deleteClube(codigoClube).then(function (data) {
			$scope.retorno = data.data;
			if ($scope.retorno.retorno) {
				$scope.getClubes();
			} else {
				console.log(data.retorno.mensagem);
			}
		})
	};

	$scope.sort = function (nameCol) {
		if ($scope.nameCol == nameCol) {
			$scope.sortKey = $scope.nameCol;

			$scope.nameCol = 'sem ordenação';
			$scope.reverse = true;
		} else {
			$scope.nameCol = nameCol;
			$scope.sortKey = $scope.nameCol;
			$scope.reverse = false;
		}
	};

	$scope.getDistritos();
	// $scope.getClubes();
});