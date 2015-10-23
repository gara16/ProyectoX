var app=angular.module('SVentas',['ngRoute']);

app.config(function($routeProvider){
	$routeProvider
	.when('/', {
		templateUrl: 'template/Vproducto.html',
		controller: 'agregarP'
	})
	.otherwise({
		redirectTo: '/'
	});
});

app.controller('agregarP',function($scope,$http){
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
});
