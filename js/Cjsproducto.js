var app=angular.module('SVentas',[]);


app.controller('eventos',['$scope',function($scope){
	$scope.flagP=false;
	$scope.flagL=false;
	
	$scope.agregar = function(){
		$scope.flagL=false;
		$scope.flagP=true;
			
	};


	$scope.listar=function(){
		$scope.flagP=false;
		$scope.flagL=true;
		 
		 
	};

}]);

app.controller('agregarP',['$scope','$http',function($scope,$http){
	
	
	$scope.submit = function(){
		
		$http({
			method : 'POST',
			url : 'cproducto/agregarProducto',
			data : JSON.stringify($scope.producto)
		}).success(function(a){
			$scope.mensajeok=a.ok;
			$scope.mensajeerror=a.error;
		});
	};

	$scope.reset = function(){
		
		$scope.producto="";
		$scope.mensajeok="";
		$scope.mensajeerror="";
	};

	$http({
			method : 'GET',
			url : 'cproducto/listarTipo',
			
		}).success(function(b){
			$scope.listaT=b.lista;
			$scope.mensaje=b.error;
		});

	$http({
			method : 'GET',
			url : 'cproducto/listarMedida',
			
		}).success(function(c){
			$scope.listaM=c.lista;
			$scope.mensaje=c.error;
		});	

}]);

app.controller('ListarP',['$scope','$http',function($scope,$http){
	
		$http({
			method : 'GET',
			url : 'cproducto/listarProducto',
			
		}).success(function(a){
			$scope.listaP=a.lista;
			$scope.mensaje=a.error;
		});

		$scope.eliminar = function(){
		
		
		$scope.death= $scope.listaP;

	};
	
}]);