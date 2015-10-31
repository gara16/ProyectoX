var app = angular.module('mainApp',['ngRoute']);

app.config(function($routeProvider){
	$routeProvider
	.when('/', {
		templateUrl: 'template/login.html',
		controller: 'loginCtrl'
	})
	.when('/Welcome', {
		templateUrl: 'template/Welcome.html'
	})
	.otherwise({
		redirectTo: '/'
	});
});
