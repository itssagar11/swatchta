<?php require_once('header.php') ?>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    #myMap{
        width:100%;
        height:400px;
        
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="layoutSidenav_content">
    <main>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                <div class="card bg-primary text-white mb-4">
                        <div class="card-body">My Balance  
                        
                        
                        
                        <h2><?php echo $user['balance']  ?></h2></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Request
                    </div>
                    <div class="card-body">
                        <div id="donutchart" width="100%" height="80"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Share Location <small> &nbsp &nbsp <label class="switch">
                                <input type="checkbox" id="share" onchange="shareLoc()">
                                <span class="slider"></span>
                            </label></small>
                    </div>
                    <div class="card-body">
                        <div id="myMap" >

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                 Pickup Pending
            </div>

            <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Address</th>
                               
                              
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                       
                        <tbody id="newReq">
                        <?php
                                      $id=$user['id'];
                                      $sql="SELECT * FROM service where  allocated_to=$id and status=3";
                                      $res=mysqli_query($conn,$sql);
                                      if(!$res){
                                        echo mysqli_error($conn);
                                      }else{
                                        while($row=mysqli_fetch_assoc($res)){

                                      
                                      ?>
                                        <tr>
                                            <td><?php echo $row['date']?></td>
                                            <td><?php echo $row['address']?></td>
                                            <td><a href="EmpAction.php?id=<?php echo $row['id'] ?>">View </a></td>
                                        </tr>

                                <?php   }
                                      }?>
                           
                            
                        </tbody>
                    </table>

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

                        $id = $_SESSION["login_user"]["id"];
                        $sql1 = "Select * from service where allocated_to=$id and status=2 ";
                        if (!$result = mysqli_query($conn, $sql1)) {
                            echo mysqli_errno($conn);
                        } else {
                            while ($res = mysqli_fetch_assoc($result)) {



                        ?>
                                <tr>
                                    <td>
                                        Address:- <?php echo $res["address"]; ?>
                                        <br>
                                        <small>Date:- <?php echo $res["date"]; ?></small><br>

                                        Status:
                                        <?php if ($res["status"] == 0) { ?>
                                            <small>
                                                <a class="text-danger">Close </a>
                                            </small>
                                        <?php } else if ($res["status"] == 2) { ?>
                                            <small>
                                                <a class="text-success">Pending </a>
                                            </small>
                                        <?php } ?>
                                        <div style="float:right;">
                                            <small>
                                                <a href="EmpAction.php?id=<?php echo $res['id'] ?>">View </a>
                                            </small>
                                        </div>
                                    </td>

                                </tr>
                        <?php }
                        } ?>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <?php require_once('footer.php') ?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

</body>
<script>

function shareLoc(){
    // let val=document.getElementById("share"); 
    if($("#share").is(":checked")){
        flag=1;
    }else{
        flag=0;
    }
  
 
}
</script>
<?php require_once('setEmpLocation.php')?>
</html>