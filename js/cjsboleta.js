var app = angular.module('SVentas');

app.controller('Ctrlboleta',['$scope',"$rootScope",'$http','$location','fadmin',function($scope,$rootScope,$http,$location,fadmin){
	
	$scope.cerrar=function(){
		fadmin.factcerrar().success(function(){
			$location.path('/');
		});
	};

			
}]);


