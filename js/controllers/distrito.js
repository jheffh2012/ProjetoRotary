rotary.controller('distritosController', function ($scope, distritosService) {
	$scope.distritos = [];
	$scope.titulo = "Cadastro de Distritos";

	$scope.getDistritos = function () {
		distritosService.getDistritos().then(function (data) {
			$scope.distritos = data.data;
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.deleteDistrito = function (idDistrito) {
		distritosService.deleteDistrito(idDistrito).then(function (data) {
			$scope.retorno = data.data;
			if (!$scope.retorno.retorno) {
				$scope.erro = $scope.retorno.mensagem;
			} else {
				$scope.getDistritos();
			}
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

	$scope.getDistritos();
})