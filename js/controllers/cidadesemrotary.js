rotary.controller('cidadesemrotaryController', function ($scope, relatorioService, distritosService, $localStorage) {
	$scope.titulo = 'Cidades Sem Rotary';

	$scope.getCidadesSemRotary = function () {
		relatorioService.getCidadesSemRotary($localStorage.dqadistrito.iddistritos).then(function (data) {
			$scope.cidades = data.data;
			$scope.cidades.sort(function (a, b) {
				if (a.populacao > b.populacao) {
					return -1;
				}
				if (a.populacao < b.populacao) {
					return 1;
				}
				if (a.populacao == b.populacao) {
					return 0;
				}
			})
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
});