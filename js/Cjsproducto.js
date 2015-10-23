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
		var stock = $scope.stock;
		var precio = $scope.precio;
		var idmedida = $scope.idmedida;
		var idtipo = $scope.idtipo;

		$http({
			method : 'POST',
			url : 'cProducto/agregarProducto',
			data : JSON.stringify({
				'nombre' : nombre,
				'stock' : stock,
				'precio' : precio,
				'idmedida' : idmedida,
				'idtipo' : idtipo
			})
		}).success(function(imbox){
			$scope.mensajeok=imbox.ok;
			$scope.mensajeerror=imbox.error;
		});
	};
});
