var app = angular.module('SVentas');

app.controller('Ctrlventa',['$scope','$location','$http','factventa',function($scope,$location,$http,factventa){
	
	factventa.factlistarP().success(function(a){
			
			if (a.error!=null) {alert(a.error)};
			$scope.Lprod=a.lista;
			
	});

	$scope.carrito=function(){

		$location.path('/Vboleta');

	};


	$scope.cerrar=function(){
		factventa.factcerrar().success(function(){
			$location.path('/');
		});
	};	
}]);