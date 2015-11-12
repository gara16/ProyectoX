var app = angular.module('SVentas');

app.controller('Ctrlventa',['$scope','$rootScope','localStorageService','$location','$http','factventa',function($scope,$rootScope,localStorageService,$location,$http,factventa){


	/*var Boleta = localStorageService.get('ArrayBoleta');
	$scope.ArrayBoleta= Boleta && Boleta.split('\n') || [];
	$scope.$watch('ArrayBoleta',function(newValue,oldValue){
		localStorageService.add('ArrayBoleta',$scope.ArrayBoleta.join('\n'));
	},true);*/

	$scope.ArrayBoleta=[];
	$rootScope.PrecioT=0;

	$scope.flag=true;
	factventa.factlistarP().success(function(a){
			
			if (a.error!=null) {alert(a.error)};
			$scope.Lprod=a.lista;
			
	});

	$scope.carrito=function(){
		$scope.flag=false;
	};

	$scope.menu=function(){
		$scope.flag=true;
	};

	$scope.addcarrito=function(valor){
		if ($scope.ArrayBoleta.indexOf(valor) == -1) {
			console.log(valor);
			$scope.ArrayBoleta.push(valor);
			console.log($scope.ArrayBoleta);
		}else alert("ya se Selecciono");

		
	};

	$scope.eliminar=function(valor){
		var index = $scope.ArrayBoleta.indexOf(valor);
		$scope.ArrayBoleta.splice(index,1);
	};

	$scope.cerrar=function(){
		factventa.factcerrar().success(function(){
			$location.path('/');
		});
	};	
}]);