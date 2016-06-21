rotary.controller('menoresclubesController', function ($scope, relatorioService, distritosService) {
	$scope.titulo = 'Menores Clubes';
	$scope.getClubes = function (idDistrito) {
		relatorioService.getMenoresclubes(idDistrito).then(function (data) {
			$scope.clubes = data.data;
		}, function (err) {
			console.log(err.data);
		});
	};

	$scope.getDistritos = function (idDistrito) {
		distritosService.getDistritos(idDistrito).then(function (data) {
			$scope.distritos = data.data;
		}, function (err) {
			console.log(err.data);
		})
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

	$scope.getDistritos();
});