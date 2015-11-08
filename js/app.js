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
app.run(['$rootScope','$location','factuser', function($rootScope,$location,factuser){
     $rootScope.$on('$routeChangeStart', function( event, route)
     {
      factuser.sessionUsuario().success(function(data){
      	if(data.estado){
         	if(route.templateUrl=='template/Login.html'){
               $location.path('/Vventas');
            }
         }
         else {
       	 	if(route.templateUrl=='template/Vventas.html'|| route.templateUrl=='template/Vproducto.html'){
              	 $location.path('/');
             }
         }
      }).error(function(b){alert(b);});
     });
}]);