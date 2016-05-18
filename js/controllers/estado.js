rotary.controller('estadosController', function ($scope, estadosService, paisesService) {
	$scope.paises = [];
	$scope.estados = [];

	$scope.carregarPaises = function () {
		paisesService.getPaisesAtivos().then(function (data) {
			$scope.paises = data.data;
		}, function (err) {
			$scope.erro = err.data;
		})
	};

	$scope.carregarEstados = function (codigopais) {
		estadosService.getEstadosPais(codigopais).then(function (data) {
			$scope.estados = data.data;
		}, function (err) {
			$scope.erro = err.data;
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

	$scope.carregarPaises();
})