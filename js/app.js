var app = angular.module('SVentas',['ngRoute']);

app.config(function($routeProvider){
	$routeProvider
	.when('/', {
		templateUrl: 'template/Login.html',
		controller: 'Ctrlogeo'
	})
	.when('/Vadmin', {
		templateUrl: 'template/Vadmin.html',
		controller: 'Ctrladmin'
	})
	.when('/Vventas', {
		templateUrl: 'template/Vventas.html',
		controller: 'Ctrlventa'
	})
	.otherwise({
		redirectTo: '/'
	});
});
app.run(['$rootScope','$location','factuser', function($rootScope,$location,factuser){
     $rootScope.$on('$routeChangeStart', function( event, route)
     {
      factuser.sessionUsuario().success(function(data){
      	$rootScope.Usuario=data.user;
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