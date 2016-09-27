rotary.controller('clubesSociosController', function ($scope, clubesService, distritosService, $localStorage) {
	$scope.clubes = [];
	$scope.distritos = [];
	$scope.cidades = [];

	$scope.getClubesDistrito = function () {
		if (!$scope.dt) {
			alert('Informe a data');
		} else {
			clubesService.getClubesDistrito($localStorage.dqadistrito.iddistritos).then(function (data) {
				if (data.data.length > 0) {
					$scope.clubes = data.data;
					$scope.getSociosDataDistrito($localStorage.dqadistrito.iddistritos);
				}
			}, function (err) {
				$scope.erro = err.data;
			});
		};
	};

	$scope.getSociosDataDistrito = function () {
		clubesService.getSociosDataDistrito($scope.dt, $localStorage.dqadistrito.iddistritos).then(function (data) {
			if (data.data.length > 0) {
				$scope.clubessocios = data.data;
				$scope.clubessocios.forEach(function (clubesocio) {
					$scope.clubes.forEach(function (clube) {
						if (clubesocio.clubes_idclubes == clube.idclubes) {
							clube.associados = clubesocio.socios;
						};
					});
				});
			};
		});
	};


	$scope.salvarClubesSocios = function () {
		$scope.dados = {};
		$scope.dados.data = $scope.dt;

		$scope.dados.clubes = $scope.clubes.filter(function (clube) {
			return clube.associados && clube.associados >= 0;
		});
		console.log($scope.dados);

		clubesService.insertOrUpdateClubesSocios($scope.dados).then(function (data) {
			$scope.retorno = data.data;
			if ($scope.retorno.retorno) {
				window.location.href = "#/clubes";
			} else {
				console.log($scope.retorno.mensagem);
			}
		}, function (err) {
			console.log(err);
		});
	};

	$scope.open1 = function() {
    	$scope.popup1.opened = true;
	};

	$scope.popup1 = {
    	opened: false
	};

	$scope.formats = ['dd-MMMM-yyyy', 'dd/MM/yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
 	$scope.format = $scope.formats[1];


	$scope.getClubesCidade = function (codigoCidade) {
		clubesService.getClubesCidade(codigoCidade).then(function (data) {
			if (data.data.length > 0) {
				$scope.clubes = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.getCidadesDistrito = function () {
		distritosService.getCidadesDistrito($localStorage.dqadistrito.iddistritos).then(function (data) {
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
});