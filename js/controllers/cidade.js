rotary.controller('cidadesController', function ($scope, cidadesService, estadosService, paisesService) {
	$scope.cidades = [];
	$scope.paises = [];
	$scope.estados = [];

	$scope.getCidades = function (codigoestado) {
		cidadesService.getCidadesEstado(codigoestado).then(function (data) {
			$scope.cidades = data.data;
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.carregarPaises = function () {
		paisesService.getPaisesAtivos().then(function (data) {
			$scope.filtrarPais = true;
			$scope.paises = data.data;
		}, function (err) {
			$scope.passos = 0;
			$scope.erro = err.data;
		})
	}

	$scope.carregarEstados = function (codigopais) {
		estadosService.getEstadosPais(codigopais).then(function (data) {
			$scope.estados = data.data;
		}, function (err) {
			$scope.erro = err.data;
		})
	}

	$scope.sort = function (nameCol) {
		if ($scope.nameCol == nameCol) {
			$scope.sortKey = $scope.nameCol;

			$scope.nameCol = 'sem ordenação';
			$scope.reverse = true;
		} else {
			$scope.nameCol = nameCol;
			$scope.sortKey = $scope.nameCol;
			reverse = false;
		}
	}

	$scope.carregarPaises();
//	$scope.getCidades();
})