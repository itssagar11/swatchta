<?php
require_once("userHeader.php");
if (!isset($_SESSION["login_user"])) {
    echo "<b> Access Denied<b>";
    print_r($_SESSION["login_user"] . "S");
    die();
    return;
  }
  $user = $_SESSION["login_user"];
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $lat = $_POST["lat"];
    $long = $_POST["lon"];
    $img = $_POST["img"];
    $id = $user["id"];
    $desc = $_POST["desc"];
    $sql = "INSERT into service(contact,citizen_id,address,latt,lon,image,status,description) VALUES ('$contact','$id','$address','$lat','$long','$img','1','$desc')";
    if (mysqli_query($conn, $sql)) {
      echo "1";
    } else {
      echo mysqli_errno($conn);
    }
  }
  
  
?>
<script type="text/javascript" src="webcamjs/webcam.min.js"></script>
<style>
    * {
    margin: 0;
    padding: 0
}

html {
    height: 100%
}

p {
    color: grey
}

#heading {
    text-transform: uppercase;
    color: #138808;
    font-weight: normal
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

.form-card {
    text-align: left
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform input,
#msform textarea {
    padding: 8px 15px 8px 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    background-color: #ECEFF1;
    font-size: 16px;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #FF9933;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: #FF9933;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right
}

#msform .action-button:hover,
#msform .action-button:focus {
    background-color: #311B92
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    background-color: #000000
}

.card {
    z-index: 0;
    border: none;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #FF9933;
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left
}

.purple-text {
    color: #FF9933;
    font-weight: normal
}

.steps {
    font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right
}

.fieldlabels {
    color: gray;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #138808
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f13e"
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007"
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f030"
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #138808
}

.progress {
    height: 20px
}

.progress-bar {
    background-color: #FF9933
}

.fit-image {
    width: 100%;
    object-fit: cover
}
.ss,
  .rt {
    display: none;
  }
#map {
    height: 400px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
  }
  #my_camera{
    width: 100%;
    height: 100%;
  }
</style>
<div id="layoutSidenav_content">
  <main>
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">Schedule A Pickup </h2>
                <p>Fill all form field to go to next step</p>
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Image</strong></li>
                        <li id="personal"><strong>Personal</strong></li>
                        <li id="payment"><strong>Image</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="fs-title">Capture Image:</h3>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 4</h2>
                                </div>
                            </div> 

                            <div class="tab" id="imageupload" style="display:none;"></div>
                            <div id="my_camera"></div>
                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Personal Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">First Name: *</label> <input type="text" name="fname" placeholder="First Name" /> <label class="fieldlabels">Last Name: *</label> <input type="text" name="lname" placeholder="Last Name" /> <label class="fieldlabels">Contact No.: *</label> <input type="text" name="phno" placeholder="Contact No." /> <label class="fieldlabels">Alternate Contact No.: *</label> <input type="text" name="phno_2" placeholder="Alternate Contact No." />
                        </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Image Upload:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 3 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Upload Your Photo:</label> <input type="file" name="pic" accept="image/*"> <label class="fieldlabels">Upload Signature Photo:</label> <input type="file" name="pic" accept="image/*">
                        </div> <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 4</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
  </main>
</div>
<script>
      let address;
  let contact;
  let lat;
  let lon;
  let desc;
  let img;
    $(document).ready(function(){
        if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(getCoodinates);
    } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(++current);
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});










function getCoodinates(position) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;

    const geocodingUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lon}&key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM`;
    fetch(geocodingUrl)
      .then(response => response.json())
      .then(data => {
        address = data.results[0].formatted_address;
        console.log(data.results[0].formatted_address);
        $("#addr").val(address);
        var lattlong = new google.maps.LatLng(lat, lon);
        var myOptions = {
          center: lattlong,
          zoom: 15,
          mapTypeControl: true,
          navigationControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL
          }
        }
        var maps = new google.maps.Map(document.getElementById("map"), myOptions);
        var markers =
          new google.maps.Marker({
            position: lattlong,
            map: maps,
            title: "You are here!"
          });

      })
  }







  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab
  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false
        valid = false;
      }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  function showTab(n) {

    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").style.display = "none";
      document.getElementById("submitBtn").style.display = "inline-block";

    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }

  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      document.getElementById("regForm").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }




  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }




  //  webcam
  Webcam.set({
    width: 420,
    height: 440,
    image_format: 'jpeg',
    jpeg_quality: 100,
    align:'center',
    constraints: {
   facingMode: 'environment'
    }
  });
  Webcam.attach('#my_camera');

  function take_snapshot() {

    // take snapshot and get image data
    Webcam.snap(function(data_uri) {
      // display results in page
      document.getElementById('my_camera').innerHTML =
        '<img  id="imageprev" src="' + data_uri + '"/>';
    });

    $(".rt").css("display", "inline-block");
    $(".ss").css("display", "inline-block");

  }

  function retake() {
    document.getElementById('my_camera').innerHTML = "";
    Webcam.set({
      width: 420,
      height: 440,
      image_format: 'jpeg',
      jpeg_quality: 90,
      align:'center',
      constraints: {
   facingMode: 'environment'
 }
    });
    Webcam.attach('#my_camera');


    $(".rt").css("display", "none");
    $(".ss").css("display", "none");
  }

  function saveSnap() {
    $(".ss").val("Please wait..")

    $(".rt").css("display", "none");
    $(".tt").css("display", "none");

    // Get base64 value from <img id='imageprev'> source
    var base64image = document.getElementById("imageprev").src;
    console.log(base64image)
    Webcam.upload(base64image, 'config/image_upload.php', function(code, text) {
      console.log('Save successfully');
      image = text;
      $(".ss").val("uploaded");
      $("#nextBtn").css("display", "block")
    });
  }


  $("#submitBtn").click(function() {
    contact = $("#contact").val();
    desc = "d";
    $.ajax({
      url: "requestService.php",
      type: "POST",
      data: {
        address: address,
        lat: lat,
        lon: lon,
        img: image,
        contact: contact,
        desc: desc
      },
      success: function(res) {

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Your request has been register',
          showConfirmButton: false,
          timer: 1500
        })
         setTimeout(function() {
          window.location.href = "home.php"
        }, 1510)

      }
    })
  })
</script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap">
  </script>
<?php require_once("config/common_script.php") ?>  
    
