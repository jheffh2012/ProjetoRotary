rotary.controller('novousuarioController', function ($scope, distritosService, usuarioService, $location) {
	$scope.selecionadistritos = [];
	$scope.usuario = {};
	$scope.usuario.distritos = [];

	$scope.getDistritos = function () {
		distritosService.getDistritos().then(function (data) {
			$scope.selecionadistritos = data.data;
		}, function (err) {
			console.log(err.data);
		});
	};

	$scope.adicionaDistrito = function(distrito) {
		$scope.usuario.distritos.push(distrito);
		$scope.distrito = "";
	};

	$scope.salvarUsuario = function () {
		if ($scope.usuario.usuario || $scope.usuariovalido.retorno) {
			usuarioService.insertOrUpdate($scope.usuario).then(function (data) {
				$scope.retorno = data.data;
				if ($scope.retorno.retorno) {
					$location.path('/usuarios');
				} else {
					console.log($scope.retorno.mensagem);
				}
			}, function (err) {
				console.log(err.data);
			});
		}
	};

	$scope.userExists = function () {
		usuarioService.userexists($scope.usuario.usuario).then(function (data) {
			$scope.usuariovalido = data.data;
		}, function (err) {
			console.log(err.data);
		});
	};

	$scope.deletaDistrito = function (distritoid) {
		$scope.usuario.distritos = $scope.usuario.distritos.filter(function (distrito) {
			return distrito.iddistritos != distritoid;
		})
	};

	$scope.getDistritos();
})