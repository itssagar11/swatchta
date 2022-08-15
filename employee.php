<?php require_once('header.php')?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <div id="layoutSidenav_content">
                <main>
                <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Request
                        </div>
                        <div class="card-body">
                            <div id="donutchart" width="100%" height="40"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Active Employee<small><a href="EmployeesLocation.php"> View All active Employees Location</a></small>
                        </div>
                        <div class="card-body">
                            <ul class="list-group activeEmp">
                                
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    New Request
                </div>
             
            </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Pending Request
                            </div>
                            
                            <div class="card-body">
                            <div class="card-body">
                            <table class="table table-responsive">
                            <?php 
                            
                            $id= $_SESSION["login_user"]["id"];
                            $sql1="Select * from service where allocated_to=$id and status=2 ";
                            if(!$result=mysqli_query($conn,$sql1)){
                                echo mysqli_errno($conn);
                            }else{
                                while($res=mysqli_fetch_assoc($result)){

                          
                            
                            ?>
                            <tr>
                                <td>
                                    Address:- <?php echo $res["address"];?>
                                    <br>
                                    <small>Date:-  <?php echo $res["date"];?></small><br>
                                   
                                   Status: 
                                    <?php if($res["status"]==0){?> 
                                         <small>
                                            <a class="text-danger">Close </a>
                                        </small>
                                        <?php }else if($res["status"]==2){?>
                                            <small>
                                            <a class="text-success">Pending </a>
                                        </small>
                                        <?php }?>
                                        <div style="float:right;">
                                          <small>
                                            <a href="EmpAction.php?id=<?php echo $res['id']?>">View </a>
                                        </small>
                                    </div>
                                </td>

                            </tr>
                            <?php }}?>
                        </table>
                            </div>
                        </div>
                    </div>
                 
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
            let pr;
            let c;
        let id=<?php echo $user['id']?>;
        $.ajax({
            url:'controller/request_graphofEmp.php',
            type:'post',
            async:false,
            data:{id:id},
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
          ['Compete',     c],
         
        ]);

        var options = {
          title: 'My Daily Activities',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
</html>
