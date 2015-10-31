var app=angular.module('SVentas',[]);


app.controller('eventos',['$scope',function($scope){
	
	$scope.flagP=false;
	$scope.flagL=false;
	$scope.flagM=false;

	$scope.agregar = function(){
		$scope.flagL=false;
		$scope.flagM=false;
		$scope.flagP=true;
			
	};


	$scope.listar=function(){
		$scope.flagP=false;
		$scope.flagM=false;
		$scope.flagL=true;
		 
		 
	};

	$scope.modificar=function(){
		$scope.flagP=false;
		$scope.flagL=false;
		$scope.flagM=true;
	};

}]);

app.controller('agregarP',['$scope','$http',"$q",function($scope,$http,$q){
	
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

app.controller('modificarP',['$scope','$http',function($scope,$http){
	
	$http({
			method : 'GET',
			url : 'cproducto/listarProducto',
			
		}).success(function(a){
			$scope.listaMP=a.lista;
			$scope.mensaje=a.error;
	});

	$http({
			method : 'GET',
			url : 'cproducto/listarTipo',
			
		}).success(function(b){
			$scope.listaMT=b.lista;
			$scope.mensaje=b.error;
		});

	$http({
			method : 'GET',
			url : 'cproducto/listarMedida',
			
		}).success(function(c){
			$scope.listaMM=c.lista;
			$scope.mensaje=c.error;
	});	
		

}]);


