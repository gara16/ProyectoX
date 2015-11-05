var app = angular.module('SVentas',['ngRoute']);

app.config(function($routeProvider){
	$routeProvider
	.when('/', {
		templateUrl: 'template/Login.html',
		controller: 'Clogeo'
	})
	.when('/Vproducto', {
		templateUrl: 'template/Vproducto.html',
		controller: 'Producto'
	})
	.when('/Vventas', {
		templateUrl: 'template/Vventas.html',
		controller: 'Clogeo'
	})
	.otherwise({
		redirectTo: '/'
	});
});
