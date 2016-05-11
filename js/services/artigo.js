labcasp.factory("artigoService", function ($http) {
	//retorno publico
	var _getArtigos = function() {
		return $http({
			method : "get",
			url    : "api/web/index.php/artigo/"
		});
	}

	return {
		getArtigos : _getArtigos
	};
});