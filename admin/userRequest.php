<?php require_once("header.php") ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">User Request</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        <div class="card mb-4">
                         
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table "></i>
                             Pending request
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Address</th>
                                            
                                            <th>Contact</th>
                                            <th>status</th>
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
                <script>
      $(document).ready(function(){
        id=<?php echo $_GET['id']?> ;
        $.ajax({
           
            url:'controller/viewUserRequest.php',
            type:'post',
            data:{id:id},
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
                                <td>`;
                                if(item['status']==1){
                                    html+=`New Request`
                                }else if(item['status']==0){
                                    html+=`Discart Request`
                                }else if(item['status']==2){
                                    html+=`Allocated`
                                }else if(item['status']==4){
                                    html+=`Completed`
                                }else if(item['status']==3){
                                    html+=`Assigned`
                                }
                                html+= `</td>
                                <td><a href="viewRequest.php?id=${item['id']}">View</a></td>
                                
                            </tr>`
               }
               $("#newReq").append(html);
            }
        })
    })
                </script>