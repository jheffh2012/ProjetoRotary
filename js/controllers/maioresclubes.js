rotary.controller('maioresclubesController', function ($scope, relatorioService, distritosService, $localStorage) {
	$scope.titulo = 'Maiores Clubes';
	$scope.getClubes = function () {
		relatorioService.getMaioresclubes($localStorage.dqadistrito.iddistritos).then(function (data) {
			$scope.clubes = data.data;
		}, function (err) {
			console.log(err.data);
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

	$scope.dynamicSort = function (property) {
	    var sortOrder = 1;
	    if(property[0] === "-") {
	        sortOrder = -1;
	        property = property.substr(1);
	    }
	    return function (a,b) {
	        var result = (a[property] > b[property]) ? -1 : (a[property] < b[property]) ? 1 : 0;
	        return result * sortOrder;
	    }
	}

});