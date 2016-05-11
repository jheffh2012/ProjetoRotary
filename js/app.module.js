var labcasp = angular.module('labcasp', ["ngRoute", "duScroll"]).value('duScrollDuration', 2000);

labcasp.config(function ($routeProvider, $locationProvider) {
	$routeProvider
	.when('/', {
		templateUrl : 'view/principal.php'
	})
	.when('/sobre', {
		templateUrl : 'view/sobre.php'
	})
	.when('/atividadesrealizadas', {
		templateUrl : 'view/realizadas.php'
	})
	.when('/parceiros', {
		templateUrl : 'view/parceiros.php'
	})
	.when('/contato', {
		templateUrl : 'view/contato.php'
	})
	.when('/emconstrucao', {
		templateUrl : 'view/em_construcao.php'
	})
	.when('/login', {
		templateUrl : 'login.php',
		controller  : 'loginController'
	})
	.when('/bibliotecavirtual', {
		templateUrl : 'view/bibliotecavirtual.php',
		controller  : 'artigoController'
	})
});