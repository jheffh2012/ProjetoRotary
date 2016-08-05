rotary.controller('novacidadeController', function ($scope, $routeParams, paisesService, estadosService, cidadesService) {
	$scope.cidade = {};
	$scope.paises = '';
	$scope.estados = '';
	$scope.titulo = "Nova Cidade";

	$scope.getEstados = function () {
		estadosService.getEstados().then(function (data) {
			$scope.estados = data.data;
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.salvarCidade = function () {
		cidadesService.salvarCidade($scope.cidade).then(function (data) {
			if (data.data.retorno) {
				window.location.href = "#/cidades";
			} else {
				console.log(data.data.mensagem);
			}
		}, function (err) {
			console.log(err.data);
		});
	};

	$scope.getEstados();
})