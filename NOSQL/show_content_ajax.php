<?php
   $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $id=(int)$_POST['id'];
    
    $filter=['_id'=>$id]; 
    $query = new MongoDB\Driver\Query($filter);     
    
    $res = $mng->executeQuery("test.cur", $query);
    foreach ($res as $row) {
?>

				  <div ng-app ng-init="myRate='<?php echo (int)$row->currate; ?>';myRup='10'; ">
				  <h3>Currency Calculator</h3>
				  <h5>Currency Name :<?php echo $row->curname; ?></h5>
				  <h6>Rate :<?php echo $row->currate; ?></h6>
				  <p>Rupees in INR</p>
				  <input type="text"  id="currate" ng-model="myRup">
				  <p ng-bind="myRate*myRup"></p>
<?php } ?>