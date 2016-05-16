var rotary = angular.module('rotary', ["ngRoute", "duScroll", "ui.bootstrap", "angularUtils.directives.dirPagination"]).value('duScrollDuration', 2000);

rotary.config(function ($routeProvider, $locationProvider) {
	$routeProvider
	.when('/paises', {
		templateUrl : 'view/paises.php',
		controller : 'paisesController'
	})
	.when('/cidades', {
		templateUrl : "view/cidades.php",
		controller : 'cidadesController'
	})


	//$routeProvider
	// .when('/', {
	// 	templateUrl : 'view/principal.php'
	// })
	// .when('/sobre', {
	// 	templateUrl : 'view/sobre.php'
	// })
	// .when('/atividadesrealizadas', {
	// 	templateUrl : 'view/realizadas.php'
	// })
	// .when('/parceiros', {
	// 	templateUrl : 'view/parceiros.php'
	// })
	// .when('/contato', {
	// 	templateUrl : 'view/contato.php'
	// })
	// .when('/emconstrucao', {
	// 	templateUrl : 'view/em_construcao.php'
	// })
	// .when('/login', {
	// 	templateUrl : 'login.php',
	// 	controller  : 'loginController'
	// })
	// .when('/bibliotecavirtual', {
	// 	templateUrl : 'view/bibliotecavirtual.php',
	// 	controller  : 'artigoController'
	// })
});