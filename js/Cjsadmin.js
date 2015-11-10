var app = angular.module('SVentas');

app.controller('Ctrladmin',['$scope',"$rootScope",'$http','$location','fadmin',function($scope,$rootScope,$http,$location,fadmin){
	$scope.producto={};
	$scope.flag=true;
	$scope.id="";
	
	fadmin.flistarT().success(function(b){
			$scope.listaT=b.lista;
			$scope.mensaje=b.error;
		});

	fadmin.flistarM().success(function(c){
			$scope.listaM=c.lista;
			$scope.mensaje=c.error;
	});

	fadmin.flistarP().success(function(a){
			$scope.listaP=a.lista;
			$scope.mensaje=a.error;
	});


	$scope.submit = function(id){
		if ($scope.flag) {
			fadmin.fagregarP($scope.producto).success(function(a){
			if (a.error!=null) { alert(a.error)}
			else alert(a.dato);
			}).error(function(b) {
				alert(b);
			});

		}else{
			$scope.producto[0]=$scope.id;
			console.log($scope.producto)
			fadmin.fmodificarP($scope.producto).success(function(a){
			alert(a.respuesta)
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
		fadmin.fbuscarP($dato).success(function(a){
			$scope.producto=a.lista[0];
			$scope.mensaje=a.error;
			$scope.id=$dato.idproducto;

		});
		
	};

	$scope.eliminar = function($dato){

		fadmin.feliminarP($dato).success(function(a){
			alert(a)
		});
		
	};

	$scope.cerrar=function(){
		fadmin.factcerrar().success(function(){
			$location.path('/');
		});
	};

			
}]);


