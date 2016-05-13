rotary.controller('paisesController', function ($scope, paisesService) {
	$scope.paises = [];

	$scope.getPaises = function () {
		paisesService.getPaises().then(function (data) {
			$scope.paises = data.data;
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.getPaises();
})