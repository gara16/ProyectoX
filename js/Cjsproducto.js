var app=angular.module('SVentas',[]);

app.controller('producto',function($scope,$http){
	$http.get('http://localhost:8081/productoAngularjs/dbproducto.json')
	.success(function(response){
		$scope._productos = response.product;
	});
});
app.controller('agregarP',function($scope,$http){
	$scope.submit = function(){
		var id = $scope.idproducto;
		var nombre = $scope.nombre;
		var stock = $scope.stock;
		var precio = $scope.precio;
		var idmedida = $scope.idmedida;
		var idtipo = $scope.idtipo;

		$http({
			method : 'POST',
			url : 'cProducto/agregarProducto',
			data : JSON.stringify({
				'idproducto' : id,
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