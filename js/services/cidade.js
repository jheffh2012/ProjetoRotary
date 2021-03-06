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

	var _deleteCidade = function (codigocidade) {
		return $http({
			method : "post",
			url : "api/index.php/cidade/delete",
			data : codigocidade
		})
	};

	var _salvarCidade = function (dadoscidade) {
		return $http({
			method : "put",
			url : "api/index.php/cidade/",
			data : dadoscidade
		})
	};

	var _atualizaPopulacao = function (cidades) {
		return $http({
			method : "put",
			url    : "api/index.php/cidade/atualizapopulacao",
			data   : cidades
		})
	}

	return {
		getCidades : _getCidades,
		getCidadesEstado : _getCidadesEstado,
		getCidade : _getCidade,
		atualizaPopulacao : _atualizaPopulacao,
		deleteCidade : _deleteCidade,
		salvarCidade : _salvarCidade
	};
});