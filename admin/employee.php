<?php require_once("header.php") ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Employees</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
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
                                       
                                            <th>Name</th>
                                            
                                            <th>Service Area </th>
                                            <th>last_location</th>
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
        $.ajax({
            url:'controller/FetchEmployee.php?com=1',
            type:'get',
            success:function(resp){
               obj=JSON.parse(resp);
            console.log(obj);
               let html="";
               for( item of obj){
                // console.log(item['']);
                html+=` <tr>
                                <td>${item['Full_name']}</td>
                                <td>${item['root']}</td>
                                <td>${item['last_location']}</td>
                              
                                <td><a href="userRequest.php?id=${item['id']}">View All Request</a></td>
                                
                            </tr>`
               }
               $("#newReq").append(html);
            }
        })
    })
                </script>