<?php require_once("header.php") ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Pending Request  
                        <?php
                        $sql="SELECT count(id) as count  FROM  service where status=1";
                        if(!$res=mysqli_query($conn,$sql)){
                            echo mysqli_error($conn);
                        }else
                        $count=mysqli_fetch_assoc($res);
                        
                        ?>    
                        
                        
                        <h2><?php echo htmlentities($count['count'])?></h2></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Active Employee  <h2 id="ae">0</h2></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Users 
                        <?php
                        $sql="SELECT count(id) as count  FROM  citizen ";
                        if(!$res=mysqli_query($conn,$sql)){
                            echo mysqli_error($conn);
                        }else
                        $count=mysqli_fetch_assoc($res);
                        
                        ?>
                        
                        <h2><?php echo htmlentities($count['count'])?></h2></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Danger Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Request
                        </div>
                        <div class="card-body">
                            <div id="requestChart" width="100%" height="40"></div>
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
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                       
                        <tbody id="newReq">
                           
                           
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
   <?php require_once("footer.php")?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script>

    $(document).ready(function(){
        $.ajax({
            url:'controller/fetchRequest.php?status=1',
            type:'get',
            success:function(resp){
               obj=JSON.parse(resp);
            //    console.log(obj);
               let html="";
               for(const item of obj){
                // console.log(item['']);
                html+=` <tr>
                                <td>${item['date']}</td>
                                <td>${item['address']}</td>
                                <td>${item['contact']}</td>
                                <td><a href="viewRequest.php?id=${item['id']}">View</a></td>
                                
                            </tr>`
               }
               $("#newReq").append(html);
            }
        })
      
        updateEmployee();
    })
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(requestChart);

    function requestChart() {
        let pr=0;
        let c=0;
        let w=0;
        let d=0;
        let a=0;

        $.ajax({
            url:'controller/request_graph.php',
            type:'post',
            async:false,
            success:function(resp){
                let obj=JSON.parse(resp);
              console.log(obj)
                pr=obj.pendingReq;
                c=obj.complete;
                w=obj.withdraw;
                d=obj.disapprove;
                a=obj.assigned;
            }
        })
        var data = google.visualization.arrayToDataTable([
            ['status', 'count'],
            ['pending ', pr],
            ['complete ', c],
            ['withdraw ', w],
            ['disapprove', d],
            ['assigned', a]
        ]);

        var options = {
            title: 'Request Status'
        };

        var chart = new google.visualization.PieChart(document.getElementById('requestChart'));

        chart.draw(data, options);
    }
    setInterval(updateEmployee,5000);

    function updateEmployee(){
        $.ajax({
            url:"controller/update_active_employee.php",
            type:"post",
            success:function(resp){
                count=0;
                $(".activeEmp").empty();
                $("#ae").empty();
                let html='';
                if(resp==-1){
                    html+=`<li class="list-group-item"><small>No Employee Active</small></li>`
                }else{
                   
                    let obj=JSON.parse(resp);
                for(item of obj){
                    count++;
                    html+=`<li class="list-group-item">${item['name']} <b> Location: </b>${item['last_location']} <small><a href="EmployeeLocation.php?id=${item['id']}">View on Map</a></small></li>`
                }
                }
                $(".activeEmp").append(html);
                $("#ae").append(count);
               
            }
        })
    }
</script>
</body>

</html>