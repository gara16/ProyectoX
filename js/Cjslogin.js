var app = angular.module('SVentas');

app.controller('Clogeo',['$scope','$location','$http','fresg',function($scope,$location,$http,fresg){
	$scope.flag=true;
	$scope.datos={};
	
	$scope.logear=function(){
		
		if ($scope.login!=null) {

			if ($scope.login['user'] == "admin" && $scope.login['pass'] == "1234") {

				$location.path('/Vproducto');

			}else{
				alert("Usuario invalido - :/");
				$scope.login=null;
			};
			
		}else alert("Ingresar Valores de Campos");
		
	};
	$scope.btnregistro=function(){
		if ($scope.registro!=null) {
			if ($scope.registro['nombre'] &&  $scope.registro['apellido'] &&  $scope.registro['dni'] &&  $scope.registro['email']){
				$scope.flag=false;
			}else alert("faltan datos");
			
		}else alert("No Existen datos");
			
	};
	$scope.btnregistrar=function(){
		$scope.flag=true;
		$scope.datos=$scope.registro;
		console.log("datos de registro")
		console.log($scope.registro)
		
		
		fresg.factusuario($scope.datos).success(function(a){
			alert(a);
			console.log(a)
			}).error(function(b) {
				alert(b);
			});
		$location.path('/Vventas');
			
	};

	$scope.btnreset=function(){
		$scope.registro=null;
	};

}]);