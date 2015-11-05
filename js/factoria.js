var app = angular.module('SVentas');

app.factory('fagregar', function ($http) {
	return {
		flistarT:function(){
			return $http.get('cproducto/listarTipo');
		},
		flistarM:function(){
			return $http.get('cproducto/listarMedida');
		},
		fagregarP:function($valor){
			return $http.post('cproducto/agregarProducto',JSON.stringify($valor));
		}
		
	};
});

app.factory('flistar', function ($http) {
	return {
		flistarP:function(){
			return $http.get('cproducto/listarProducto');
		},
		fbuscarP:function($valor){
			return $http.post('cproducto/buscarProducto',JSON.stringify($valor));
		},
		feliminarP:function($valor){
			return $http.post('cproducto/eliminarProducto',JSON.stringify($valor));
		},
		fmodificarP:function($valor){
			return $http.post('cproducto/modificarProducto',JSON.stringify($valor));
		}
	}
});
app.factory('fresg', function ($http) {
	return {

		factusuario:function(valor){
			return $http.post('clogin/agregarUsuario',JSON.stringify(valor));
		}	
	}
});