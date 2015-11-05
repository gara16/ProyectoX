app.controller('Clogeo',['$scope','$location','$http',function($scope,$location,$http){
	$scope.flag=true;
	$scope.datos={};
	$scope.usuario={};
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
			$scope.flag=false;
			$scope.datos=$scope.registro;
			console.log($scope.datos)
		}else alert("No Existen datos");
			
	};
	$scope.btnregistrar=function(){
		$scope.flag=true;
		$scope.usuario=$scope.registrar;
		console.log($scope.usuario)
		flogin.fdatos($scope.datos).success(function(a){
			alert(a)
			}).error(function(b) {
				alert(b);
			});
		flogin.fusuario($scope.usuario).success(function(a){
			alert(a)
			}).error(function(b) {
				alert(b);
			});
	}
	$scope.btnreset=function(){
		$scope.registro=null;
	}

}]);