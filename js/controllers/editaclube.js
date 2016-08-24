rotary.controller('editaclubeController', function ($scope, $routeParams, clubesService,cidadesService, distritosService) {
	$scope.clube = {};
	$scope.distritos = [];
	$scope.cidades = [];
	$scope.titulo = "Editando Clube";
	$scope.sociosclube = [];

	$scope.getDistritos = function () {
		distritosService.getDistritos().then(function (data) {
			if (data.data.length > 0) {
				$scope.distritos = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.getSociosClube = function (clube) {
		clubesService.getSociosClube(clube).then(function (data) {
			if (data.data.length > 0) {
				$scope.sociosclube = data.data;
			}
		}, function (err) {
			console.log(err.data);
		});
	};
	$scope.deleteSociosClube = function (clube) {
		clubesService.deleteSociosClube(clube).then(function (data) {
			if (data.data.retorno) {
				$scope.getSociosClube($scope.clube.idclubes);
			} else {
				console.log(data.data.mensagem);
			}
		}, function (err) {
			console.log(err.data);
		});
	};

	$scope.getCidadesDistrito = function (codigoDistrito) {
		distritosService.getCidadesDistrito(codigoDistrito).then(function (data) {
			if (data.data.length > 0) {
				$scope.cidades = data.data;
				$scope.cidades.forEach(function (cidade) {
					cidade.descricao = cidade.descricao + ', ' + cidade.sigla;
				});
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.salvarClube = function () {
		clubesService.insertOrUpdate($scope.clube).then(function (data) {
			$scope.retorno = data.data;
			if ($scope.retorno.retorno) {
				window.location.href = "#/clubes";
			} else {
				console.log($scope.retorno.mensagem);
			}
		}, function (err) {
			console.log(err.data);
		})
	};

	$scope.getClube = function (codigoclube) {
		clubesService.getClube(codigoclube).then(function (data) {
			if (data.data.idclubes) {
				$scope.clube = data.data;
				distritosService.getDistrito($scope.clube.distritos_iddistritos).then(function (data) {
					if (data.data.iddistritos) {
						$scope.clube.distrito = data.data;
					}
				}, function (err) {
					console.log(err.data);
				});
				cidadesService.getCidade($scope.clube.codigo_cidade).then(function (data) {
					if (data.data.idcidades) {
						$scope.clube.cidade = data.data;
					}
				}, function (err) {
					console.log(err.data);
				})
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
	$scope.getClube($routeParams.idclube);
	$scope.getSociosClube($routeParams.idclube);
})