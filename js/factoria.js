var app = angular.module('SVentas');

app.factory('fagregar', function ($http) {
	return {
		flistarT:function(){
			return $http.get('index.php/cproducto/listarTipo');
		},
		flistarM:function(){
			return $http.get('index.php/cproducto/listarMedida');
		},
		fagregarP:function($valor){
			return $http.post('index.php/cproducto/agregarProducto',JSON.stringify($valor));
		}
		
	};
});

app.factory('flistar', function ($http) {
	return {
		flistarP:function(){
			return $http.get('index.php/cproducto/listarProducto');
		},
		fbuscarP:function($valor){
			return $http.post('index.php/cproducto/buscarProducto',JSON.stringify($valor));
		},
		feliminarP:function($valor){
			return $http.post('index.php/cproducto/eliminarProducto',JSON.stringify($valor));
		},
		fmodificarP:function($valor){
			return $http.post('index.php/cproducto/modificarProducto',JSON.stringify($valor));
		}
	}
});