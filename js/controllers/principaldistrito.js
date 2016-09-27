rotary.controller('principalDistritoController', function ($scope, distritosService, $localStorage) {
	$scope.usuarioLogado = $localStorage.dqausername;
	$scope.distrito = '';
	$scope.distritos = [];

	$scope.getDistritos = function () {
		$scope.selecionar = true;
		distritosService.getDistritos().then(function (data) {
			if (data.data.length > 0) {
				$scope.distritos = data.data;
			}
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.onSelect = function (item, model, label, event) {
		$localStorage.dqadistrito = item;
	};

	$scope.onShow = function () {
		if ($localStorage.dqadistrito) {
			$scope.distrito = $localStorage.dqadistrito;
			$scope.selecionar = true;
		};
	};

	$scope.getDistritos();
	$scope.onShow();
})