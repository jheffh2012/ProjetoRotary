rotary.factory("distritosService", function ($http) {
	//retorno publico
	var _getDistritos = function() {
		return $http({
			method : "get",
			url    : "api/index.php/distrito/"
		});
	};

	var _getDistrito = function (codigoDistrito) {
		return $http({
			method : "get",
			url    : "api/index.php/distrito/"+ codigoDistrito
		});
	};

	var _getCidadesDistrito = function (codigoDistrito) {
		return $http({
			method : "get",
			url    : "api/index.php/distrito/"+ codigoDistrito + "/cidades"
		});
	};

	var _inserOrUpdate = function (dados) {
		return $http({
			method : "put",
			url    : "api/index.php/distrito/",
			data   : dados
		});
	};

	var _insertOrUpdateCidades = function (codigoDistrito, cidades) {
		return $http({
			method : "put",
			url    : "api/index.php/distrito/"+ codigoDistrito + "/cidades",
			data   : cidades
		});
	}

	return {
		getDistritos : _getDistritos,
		getDistrito  : _getDistrito,
		getCidadesDistrito : _getCidadesDistrito,
		insertOrUpdate : _inserOrUpdate,
		insertOrUpdateCidades : _insertOrUpdateCidades
	};
});