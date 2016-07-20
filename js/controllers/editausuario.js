rotary.controller('editausuarioController', function ($scope, distritosService, $routeParams, usuarioService, $location) {
	$scope.selecionadistritos = [];
	$scope.usuario = {};
	$scope.usuario.distritos = [];
	$scope.titulo = "Editando Usuário";

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
		if (!$scope.usuario.idusuario) {
			usuarioService.userexists($scope.usuario.usuario).then(function (data) {
				$scope.usuariovalido = data.data;
			}, function (err) {
				console.log(err.data);
			});
		}
	};

	$scope.getUsuario = function (usuarioid) {
		usuarioService.getDadosUser(usuarioid).then(function (data) {
			$scope.usuario = data.data;
			if ($scope.usuario.admin == 1) {
				$scope.usuario.admin = true;
			} else {
				$scope.usuario.admin = false;
			}
		}, function (err) {
			console.log(err.data);
		})
	};

	$scope.getDistritoUsuario = function (usuarioid) {
		usuarioService.getDistritosUser(usuarioid).then(function (data) {
			$scope.usuario.distritos = data.data;
		}, function (err) {
			console.log(err.data);
		})
	};

	$scope.deletaDistrito = function (distritoid) {
		$scope.usuario.distritos = $scope.usuario.distritos.filter(function (distrito) {
			return distrito.iddistritos != distritoid;
		})
	};

	$scope.getUsuario($routeParams.idusuario);
	$scope.getDistritos();
	$scope.getDistritoUsuario($routeParams.idusuario);
})