var app = angular.module('SVentas');

app.controller('Ctrlproveedor',['$scope','$rootScope','$location','$http','fadmin',function($scope,$rootScope,$location,$http,fadmin){
	$scope.proveedor={};
	$scope.flag=true;
	$scope.id="";

	fadmin.flistarProveedor().success(function(a){
			$scope.listaP=a.lista;
			$scope.mensaje=a.error;
	});

	$scope.submit = function(){
		if ($scope.flag) {
			fadmin.fagregarProveedor($scope.proveedor).success(function(a){
				 alert(a);
			}).error(function(b) {
				alert(b);
			});

		}else{
			$scope.proveedor[0]=$scope.id;
			
			fadmin.fmodificarProveedor($scope.proveedor).success(function(a){
			alert(a)
			}).error(function(b) {
				alert(b);
			});
		};
			
	};

	$scope.reset = function(){		
		$scope.proveedor=null;
	};


	$scope.modificar = function(dato){
		$scope.flag=false;
		fadmin.fbuscarProveedor(dato).success(function(a){
			$scope.proveedor=a.lista[0];
			$scope.mensaje=a.error;
			$scope.id=dato.idproveedor;

		});
		
	};

	$scope.eliminar = function(dato){

		fadmin.feliminarProveedor(dato).success(function(a){
			alert(a)
		});
		
	};

	$scope.cerrar=function(){
		fadmin.factcerrar().success(function(){
			$location.path('/');
		});
	};

	
}]);