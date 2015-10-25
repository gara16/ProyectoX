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
		
		var nombre = $scope.nombre;		
		var precio = $scope.precio;
		var stock = $scope.stock;
		var idmedida = $scope.idmedida;
		var idtipo = $scope.idtipo;

		$http({
			method : 'POST',
			url : 'cproducto/agregarProducto',
			data : JSON.stringify({
				'nombre' : nombre,
				'precio' : precio,
				'stock' : stock,
				'idmedida' : idmedida,
				'idtipo' : idtipo
			})
		}).success(function(a){
			$scope.mensajeok=a.ok;
			$scope.mensajeerror=a.error;
		});
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
	
}]);