rotary.controller('paisesController', function ($scope, paisesService) {
	$scope.paises = [];

	$scope.getPaises = function () {
		paisesService.getPaises().then(function (data) {
			$scope.paises = data.data;			
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.sort = function (nameCol) {
		if ($scope.nameCol == nameCol) {
			$scope.sortKey = $scope.nameCol;

			$scope.nameCol = 'sem ordenação';
			$scope.reverse = true;
		} else {
			$scope.nameCol = nameCol;
			$scope.sortKey = $scope.nameCol;
			$scope.reverse = false;
		}
	};

	$scope.getPaises();
})