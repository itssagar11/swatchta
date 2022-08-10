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
                            <input class="form-control" id="inputUsername" type="text" placeholder="Title" >
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Amount</label>
                                <input class="form-control" id="inputFirstName" type="number" placeholder="amount" >
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Coins</label>
                                <input class="form-control" id="inputLastName" type="text" placeholder="coins">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                        
                                <label class="small mb-1" for="inputOrgName">Description</label>
                                <textarea class="form-control" id="inputOrgName" rows="10" type="text" placeholder="Enter your organization name" value="Start Bootstrap"></textarea>
                  
                            </div>
                        <!-- Form Row-->
                       
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="button">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    </main>
   
</div>