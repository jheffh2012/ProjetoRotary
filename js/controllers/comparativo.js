rotary.controller('comparativoController', function ($scope, relatorioService, distritosService) {
	$scope.Maiores = '';
	$scope.Menores = '';
	$scope.totalMaiores = {};
	$scope.totalMenores = {};
	$scope.totalMaiores.associados = 0;
	$scope.totalMaiores.populacao = 0;
	$scope.totalMaiores.percapita = 0;

	$scope.totalMenores.associados = 0;
	$scope.totalMenores.populacao = 0;
	$scope.totalMenores.percapita = 0;

	$scope.titulo = 'Comparativo';
	$scope.getComparativo = function (distrito) {
		relatorioService.getdezmaiorescidades(distrito).then(function (data) {
			$scope.Maiores = data.data;
			$scope.totalizamaiores($scope.Maiores);
		}, function (err) {
			console.log(err.data);
		});
		relatorioService.getdezmenorescidades(distrito).then(function (data) {
			$scope.Menores = data.data;
			$scope.totalizamenores($scope.Menores);
		}, function (err) {
			console.log(err.data);
		});
		
	};

	$scope.totalizamenores = function (menores) {
		$scope.totalMenores.associados = 0;
		$scope.totalMenores.populacao = 0;
		$scope.totalMenores.percapita = 0;

		menores.forEach(function (menor) {
			$scope.totalMenores.associados = $scope.totalMenores.associados + menor.associados;
			$scope.totalMenores.populacao = $scope.totalMenores.populacao + menor.populacao;
		});
		$scope.totalMenores.percapita = $scope.totalMenores.populacao / $scope.totalMenores.associados;
		$scope.totalMenores.percapita = $scope.totalMenores.percapita.toFixed(0);
	}
	
	$scope.totalizamaiores = function (maiores) {
		$scope.totalMaiores.associados = 0;
		$scope.totalMaiores.populacao = 0;
		$scope.totalMaiores.percapita = 0;

		if ($scope.Maiores.length > 0) {
			$scope.Maiores.forEach(function (maior) {
				$scope.totalMaiores.associados = $scope.totalMaiores.associados + maior.associados;
				$scope.totalMaiores.populacao = $scope.totalMaiores.populacao + maior.populacao;
			});
			$scope.totalMaiores.percapita = $scope.totalMaiores.populacao / $scope.totalMaiores.associados;
			$scope.totalMaiores.percapita = $scope.totalMaiores.percapita.toFixed(0);
		}
	}
	
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
	        var result = (a[property] > b[property]) ? 1 : (a[property] < b[property]) ? -1 : 0;
	        return result * sortOrder;
	    }
	}

	$scope.getDistritos();
});