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
  .when('/Vboleta', {
    templateUrl: 'template/Vboleta.html',
    controller: 'Ctrlboleta'
  })
  .when('/Vadministrador', {
    templateUrl: 'template/Vadministrador.html',
    controller: 'Ctrladministrador'
  })
  .when('/Vproveedor', {
    templateUrl: 'template/Vproveedor.html',
    controller: 'Ctrlproveedor'
  })
	.otherwise({
		redirectTo: '/'
	});
});

app.run(['$rootScope','$location','factuser', function($rootScope,$location,factuser){
     $rootScope.$on('$routeChangeStart', function( event, route)
     {
      factuser.sessionUsuario().success(function(data){
      	$rootScope.var_user=data.user;
      	console.log(data.user);
      	if(data.estado){
         	if(route.templateUrl=='template/Login.html'){
              if (data.tipouser==1) {
                $location.path('/Vadmin');
              }else $location.path('/Vventas');
               
            }
         }
         else {
       	 	if(route.templateUrl=='template/Vventas.html'|| route.templateUrl=='template/Vadmin.html' || route.templateUrl=='template/Vboleta.html' ){
              	 $location.path('/');
             }
         }
      }).error(function(b){alert(b);});
     });
}]);