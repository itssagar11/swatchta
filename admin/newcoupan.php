<?php require_once("header.php") ?>
<div id="layoutSidenav_content">

    <main>


        <div class="container-xl px-4 mt-4">

    <hr class="mt-0 mb-4">
  
        <div >
            <!-- Account details card-->
            <div class="card">
                <div class="card-header">New Coupan</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Title (Coupan applicable for)</label>
                            <input class="form-control"  type="text"id="title" type="text" placeholder="Title" >
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Amount</label>
                                <input class="form-control" type="number"id="amount" type="number" placeholder="amount" >
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Coins</label>
                                <input class="form-control" type="number" id="coins" type="text" placeholder="coins">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                        
                                <label class="small mb-1" for="inputOrgName">Description</label>
                                <textarea class="form-control" id="description" rows="10" type="text" placeholder="Enter your organization name" value="Start Bootstrap"></textarea>
                  
                            </div>
                        <!-- Form Row-->
                       
                        <!-- Save changes button-->
                        <button class="btn btn-primary" id="add" type="button">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    </main>
   
</div>
<script>
    $("#add").click(function(){
        let title=$("#title").val();
        let amount=$("#amount").val();
        let coins=$("#coins").val();
        let description=$("#description").val();
       $.ajax({
        url:"controller/addCoupan.php",
        type:"post",
        data:{title:title,amount:amount,coins:coins,description:description},
        success:function(resp){
            if(resp==1){
                Swal.fire({
        position:'top-end',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1000
      })
      setTimeout(function(){
        window.location.href="coupan.php";
      }, 1000)
            }
        }
       });



    });
</script>