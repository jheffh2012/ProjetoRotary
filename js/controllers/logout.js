rotary.controller('logoutController', function ($scope, usuarioService, $localStorage) {
	$localStorage.dqatoken = "";
	$scope.logout = function () {
		usuarioService.getUsers(function(data) {
			console.log(data.data);
		}, function (err) {
			console.log(err.data);
		})
	};

	$scope.logout();
})