<?php require_once("header.php") ?>
<div id="layoutSidenav_content">

    <main>
        <h1 class="mt-4">Coupans</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">coupans</li>
        </ol>
        <div class="container">
            <a href="newcoupan.php" class="btn btn-success"style="float:right">New Coupan</a>
          <table class="table">
            <thead>
                <td>Featured </td>
                <td>Amount</td>
                <td>For</td>
                <td>Coins</td>
                <td>Action</td>
            </thead>
            <tr>
        
                <td><img src="../images/garbage.jpg" width="40px" height="40px"></td>
                <td>100</td>
                <td>Water Bill </td>
                <td>100</td>
                <td><a href="#">delete</a>|<a href="#">Update</a></td>
            </tr>
          </table>
        </div>


    </main>
    <?php require_once("footer.php") ?>
</div>
