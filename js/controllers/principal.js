rotary.controller('principalController', function ($scope, usuarioService, $localStorage) {
	$scope.getLogado = function () {
		// if (!$localStorage.token) {
		// 	window.location = "http://dqabrasil.com.br/login.php";
		// } else {
		// 	// console.log($localStorage.token);
		// 	usuarioService.getuser($localStorage.token).then(function (data) {

		// 	});
		// };
	};

	$scope.getLogado();
})