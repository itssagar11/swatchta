<?php require_once('userHeader.php')?>
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
                                    <div class="card-body">My Coins  <h3 id="coin"></h3></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Coupan</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Request</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                           
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                My Request
                                <div class="" style="float:right;">
                                    <a href="requestService.php" class="btn btn-primary btn-sm">Make New Request</a>
                                </div>
                            </div>
                            <div class="card-body">
                            <table class="table table-responsive">
                            <?php 
                            
                            $id= $_SESSION["login_user"]["id"];
                            $sql1="SELECT * FROM `service` where citizen_id='$id' ";
                            if(!$result=mysqli_query($conn,$sql1)){
                                echo mysqli_errno($conn);
                            }else{
                                while($res=mysqli_fetch_assoc($result)){

                          
                            
                            ?>
                            <tr>
                                <td>
                                    Address:- <?php echo $res["address"];?>
                                    <br>
                                    <small>Date:-  <?php echo $res["date"];?></small>
                                    <div style="float:right;">
                                    <?php if($res["status"]!=0 && $res["status"]!=4 && $res["status"]!=1 ){?>

                                        <small>
                                            <a class="btn btn-sm btn-warning" >Widthdraw  </a>
                                        </small>|
                                         <?php }else if($res["status"]==0){?> 
                                         <small>
                                            <a class="btn btn-sm btn-danger">Close </a>
                                        </small>|
                                        <?php }?>
                                          <small>
                                            <a href="viewRequest.php?id=<?php echo $res['id']?>">View </a>
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
       
    </body>

    <script>

        $(document).ready(function(){
            $.ajax({
                url:'balance.php',
                type:'post',
                success:function(resp){
                       $('#coin').text(resp);
                }
            })
        })
    </script>
</html>
