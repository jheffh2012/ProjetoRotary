rotary.controller('melhorespercapitasController', function ($scope, relatorioService, distritosService) {
	$scope.titulo = 'Melhores Percapitas';
	$scope.percapitas = '';
	$scope.media = '';
	$scope.totaliza = {};
	$scope.totaliza.clubes = 0;
	$scope.totaliza.associados = 0;
	$scope.totaliza.populacao = 0;
	$scope.totaliza.percapita = 0;

	$scope.getPercapitas = function (distrito) {
		relatorioService.getPercapita(distrito).then(function (data) {
			$scope.percapitas = data.data;
			$scope.percapitas.sort($scope.dynamicSort("percapita"));
			$scope.totalizar($scope.percapitas);
		}, function (err) {
			$scope.erro = err.data;
		});
	};

	$scope.totalizar = function (percapitas) {
		$scope.totaliza.clubes = 0;
		$scope.totaliza.associados = 0;
		$scope.totaliza.populacao = 0;
		$scope.totaliza.percapita = 0;
		percapitas.forEach(function (percapita) {
			$scope.totaliza.clubes = $scope.totaliza.clubes + percapita.clubes;
			$scope.totaliza.associados = $scope.totaliza.associados + percapita.associados;
			$scope.totaliza.populacao = $scope.totaliza.populacao + percapita.populacao;
			$scope.totaliza.percapita = $scope.totaliza.populacao / $scope.totaliza.associados;
			$scope.totaliza.percapita = $scope.totaliza.percapita.toFixed(0);
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