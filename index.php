<!doctype html>
<html>
<head><link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

</head>
<body>
<div ng-app="myApp" ng-controller="myCtrl"> 

{{myWelcome}}
<table class="table table-striped">
  <tr ng-repeat="x in myWelcome">
    <td ng-repeat="y in x">{{ y }}</td>
    
  </tr>
</table>

</div>



<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
  $http({
    method : "POST",
    url : "bid_data.php",
	params : { table: 2, round: 2, board: 3 }
  }).then(function mySuccess(response) {
      $scope.myWelcome = response.data;
    }, function myError(response) {
      $scope.myWelcome = response.statusText;
  });
});
</script>

</body>
</html>