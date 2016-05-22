rotary.factory("cidadesService", function ($http) {
	//retorno publico
	var _getCidades = function() {
		return $http({
			method : "get",
			url    : "api/index.php/cidade/"
		});
	};

	var _getCidadesEstado = function(data) {
		return $http({
			method : "post",
			url    : "api/index.php/cidade/",
			data   : data
		})
	};

	var _getCidade = function (codigocidade) {
		return $http({
			method : "get",
			url    : "api/index.php/cidade/"+codigocidade
		})
	};

	return {
		getCidades : _getCidades,
		getCidadesEstado : _getCidadesEstado,
		getCidade : _getCidade
	};
});