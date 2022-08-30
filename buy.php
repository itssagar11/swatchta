<?php require_once('header-user.php') ?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
   
</div>
<div class="card-body">
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
    <button class="btn btn-primary" onclick="buy(<?php echo $row['coupan_id']?>)" value="<?php echo $row['coupan_id']?>">Buy It</button>
  </div>
  <?php }}?>
</div>
    </div>

    
</div>
</div>
<?php require_once("footer-user.php")?>
<script>

    let balance;
    $(document).ready(function(){
        var request = new XMLHttpRequest();
request.open('GET', 'balance.php');
request.send();
request.onload = ()=>{
    console.log(request.response);
    balance=request.response;
}
    })

    function buy(val){
  $.ajax({
    url:'buy_helper.php',
    type:'post',
    data:{id:val},
    success:function(resp){
        if(resp==-1){
            Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Insufficient Funds ',
  footer: 'Not enough balance'
})
        }else if(resp==1){
            Swal.fire({
  icon: 'success',
  title: 'Transection Completed',
  text: 'You earn a new Coupan',
  
})
window.location.href="reward.php";
        }
    }
  })
    }
</script>