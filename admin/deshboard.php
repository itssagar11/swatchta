<?php require_once("header.php") ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Pending Request</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Active Employee</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Users</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Danger Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Request
                        </div>
                        <div class="card-body">
                            <div id="requestChart" width="100%" height="40"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Active Employee
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">Active Employee 1</li>
                                <li class="list-group-item">Active Employee 2</li>
                                <li class="list-group-item">Active Employee 3</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    New Request
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Action</th>
                               
                            </tr>
                        </thead>
                       
                        <tbody>
                           
                            <tr>
                                <td>Shad Decker</td>
                                <td>Jaiswal Market Doiwala Dehradun</td>
                                <td>9878364728</td>
                                <td><a href="viewRequest.php">View</a></td>
                                
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
   <?php require_once("footer.php")?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(requestChart);

    function requestChart() {

        var data = google.visualization.arrayToDataTable([
            ['status', 'count'],
            ['pending ', 11],
            ['complete ', 2],
            ['withdraw ', 2],
            ['disapprove', 2],
            ['assigned', 7]
        ]);

        var options = {
            title: 'Request Status'
        };

        var chart = new google.visualization.PieChart(document.getElementById('requestChart'));

        chart.draw(data, options);
    }
</script>
</body>

</html>