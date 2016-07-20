rotary.controller('usuariosController', function ($scope, usuarioService, $location) {
	$scope.usuarios = [];
	$scope.titulo = "Cadastro de Usuários";

	$scope.getUsuarios = function () {
		usuarioService.getUsers().then(function (data) {
			$scope.usuarios = data.data;
		}, function (erro) {
			console.log(erro.data);
		});
	};

	$scope.insertUsuario = function () {
		$location.path("/novousuario");
	};

	$scope.editaUsuario = function (usuarioid) {
		$location.path("/editausuario/" + usuarioid);
	};

	$scope.deleteUsuario = function () {

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

	$scope.getUsuarios();
})