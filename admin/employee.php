<?php require_once("header.php") ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Employees</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Employee</li>
            </ol>
            <a href="newEmp.php" class="btn bnt-primary btn-success">Add New Employee</a>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table "></i>
                    Employees
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>

                                <th>Name</th>

                                <th>Service Area </th>
                                <th>last_location</th>
                                <th>Balance</th>
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
        $(document).ready(function() {
            $.ajax({
                url: 'controller/FetchEmployee.php?com=1',
                type: 'get',
                success: function(resp) {
                    obj = JSON.parse(resp);
                    console.log(obj);
                    let html = "";
                    for (item of obj) {
                        // console.log(item['']);
                        html += ` <tr>
                                <td>${item['name']}</td>
                                <td>${item['root']}</td>
                                <td>${item['last_location']}</td>
                                <td>${item['balance']} <button class="btn btn-success btn-sm" id="addbal" value =${item['id']} onclick="addBal('${item['id']}')" >Add balance</button></td>
                                <td><a href="EmployeeReport.php?id=${item['id']}">View Repert</a></td>
                                
                            </tr>`
                    }
                    $("#newReq").append(html);
                }
            })


        })


        function addBal(val) {
            // console.log(val);
            Swal.fire({
                title: 'Enter Credits',
                input: 'number',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Add',
                showLoaderOnConfirm: true,
                preConfirm: (amount) => {
                    return fetch(`controller/addamount.php?id=${val}&amount=${amount}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            let x = response.json()
                            
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Amount Added Successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                setInterval(function(){
                                    location.reload();
                                },1520);
                                
                            
                }
            })
        }
    </script>