rotary.controller('distritosController', function ($scope, distritosService) {
	$scope.distritos = [];

	$scope.getDistritos = function () {
		distritosService.getDistritos().then(function (data) {
			$scope.distritos = data.data;			
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

	$scope.getDistritos();
})