var app = angular.module('SVentas',[]);

app.controller('Producto',['$scope','$http','fagregar','flistar',function($scope,$http,fagregar,flistar){
	
	fagregar.flistarT().success(function(b){
			$scope.listaT=b.lista;
			$scope.mensaje=b.error;
		});

	fagregar.flistarM().success(function(c){
			$scope.listaM=c.lista;
			$scope.mensaje=c.error;
	});

	flistar.flistarP().success(function(a){
			$scope.listaP=a.lista;
			$scope.mensaje=a.error;
	});


	$scope.submit = function(){
		
		fagregar.fagregarP($scope.producto).success(function(a){
			$scope.mensajeok=a.ok;
			$scope.mensajeerror=a.error;
		}).error(function(b) {
			alert(b);
		});
	};

	$scope.reset = function(){		
		$scope.producto="";
		$scope.mensajeok="";
		$scope.mensajeerror="";
	};


	$scope.modificar = function($dato){

		flistar.fbuscarP($dato).success(function(a){
			console.log(a.id)
			$scope.producto=a.lista;
			$scope.mensaje=a.error;
			
		});
		
	};

	$scope.eliminar = function($dato){

		flistar.feliminarP($dato).success(function(a){
			alert(a)
		});
		
	};

	

			
}]);

