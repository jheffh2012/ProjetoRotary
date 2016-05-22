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
	.when('/estados', {
		templateUrl : "view/estados.php",
		controller  : "estadosController"
	})
	.when('/distritos', {
		templateUrl : "view/distritos.php",
		controller  : "distritosController"
	})
	.when('/novodistrito', {
		templateUrl : "view/dadosdistrito.php",
		controller  : "novodistritoController"
	})
	.when('/editadistrito/:iddistrito', {
		templateUrl : "view/dadosdistrito.php",
		controller  : "editadistritoController"
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
rotary.config(function (paginationTemplateProvider) {
	paginationTemplateProvider.setPath('js/angular/dirPagination.tpl.html');
})