var app = angular.module('SVentas');

app.controller('Ctrlventa',['$scope','$location','$rootScope','$http','factventa',function($scope,$location,$rootScope,$http,factventa){
	$scope.User=$rootScope.Usuario;
	factventa.factlistarP().success(function(a){
			
			if (a.error!=null) {alert(a.error)};
			$scope.Lprod=a.lista;
			
	});

	$scope.cerrar=function(){
		factventa.factcerrar().success(function(){
			$location.path('/');
		});
	};	
}]);