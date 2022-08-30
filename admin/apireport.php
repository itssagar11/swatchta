<?php require_once("header.php") ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid px-4">
            <h1 class="mt-4">Report</h1>
            <ol class="breadcrumb mb-4">

            </ol>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                           Statics of company
                        </div>
                        <div class="card-body">
                        <div id="donutchart" style="width: 8=600px; height: 500px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Request Status
                        </div>
                        <div class="card-body">
                        <div id="piechart" style="width: 600px; height: 500px;"></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Requests
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table-responsive table">
                        <thead>
                            <tr>
                            <th>Date</th>
                                <th>App</th>
                               
                                <th>Address</th>
                                <th>Status</th>
                               
                               
                            </tr>
                        </thead>
                       
                        <tbody id="newReq">
                        <tr>

                        <?php
                        $sql="SELECT * FROM garbagedataset  order by id DESC";
                        $q=mysqli_query($conn,$sql);
                        if(!$q){
                            echo mysqli_error($conn);
                        }else{
                            while($row=mysqli_fetch_assoc($q)){

                         
                        
                        
                        
                        ?>
                                <td><?php echo $row['date'];?></td>
                                <td><?php echo $row['company'] ?></td>
                               
                              
                                <td><?php echo $row['address'] ?></td>
                                <td><?php if( $row['company']=0) {echo "pending";}else{
                                    echo "completed";
                                } ?></td>
                                
                               
                            </tr>
                           <?php    }
                        }?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </main>
</div>
<script type="text/javascript">
     google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        let pr;
        let c;
        $.ajax({
            url:'controller/apiCompany_Graph.php',
            type:'post',
            async:false,
            success:function(resp){
                let obj=JSON.parse(resp);
              console.log(obj)
                pr=obj.zomato;
                c=obj.swiggy;
              
            }
        })
        var data = google.visualization.arrayToDataTable([
          ['company', 'No of request '],
          ['Swiggy',c],
          ['Zomato',pr],
         
        ]);

        var options = {
          title: 'My Daily Activities',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }



      
    </script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        let pr;
        let c;
        $.ajax({
            url:'controller/apiStatus_Graph.php',
            type:'post',
            async:false,
            success:function(resp){
                let obj=JSON.parse(resp);
              console.log(obj)
                pr=obj.pendingReq;
                c=obj.complete;
              
            }
        })
        var data = google.visualization.arrayToDataTable([
          ['Request', 'Status'],
          ['Pending',     pr],
          ['complete',      c],
          
        ]);

        var options = {
          title: 'Pickup Status'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>