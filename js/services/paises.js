rotary.factory("paisesService", function ($http) {
	//retorno publico
	var _getPaises = function() {
		return $http({
			method : "get",
			url    : "api/index.php/pais/"
		});
	}

	return {
		getPaises : _getPaises
	};
});