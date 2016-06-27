rotary.controller('cidadesemrotaryController', function ($scope, relatorioService, distritosService) {
	$scope.titulo = 'Cidades Sem Rotary';

	$scope.getDistritos = function (idDistrito) {
		distritosService.getDistritos(idDistrito).then(function (data) {
			$scope.distritos = data.data;
		}, function (err) {
			console.log(err.data);
		})
	};

	$scope.getCidadesSemRotary = function (distrito) {
		relatorioService.getCidadesSemRotary(distrito).then(function (data) {
			$scope.cidades = data.data;
		}, function (err) {
			console.log(err.data);
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
			$scope.reverse = false;
		}
	};

	$scope.getDistritos();
});