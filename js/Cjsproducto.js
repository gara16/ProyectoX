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
	
		

}]);

app.controller('EnviarImg', ['$scope', 'upload', function ($scope, upload) 
{
	$scope.uploadFile = function()
	{
		
		upload.uploadFile($scope.Img).then(function(res)
		{
			console.log(res);
		})
	};
}]);

app.directive('uploaderModel', ["$parse", function ($parse) {
	return {
		restrict: 'A',
		link: function (scope, iElement, iAttrs) 
		{
			iElement.on("change", function(e)
			{
				$parse(iAttrs.uploaderModel).assign(scope, iElement[0].files[0]);
			});
		}
	};
}]);

app.service('upload', ["$http", "$q", function ($http, $q) 
{
	this.uploadFile = function(file, name)
	{
		var deferred = $q.defer();
		var formData = new FormData();
		formData.append("name", name);
		formData.append("file", file);
		return $http.post("server.php", formData, {
			headers: {
				"Content-type": undefined
			},
			transformRequest: angular.identity
		})
		.success(function(res)
		{
			deferred.resolve(res);
		})
		.error(function(msg, code)
		{
			deferred.reject(msg);
		})
		return deferred.promise;]);