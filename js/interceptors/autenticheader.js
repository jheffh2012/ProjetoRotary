rotary.factory("AutenticHeaderInterceptor", function ($q, $localStorage, $location) {
	return {
		request : function (config) {
			if (config.url.indexOf('view' === -1)) {
				config.headers.tokenRotary = $localStorage.token;
			};
			return config;
		},
		response : function (response) {
			$localStorage.token = response.config.headers.tokenRotary;
			return response;
		},
		responseError : function (rejection) {
			if (rejection.status == 401) {
				console.log(rejection);
				window.location = "http://localhost/projetoRotary/login.php";
			}
		}
	};
});