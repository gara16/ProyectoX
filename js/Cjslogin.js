app.controller('Clogeo',['$scope','$location','$http',function($scope,$location,$http){

	$scope.menu=function(){
		$location.path('/Vproducto');
	};

}]);