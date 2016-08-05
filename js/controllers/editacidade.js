rotary.controller('editacidadeController', function ($scope, $routeParams, paisesService, estadosService, cidadesService) {
	$scope.cidade = {};
	$scope.paises = '';
	$scope.estados = '';
	$scope.titulo = "Editando Cidade";

	$scope.getPaises = function () {
		paisesService.getPaisesAtivos().then(function (data) {
			$scope.paises = data.data;
		}, function (err) {
			$scope.erro = err.data;
		})
	};

	$scope.getEstados = function () {
		estadosService.getEstados().then(function (data) {
			$scope.estados = data.data;
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.getCidade = function(codigocidade) {
		cidadesService.getCidade(codigocidade).then(function (data) {
			$scope.cidade = data.data;
			if ($scope.cidade.estados_idestados) {
				estadosService.getEstado($scope.cidade.estados_idestados).then(function (data2) {
					$scope.cidade.estado = data2.data;
				}, function (err) {
					console.log(err.data);
				})
			};
		}, function (err) {
			console.log(err.data);
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
	$scope.getCidade($routeParams.idcidade);

})