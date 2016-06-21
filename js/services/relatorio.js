rotary.factory("relatorioService", function ($http) {
	//retorno publico
	var _getPercapita = function (distrito) {
		return $http({
			method : "post",
			url    : "api/index.php/relatorios/percapita",
			data   : distrito
		});
	};

	var _getMelhorarPercapita = function (distrito) {
		return $http({
			method : "post",
			url    : "api/index.php/relatorios/melhorarpercapita",
			data   : distrito
		});
	};

	var _getMaioresClubes = function (distrito) {
		return $http({
			method : "post",
			url    : "api/index.php/relatorios/maioresclubes",
			data   : distrito
		});
	};

	var _getMenoresClubes = function (distrito) {
		return $http({
			method : "post",
			url    : "api/index.php/relatorios/menoresclubes",
			data   : distrito
		});
	};

	return {
		getPercapita : _getPercapita,
		getMelhorarPercapita : _getMelhorarPercapita,
		getMaioresclubes : _getMaioresClubes,
		getMenoresclubes : _getMenoresClubes
	};
});