labcasp.factory("usuarioService", function ($http) {
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