var app = angular.module('SVentas',['ngRoute']);

app.config(function($routeProvider){
	$routeProvider
	.when('/', {
		templateUrl: 'template/Login.html',
		controller: 'Ctrlogeo'
	})
	.when('/Vproducto', {
		templateUrl: 'template/Vproducto.html',
		controller: 'Producto'
	})
	.when('/Vventas', {
		templateUrl: 'template/Vventas.html',
		controller: 'Ctrlogeo'
	})
	.otherwise({
		redirectTo: '/'
	});
});
