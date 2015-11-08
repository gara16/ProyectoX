var app = angular.module('SVentas');

app.factory('fagregar', function ($http) {
	return {
		flistarT:function(){
			return $http.get('cadmin/listarTipo');
		},
		flistarM:function(){
			return $http.get('cadmin/listarMedida');
		},
		fagregarP:function($valor){
			return $http.post('cadmin/agregarProducto',JSON.stringify($valor));
		}
	};
});

app.factory('flistar', function ($http) {
	return {
		flistarP:function(){
			return $http.get('cadmin/listarProducto');
		},
		fbuscarP:function($valor){
			return $http.post('cadmin/buscarProducto',JSON.stringify($valor));
		},
		feliminarP:function($valor){
			return $http.post('cadmin/eliminarProducto',JSON.stringify($valor));
		},
		fmodificarP:function($valor){
			return $http.post('cadmin/modificarProducto',JSON.stringify($valor));
		}
	}
});
app.factory('factuser', function ($http) {
	return {

		factusuario:function(valor){
			return $http.post('clogin/agregarUsuario',JSON.stringify(valor));
		},
		sessionUsuario:function(){
			return $http.post('clogin/obtenerSession');
		}
	}
});