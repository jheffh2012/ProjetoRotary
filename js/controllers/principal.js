rotary.controller('principalController', function ($scope, usuarioService, $localStorage) {
	$scope.getLogado = function () {
		if (!$localStorage.token) {
			window.location = "http://localhost/projetoRotary/login.php";
		} else {
			// console.log($localStorage.token);
			usuarioService.getuser($localStorage.token).then(function (data) {

			});
		};
	};

	$scope.getLogado();
})