rotary.controller('novodistritoController', function ($scope, cidadesService, estadosService, paisesService, distritosService) {
	$scope.distrito = {};
	$scope.distrito.cidades = [];
	$scope.paises = [];
	$scope.estados = [];
	$scope.cidades = [];

	$scope.getPaisesAtivos = function () {
		paisesService.getPaisesAtivos().then(function (data) {
			$scope.paises = data.data;
			if ($scope.paises.length == 1) {
				$scope.paises.forEach(function (p) {
					$scope.pais = p;
				})
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.getEstados = function (codigopais) {
		estadosService.getEstadosPais(codigopais).then(function (data) {
			$scope.estados = data.data;
		}, function (err) {
			$scope.erro = err.data;
		})
	};

	$scope.getCidades = function (codigoestado) {
		cidadesService.getCidadesEstado(codigoestado).then(function (data) {
			$scope.cidades = data.data;
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.incluirCidade = function (idCidade) {
		cidadesService.getCidade(idCidade).then(function (data) {
			if (data.data.idcidades) {
				$scope.distrito.cidades.push(data.data);
				$scope.filtroPaises = '';
				$scope.filtroEstados = '';
				$scope.filtroCidades = '';
			};
		}, function (err) {
			$scope.erro = err.data;
		})
	};

	$scope.incluirCidadesEstado = function (idEstado) {
		cidadesService.getCidadesEstado(idEstado).then(function (data) {
			if (data.data.length > 0) {
				data.data.forEach(function (cidade) {
					var cidadeexiste = $scope.distrito.cidades.filter(function (distritocidade) {
						return distritocidade.idcidades === cidade.idcidades;
					});
					if (cidadeexiste.length == 0) {
						$scope.distrito.cidades.push(cidade);
					}
				});
				$scope.filtroPaises = '';
				$scope.filtroEstados = '';
				$scope.filtroCidades = '';
			};
		}, function (err) {
			$scope.erro = err.data;
		})
	};

	$scope.deletarCidadeDistrito = function (idcidade) {
		$scope.distrito.cidades = $scope.distrito.cidades.filter(function (cidade) {
			return cidade.idcidades != idcidade;
		})
	};

	$scope.salvarDistrito = function () {
		distritosService.insertOrUpdate($scope.distrito).then(function (data) {
			$scope.retorno = data.data;
			if ($scope.retorno.retorno) {
				window.location = "http://localhost/projetoRotary/index.php#/distritos";
			} else {
				console.log($scope.retorno.mensagem);
			}
		}, function (err) {
			console.log(err.data);
		});
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

	$scope.getPaisesAtivos();
})