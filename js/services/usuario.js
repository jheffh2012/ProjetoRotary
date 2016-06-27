rotary.factory("usuarioService", function ($http) {
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

	var _getuser = function (token) {
		return $http({
			method : "post",
			url    : "api/index.php/usuario/token",
			data   : token
		});
	};

	var _getUsers = function () {
		return $http({
			method : "get",
			url    : "api/index.php/usuario/"
		})
	};

	var _insertOrUpdate = function (usuario) {
		return $http({
			method : "post",
			url    : "api/index.php/usuario/insert",
			data   : usuario
		})
	};

	var _getDadosUser = function (usuarioid) {
		return $http({
			mehod : "get",
			url   : "api/index.php/usuario/" + usuarioid
		});
	};

	var _getDistritosUser = function (usuarioid) {
		return $http({
			method : "get",
			url    : "api/index.php/usuario/" + usuarioid + "/distritos"
		});
	};

	//retorno publico
	return ({
		login : _login,
		userexists : _userexists,
		getuser : _getuser,
		getUsers : _getUsers,
		insertOrUpdate : _insertOrUpdate,
		getDadosUser : _getDadosUser,
		getDistritosUser : _getDistritosUser
	});

});