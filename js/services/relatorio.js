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

	var _getTodasPercapitas = function (distrito) {
		return $http({
			method : "post",
			url    : "api/index.php/relatorios/totalpercapita",
			data   : distrito
		});
	};

	var _getdezmaiorescidades = function (distrito) {
		return $http({
			method : "post",
			url    : "api/index.php/relatorios/maiorescidades",
			data   : distrito
		});
	};

	var _getdezmenorescidades = function (distrito) {
		return $http({
			method : "post",
			url    : "api/index.php/relatorios/menorescidades",
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

	var _getCidadesSemRotary = function (distrito) {
		return $http({
			method : "post",
			url    : "api/index.php/relatorios/cidadesemrotary",
			data   : distrito
		});
	};

	return {
		getPercapita : _getPercapita,
		getMelhorarPercapita : _getMelhorarPercapita,
		getTodasPercapitas : _getTodasPercapitas,
		getdezmenorescidades : _getdezmenorescidades,
		getdezmaiorescidades : _getdezmaiorescidades,
		getMaioresclubes : _getMaioresClubes,
		getMenoresclubes : _getMenoresClubes,
		getCidadesSemRotary : _getCidadesSemRotary
	};
});