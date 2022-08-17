<?php require_once('userHeader.php') ?>
<div id="layoutSidenav_content">
    <main>

    <div class="container">
        <h2>
            Rewards 
        </h2>
        <div style="display:flex;">

        <?php 
       
        $sql="SELECT * FROM  coupan ";
        $res=mysqli_query($conn,$sql);
        if(!$res){
            echo mysqli_error($conn);
        }else{
            while($row=mysqli_fetch_assoc($res)){

        
        ?>
        <div class="card" style="width: 18rem;">
  <img src="images/coupanbg.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['title']?> Get <span>Rs <?php echo $row['amount']?> oFF</span></h5><h6> Get it for <?php echo $row['coins']?> coins</h6>
    <small><?php echo $row['description']?></small><br>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <?php }}?>
</div>
    </div>

    </div>
    </main>
</div>