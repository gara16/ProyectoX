var app = angular.module('SVentas',[]);

app.controller('Producto',['$scope','$http','fagregar','flistar',function($scope,$http,fagregar,flistar){
	$scope.producto={};
	$scope.flag=true;
	$scope.id="";
	
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


	$scope.submit = function(id){
		if ($scope.flag) {
			fagregar.fagregarP($scope.producto).success(function(a){
			alert(a)
			}).error(function(b) {
				alert(b);
			});

		}else{
			$scope.producto[0]=$scope.id;
			console.log($scope.producto)
			flistar.fmodificarP($scope.producto).success(function(a){
			alert(a)
			}).error(function(b) {
				alert(b);
			});
		};
			
	};

	$scope.reset = function(){		
		$scope.producto="";
		$scope.mensajeok="";
		$scope.mensajeerror="";
	};


	$scope.modificar = function($dato){
		$scope.flag=false;
		flistar.fbuscarP($dato).success(function(a){
			$scope.producto=a.lista[0];
			$scope.mensaje=a.error;
			$scope.id=$dato.idproducto;

		});
		
	};

	$scope.eliminar = function($dato){

		flistar.feliminarP($dato).success(function(a){
			alert(a)
		});
		
	};

	

			
}]);

