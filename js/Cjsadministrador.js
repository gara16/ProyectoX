var app = angular.module('SVentas');

app.controller('Ctrladministrador',['$scope','$rootScope','$location','$http','fadmin',function($scope,$rootScope,$location,$http,fadmin){
	$scope.flag=true;
	$scope.datos={};
	$scope.valor=null;

	$scope.btnregistro=function(dato){
		if (dato!=null) {
			if (dato.nombre &&  dato.apellido &&  dato.dni &&  dato.email &&  dato.telefono){
				$scope.flag=false;
			}else alert("faltan datos");
			
		}else alert("No Existen datos");
	};
	$scope.btnregistrar=function(a){
		if (a.user && a.pass) {
			$scope.flag=true;
			$scope.datos=$scope.registro;
			console.log("datos de registro")
			console.log($scope.registro)

			fadmin.factadministrador($scope.datos).success(function(a){
				if (a.error!=null) {alert(a.error);};
				//$scope.valor=a.dato;
				console.log(a);
				//console.log($scope.valor);
				if (a.dato!=null){
					$location.path('/Vventas');
				}
				else
					console.log("Fallo al incio al registrarse");
				}).error(function(b) {
					alert(b);
				});

			//if ($scope.valor!=null){$location.path('/Vventas');}
			//else console.log("Fallo al incio al registrarse"); 
		}else
			alert("Faltan datos");
	};

	$scope.reset=function(){
		$scope.registro=null;
	};

	$scope.cerrar=function(){
		fadmin.factcerrar().success(function(){
			$location.path('/');
		});
	};

	$scope.menu=function(){
		fadmin.factcerrar().success(function(){
			$location.path('/');
		});
	};

}]);