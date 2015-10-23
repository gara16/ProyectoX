var app=angular.module('SVentas',[]);

app.controller('producto',function($scope,$http){
	$http.get('http://localhost:8081/productoAngularjs/dbproducto.json')
	.success(function(response){
		$scope._productos = response.product;
	});
});
app.controller('agregarP',function($scope,$location,$http){
	$scope.submit = function(){
		var uname = $scope.username;
		var password = $scope.password;

		$http({
			method : 'POST',
			url : 'clogin/logeo',
			data : JSON.stringify({
				'username' : uname,
				'password' : password
			})
		}).success(function(a){
			$scope.mensajeok=a.ok;
			$scope.mensajeerror=a.error;
		});