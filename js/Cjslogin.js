var app = angular.module('SVentas');

app.controller('Ctrlogeo',['$scope','$rootScope','$location','$http','factuser',function($scope,$rootScope,$location,$http,factuser){
	$scope.flag=true;
	$scope.datos={};
	$scope.valor=null;

	$scope.logear=function(login){
		
		if (login!=null) {
			
			factuser.factlogeo(login).success(function(a){
				console.log(a.dato)
				if (a.error!=null) {
					alert(a.error);
					console.log(a.error);
				};
				if (a.dato==1) {
					$location.path('/Vadmin');
				};
				if (a.dato==2) {
					$location.path('/Vventas');
				};

				

			}).error(function(b){
				alert(b);
			});

			
			
		}else alert("Ingresar Valores de Campos");
		
	};
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

			factuser.factusuario($scope.datos).success(function(a){
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

	$scope.btnreset=function(){
		$scope.registro=null;
	};

}]);