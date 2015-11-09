var app = angular.module('SVentas');

app.factory('fadmin', function ($http) {
	return {
		flistarT:function(){
			return $http.get('cadmin/listarTipo');
		},
		flistarM:function(){
			return $http.get('cadmin/listarMedida');
		},
		fagregarP:function($valor){
			return $http.post('cadmin/agregarProducto',JSON.stringify($valor));
		},
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
		},
		factcerrar:function(){
			return $http.post('clogin/logout');
		}
	};
});

app.factory('factuser', function ($http) {
	return {

		factlogeo:function(valor){
			return $http.post('clogin/loguear',JSON.stringify(valor));
		},
		factusuario:function(valor){
			return $http.post('clogin/agregarUsuario',JSON.stringify(valor));
		},
		sessionUsuario:function(){
			return $http.post('clogin/obtenerSession');
		}
	}
});

app.factory('factventa', function ($http) {
	return {

		factcerrar:function(){
			return $http.post('clogin/logout');
		},
		factlistarP:function(){
			return $http.get('cadmin/listarProducto');
		}
	}
});