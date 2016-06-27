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

	var _insertOrUpdate = function (dados) {
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
	};

	var _deleteDistrito = function (codigoDistrito) {
		return $http({
			method : "post",
			url    : "api/index.php/distrito/delete",
			data   : codigoDistrito
		});
	};

	return {
		getDistritos : _getDistritos,
		getDistrito  : _getDistrito,
		getCidadesDistrito : _getCidadesDistrito,
		insertOrUpdate : _insertOrUpdate,
		deleteDistrito : _deleteDistrito
		// insertOrUpdateCidades : _insertOrUpdateCidades
	};
});