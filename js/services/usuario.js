labcasp.factory("usuarioService", function ($http) {
	//retorno publico
	return ({
		login : login 
	});

	function login(dados){
		var request = $http({
			method : "post",
			url : "api/web/index.php/usuario/login",
			data : dados
		});

		return(request.then(function (res) {
			return(res.data);
		}, function (res) {
			return(res.data);
		}))
	}

});