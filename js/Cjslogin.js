app.controller('Clogeo',['$scope','$location','$http',function($scope,$location,$http){
	$scope.flag=true;
	$scope.menu=function(){
		
		if ($scope.login!=null) {

			if ($scope.login['user'] == "admin" && $scope.login['pass'] == "1234") {

			$location.path('/Vproducto');

			}else{
				alert("Usuario invalido - :/");
				$scope.login=null;
			};
			
		}else alert("Ingresar Valores de Campos");
		
	};
	$scope.registro=function(){
		$scope.flag=false;
	};
	$scope.registrar=function(){
		$scope.flag=true;
	}

}]);