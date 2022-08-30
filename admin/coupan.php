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
                <td>id </td>
                <td>Amount</td>
                <td>For</td>
                <td>Coins</td>
                <td>Action</td>
            </thead>
            <tbody id="coupans">

            </tbody>
            <tr>
        
               
            </tr>
          </table>
        </div>


    </main>
    <?php require_once("footer.php") ?>
</div>
<script>
    $(document).ready(function(){
        $.ajax({
            url:"controller/fetchCoupan.php",
            type:"post",
            success:function(resp){
               let html;
               let obj=JSON.parse(resp);
               for(item of obj){
                html+=`
                <tr>
                <td>${item['coupan_id']}</td>
                <td>${item['amount']} </td>
                <td>${item['title']}</td>
                <td>${item['coins']}</td>
                <td><a href="controller/deleteCoupan.php?id=${item['coupan_id']}">delete</a>|<a href="editCoupan.php?id=${item['coupan_id']}">Update</a></td>
               </tr>
                `
               }
               $("#coupans").append(html);
            }
        })
    });


</script>