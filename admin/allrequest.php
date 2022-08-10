<?php require_once("header.php") ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pending Request</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pending Request</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Request that are in pending need to take action in within 24hrs.
                            </div>
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
                                            <th>Name</th>
                                            
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                        <tr>
                                            <td>10 MAy 2022</td>
                                            <td>Sagar Bisht</td>
                                           
                                            <td>9296784567</td>
                                            <td>124 Doiwala Dehradun Uttarakhand 248140</td>
                                            <td><span class="label label-default">Default Label</span></td>
                                            <td><a href="viewRequest.php">view</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>