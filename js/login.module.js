var login = angular.module('login', ["ui.bootstrap", "ngStorage"]);

login.factory("usuarioService", function ($http) {
	var _login = function (dados){
		return $http({
			method : "post",
			url : "api/index.php/usuario/login",
			data : dados
		});
	};

	var _userexists = function (usuario) {
		return $http({
			method : "post",
			url    : "api/index.php/usuario/userexists",
			data   : usuario
		});
	};

	//retorno publico
	return ({
		login : _login,
		userexists : _userexists 
	});

});

login.controller('loginController', function ($scope, usuarioService, $localStorage) {
	$scope.u = {};

	$scope.logar = function () {
		$localStorage.token = "";
		usuarioService.login($scope.u).then(function (data) {
			retorno = data.data;
			if (retorno.logado) {
				$localStorage.dqatoken = data.data.token;
				$localStorage.dqausername = data.data.usuario;
				window.location.href = "http://localhost/projetoRotary/index.php";
			} else {
				$scope.erroLogin = "Usuário e Senha informados inválidos!";
			}
		}, function (err) {
			console.log(err.data);
		})
	}
	
})
