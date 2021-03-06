rotary.factory("clubesService", function ($http) {
	//retorno publico
	var _getClubes = function() {
		return $http({
			method : "get",
			url    : "api/index.php/clube/"
		});
	};

	var _getClube = function (codigoclube) {
		return $http({
			method : "get",
			url    : "api/index.php/clube/"+codigoclube
		})
	};

	var _getSociosClube = function (codigoclube) {
		return $http({
			method : "get",
			url    : "api/index.php/clube/" + codigoclube + "/socios" 
		})
	};

	var _deleteSociosClube = function (codigoclubesocios) {
		return $http({
			method : "post",
			url    : "api/index.php/clube/deletesocios",
			data   : codigoclubesocios
		});
	};

	var _getClubesDistrito = function (codigoDistrito) {
		return $http({
			method : "post",
			url    : "api/index.php/clube/distrito",
			data   : codigoDistrito
		});
	};

	var _getClubesCidade = function (codigoCidade) {
		return $http({
			method : "post",
			url    : "api/index.php/clube/cidade",
			data   : codigoCidade
		});
	};

	var _insertOrUpdate = function (dados) {
		return $http({
			method : "put",
			url    : "api/index.php/clube/",
			data   : dados
		});
	};

	var _deleteClube = function (codigoClube) {
		return $http({
			method : "post",
			url    : "api/index.php/clube/delete",
			data   : codigoClube
		});
	};

	var _insertOrUpdateClubesSocios = function (dados) {
		return $http({
			method : "post",
			url    : "api/index.php/clube/socios",
			data   : dados
		});
	};

	var _getSociosDataDistrito = function (data, distrito) {
		var dados = {};

		dados.data = data;
		dados.distrito = distrito;

		return $http({
			method : "post",
			url    : "api/index.php/clube/datasocios",
			data   : dados
		});
	};

	return {
		getClubes : _getClubes,
		getClube : _getClube,
		getSociosClube : _getSociosClube,
		getClubesDistrito : _getClubesDistrito,
		getClubesCidade : _getClubesCidade,
		insertOrUpdate : _insertOrUpdate,
		insertOrUpdateClubesSocios : _insertOrUpdateClubesSocios,
		deleteClube : _deleteClube,
		deleteSociosClube : _deleteSociosClube,
		getSociosDataDistrito : _getSociosDataDistrito
	};
});