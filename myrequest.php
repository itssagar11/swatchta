<?php
require_once('userHeader.php');
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container">
            <h1 class="mt-4">Request</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Request</li>
            </ol>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Assigned</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Pending</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="widthdraw-tab" data-bs-toggle="tab" data-bs-target="#widthdraw" type="button" role="tab" aria-controls="widthdraw" aria-selected="false">Widthdraw</button>
  </li>
 
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="discart-tab" data-bs-toggle="tab" data-bs-target="#discart" type="button" role="tab" aria-controls="discart" aria-selected="false">discart</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete" type="button" role="tab" aria-controls="complete" aria-selected="false">complete</button>
  </li>
  
</ul>
            <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">q</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">w</div>
            <div class="tab-pane fade" id="widthdraw" role="tabpanel" aria-labelledby="widthdraw-tab">ww</div>
            <div class="tab-pane fade" id="discart" role="tabpanel" aria-labelledby="discart-tab">discart</div>
            <div class="tab-pane fade" id="complete" role="tabpanel" aria-labelledby="complete-tab">ww</div>
            </div>
        </div>
    </main>
</div>