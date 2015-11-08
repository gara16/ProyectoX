var app = angular.module('SVentas');

app.controller('Ctrlogeo',['$scope','$location','$http','factuser',function($scope,$location,$http,factuser){
	$scope.flag=true;
	$scope.datos={};
	$scope.valor=null;
	$scope.logear=function(){
		
		if ($scope.login!=null) {
			
			if ($scope.login['user'] == "admin" && $scope.login['pass'] == "1234") {

				$location.path('/Vventas');

			}else{
				alert("Usuario invalido - :/");
				$scope.login=null;
			};
			
		}else alert("Ingresar Valores de Campos");
		
	};
	$scope.btnregistro=function(){
		if ($scope.registro!=null) {
			if ($scope.registro['nombre'] &&  $scope.registro['apellido'] &&  $scope.registro['dni'] &&  $scope.registro['email'] &&  $scope.registro['telefono']){
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