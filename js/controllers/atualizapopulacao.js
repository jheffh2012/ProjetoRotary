rotary.controller('atualizapopulacaoController', function ($scope, $location, cidadesService, distritosService, $localStorage) {
	$scope.cidades = [];
	$scope.distritos = [];
	$scope.titulo = "Atualizar População das Cidades";

	$scope.salvarDados = function () {
		cidadesService.atualizaPopulacao($scope.cidades).then(function (data) {
			$scope.retorno = data.data;
			if ($scope.retorno.retorno) {
				$location.path('cidades');
			} else {
				console.log($scope.retorno.mensagem);
			}
		}, function (err) {
			console.log(err.data);
		})
	}

	$scope.getCidades = function () {
		distritosService.getCidadesDistrito($localStorage.dqadistrito.iddistritos).then(function (data) {
			if (data.data.length > 0) {
				$scope.cidades = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
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
})