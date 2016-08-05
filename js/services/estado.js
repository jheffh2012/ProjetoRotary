rotary.factory("estadosService", function ($http) {
	//retorno publico
	var _getEstados = function() {
		return $http({
			method : "get",
			url    : "api/index.php/estado/"
		});
	};

	var _getEstado = function (estado) {
		return $http({
			method : "get",
			url    : "api/index.php/estado/" + estado
		})
	}

	var _getEstadosPais = function (data) {
		return $http({
			method : "post",
			url    : "api/index.php/estado/",
			data   : data
		});
	};

	return {
		getEstado : _getEstado,
		getEstados : _getEstados,
		getEstadosPais : _getEstadosPais
	};
});