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
		}
	}
});