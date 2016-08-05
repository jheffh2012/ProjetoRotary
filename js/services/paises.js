rotary.factory("paisesService", function ($http) {
	//retorno publico
	var _getPaises = function() {
		return $http({
			method : "get",
			url    : "api/index.php/pais/"
		});
	};

	var _getPaisesAtivos = function () {
		return $http({
			method : "get",
			url    : "api/index.php/pais/ativos"
		});
	};

	var _getPais = function (codigopais) {
		return $http({
			method : "get",
			url    : "api/index.php/pais/".codigopais 
		});
	};

	return {
		getPais : _getPais,
		getPaises : _getPaises,
		getPaisesAtivos : _getPaisesAtivos
	};
});