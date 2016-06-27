rotary.controller('logoutController', function ($scope, usuarioService, $localStorage) {
	$localStorage.token = "";
	$scope.logout = function () {
		usuarioService.getUsers(function(data) {
			console.log(data.data);
		}, function (err) {
			console.log(err.data);
		})
	};

	$scope.logout();
})