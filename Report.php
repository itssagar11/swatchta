<?php
require_once('header.php');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <h1 class="mt-4">Report</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="employee.php">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Today Pickups</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Pending</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="widthdraw-tab" data-bs-toggle="tab" data-bs-target="#widthdraw" type="button" role="tab" aria-controls="widthdraw" aria-selected="false">Widthdraw</button>
  </li>
 
  
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete" type="button" role="tab" aria-controls="complete" aria-selected="false">complete</button>
  </li>
  
</ul>
            <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-responsive">
                                <?php

                                $id = $_SESSION["login_user"]["id"];
                                $sql1 = "SELECT * FROM `service` where allocated_to='$id' and status=3";
                                if (!$result = mysqli_query($conn, $sql1)) {
                                    echo mysqli_errno($conn);
                                } else {
                                    while ($res = mysqli_fetch_assoc($result)) {



                                ?>
                                        <tr>
                                            <td>
                                                Address:- <?php echo $res["address"]; ?>
                                                <br>
                                                <small>Date:- <?php echo $res["date"]; ?></small>
                                                <div style="float:right;">
                                                    <?php if ($res["status"] == 1 && $res["status"] == 2 ) { ?>

                                                        <small>
                                                            <a class="btn btn-sm btn-warning" href="widraw.php?id=<?php echo  $res["status"]  ?>">Widthdraw </a>
                                                        </small>|
                                                    <?php } else if ($res["status"] == 0) { ?>
                                                        <small>
                                                            <a class="btn btn-sm btn-danger">Widthdraw </a>
                                                        </small>
                                                    <?php }else{ ?>
                                                    <small>
                                                        <a href="EmpAction.php?id=<?php echo $res['id'] ?>"> View </a>
                                                    </small>
                                                    <?php }?>
                                                </div>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </table>



            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-responsive">
                                <?php

                                $id = $_SESSION["login_user"]["id"];
                                $sql1 = "SELECT * FROM `service` where allocated_to='$id' and status=1";
                                if (!$result = mysqli_query($conn, $sql1)) {
                                    echo mysqli_errno($conn);
                                } else {
                                    while ($res = mysqli_fetch_assoc($result)) {



                                ?>
                                        <tr>
                                            <td>
                                                Address:- <?php echo $res["address"]; ?>
                                                <br>
                                                <small>Date:- <?php echo $res["date"]; ?></small>
                                                <div style="float:right;">
                                                    <?php if ($res["status"] == 1 && $res["status"] == 2 ) { ?>

                                                        <small>
                                                            <a class="btn btn-sm btn-warning" href="widraw.php?id=<?php echo  $res["status"]  ?>">Widthdraw </a>
                                                        </small>|
                                                    <?php } else if ($res["status"] == 0) { ?>
                                                        <small>
                                                            <a class="btn btn-sm btn-danger">Widthdraw </a>
                                                        </small>
                                                    <?php }else{ ?>
                                                    <small>
                                                        <a href="EmpAction.php?id=<?php echo $res['id'] ?>"> View </a>
                                                    </small>
                                                    <?php }?>
                                                </div>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </table>

            
            </div>
            <div class="tab-pane fade" id="widthdraw" role="tabpanel" aria-labelledby="widthdraw-tab">
            <table class="table table-responsive">
                                <?php
                                $id = $_SESSION["login_user"]["id"];
                                $sql1 = "SELECT * FROM `service` where allocated_to='$id' and status=0";
                                if (!$result = mysqli_query($conn, $sql1)) {
                                    echo mysqli_errno($conn);
                                } else {
                                    while ($res = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td>
                                                Address:- <?php echo $res["address"]; ?>
                                                <br>
                                                <small>Date:- <?php echo $res["date"]; ?></small>
                                                <div style="float:right;">
                                                    <?php if ($res["status"] == 1 && $res["status"] == 2 ) { ?>

                                                        <small>
                                                            <a class="btn btn-sm btn-warning" href="widraw.php?id=<?php echo  $res["status"]  ?>">Widthdraw </a>
                                                        </small>|
                                                    <?php } else if ($res["status"] == 0) { ?>
                                                        <small>
                                                            <a class="btn btn-sm btn-danger">Widthdraw </a>
                                                        </small>
                                                    <?php }else{ ?>
                                                    <small>
                                                        <a href="EmpAction.php?id=<?php echo $res['id'] ?>"> View </a>
                                                    </small>
                                                    <?php }?>
                                                </div>
                                            </td>

                                        </tr>
                                <?php }
                                } ?>
                            </table>
                                
            </div>
            
            <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">
            <table class="table table-responsive">
                                <?php

                                $id = $_SESSION["login_user"]["id"];
                                $sql1 = "SELECT * FROM `service` where allocated_to='$id' and status=4";
                                if (!$result = mysqli_query($conn, $sql1)) {
                                    echo mysqli_errno($conn);
                                } else {
                                    while ($res = mysqli_fetch_assoc($result)) {



                                ?>
                                        <tr>
                                            <td>
                                                Address:- <?php echo $res["address"]; ?>
                                                <br>
                                                <small>Date:- <?php echo $res["date"]; ?></small>
                                                <div style="float:right;">
                                                    <?php if ($res["status"] == 1 && $res["status"] == 2 ) { ?>

                                                        <small>
                                                            <a class="btn btn-sm btn-warning" href="widraw.php?id=<?php echo  $res["status"]  ?>">Widthdraw </a>
                                                        </small>|
                                                    <?php } else if ($res["status"] == 0) { ?>
                                                        <small>
                                                            <a class="btn btn-sm btn-danger">Widthdraw </a>
                                                        </small>
                                                    <?php }else{ ?>
                                                    <small>
                                                        <a href="EmpAction.php?id=<?php echo $res['id'] ?>"> View </a>
                                                    </small>
                                                    <?php }?>
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
</div>