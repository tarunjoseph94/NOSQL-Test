<?php
$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$id=(int)$_POST['id'];
session_start();
$_SESSION['flag']=0;
$_SESSION['flag']++;
$appName='curApp'.$_SESSION['flag'];
$filter=['_id'=>$id];
$query = new MongoDB\Driver\Query($filter);
$res = $mng->executeQuery("Test.cur", $query);
foreach ($res as $row) {
  ?>
  <div id="try" >
    <div ng-controller="curCtrl">
      <h3>Currency Calculator</h3>
      <h5>Currency Name :<?php echo $row->curname; ?></h5>
      <h6>Rate :<?php echo $row->currate; ?></h6>
      <p>Rupees in INR</p>
      <input type="text"  id="currate" ng-model="myRup">
      <p ng-bind="myRate*myRup"></p>
    </div>
  </div>
  <script type="text/javascript">
  var appName='<?php echo $appName; ?>';
  var cur=angular.module(appName,[]);

  angular.element(function() {
    angular.bootstrap(document.getElementById('try'), [appName]);
   });
  cur.controller('curCtrl',function($scope)
  {
    $scope.myRate="<?php echo (int)$row->currate; ?>";
    $scope.myRup=10;
  });

</script>
<?php } ?>
