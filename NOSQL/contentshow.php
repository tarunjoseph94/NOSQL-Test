<!DOCTYPE html>
<html>
<head>
  <title>Angular</title>
  <script type="text/javascript" src="js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/angular.js">
  </script>
</head>
<style >
.invalid {
  color:red;
}
</style>
<body>
  <nav>
    <div class="nav-wrapper">

      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <a href="#" class="brand-logo center">NOSQL</a>
        <li><a href="contentadd.html">Add content</a></li>
        <li><a href="contentshow.html">Show content</a></li>

      </ul>
    </div>
  </nav>
  <div class="row" >

    <div class="container" >
      <div class="row" >
        <div class="col s6" >
          <h3>Show Content</h3>
          <div >

            <table>
              <tr>
                <?php
                $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

                if(!$_POST)
                {
                  $query = new MongoDB\Driver\Query([]);
                  $rows = $mng->executeQuery("Test.cur", $query);
                }
                else
                {
                  echo "ABC";
                }

                ?>


                <th>Index</th>
                <th>Currency Name</th>
                <th>Currency Rate</th>
              </tr>

              <?php
              $i=1;
              foreach ($rows as $row) {
                ?>
                <tr >
                  <script type="text/javascript">
                    var flag=1;
                  </script>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $row->curname; ?></td>
                  <td><?php echo $row->currate; ?></td>
                  <td><button class="waves-effect waves-light btn"  onclick="showCon(<?php echo $row->_id; ?>,flag)">Show</button></td>
                  <td><button class="waves-effect waves-light btn" onclick="delCon(<?php echo $row->_id; ?>)">Delete</button></td>
                </tr>
              <?php } ?>

            </table>
          </div>
        </div>
        <div class="col s6">
          <div id="results" >

            <div  ng-app="curApp">
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
              window.flag=1;
              var cur=angular.module("curApp",[]);
              cur.controller('curCtrl',function($scope)
                        {
                            $scope.myRate="<?php echo (int)$row->currate; ?>";
                            $scope.myRup=10;
                        });

            </script>
          </div>

        </div>
      </div>



    </div>

  </div>
  <script type="text/javascript">

  function showCon(id,flag)
  {
    var formData=new FormData();
    formData.append('id',id);
    $.ajax({
      type: "POST",
      url: "show_content_ajax.php",
      processData: false,
      contentType: false,
      data:formData,
      success:function(result){
        $('#results').empty();
        $("#results").html(result);
      }
    });
  }
  function delCon(id)
  {
    var formData=new FormData();
    formData.append('id',id);
    $.ajax({
      type: "POST",
      url: "delete_content_ajax.php",
      processData: false,
      contentType: false,
      data:formData,
      success:function(result){
        if(result=='Success')
        {
          alert("Sucesfully Deleted");
          window.location.replace("http://localhost/NOSQL-t/contentshow.php");

        }
      }
    });
  }

  </script>
</div>
</body>
</html>
