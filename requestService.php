<?php
require_once("config/connection.php");
session_start();

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


<!DOCTYPE html>
<html>
<?php require_once("config/head.php") ?>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script type="text/javascript" src="webcamjs/webcam.min.js"></script>

<style>
  * {
    box-sizing: border-box;
  }

  body {
    background-color: #f1f1f1;
  }

  #regForm {
    background-color: #ffffff;
    margin: 100px auto;
    font-family: Raleway;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  }

  h1 {
    text-align: center;
  }

  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
  }

  button {
    background-color: #04AA6D;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
  }

  button:hover {
    opacity: 0.8;
  }

  #prevBtn {
    background-color: #bbbbbb;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #04AA6D;
  }

  .ss,
  .rt {
    display: none;
  }

  .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
  }

  #map {
    height: 400px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
  }

  /* Safari */
  @-webkit-keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>

<body>

  <div id="regForm">

    <!-- One "tab" for each step in the form: -->
    <div class="tab" id="imageupload">Image:
      <p>
      <div id="my_camera"></div>
      </p>
      <p><input type=button class="btn btn-sm btn-primary form-control tt" style="width:100px;" value="Take Snapshot" onClick="take_snapshot()"> <input type=button class="btn btn-sm btn-primary form-control rt" style="width:100px;" value="Retake" onClick="retake()"><input type=button class="btn btn-sm btn-primary form-control ss" style="width:100px;" value="Upload" onClick="saveSnap()"></p>
    </div>
    <div class="tab">address Info:
      <p><input placeholder="Address" oninput="this.className = ''" id="addr" name="address" onchange="getCoodinates()" disabled></p>
      <div id="map"></div>

    </div>
    <div class="tab">Description:<br>

      <textarea oninput="this.className = ''" rows="10" cols="100" name="yyyy"></textarea>
    </div>
    <div class="tab">Contact Info:
      <p><input type="tel" placeholder="Contact Number..." oninput="this.className = ''" id="contact"></p>

    </div>
    <div style="overflow:auto;">
      <div style="float:right;">
        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" id="nextBtn" style="display:none;" onclick="nextPrev(1)">Next</button>
        <button type="button" id="submitBtn" style="display:none;">Submit</button>
      </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
  </div>

  <script>
    let address;
    let contact;
    let lat;
    let lon;
    let desc;
    let img;
    $(document).ready(function() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getCoodinates);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
      console.log("sd");
    })

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
      width: 320,
      height: 240,
      image_format: 'jpeg',
      jpeg_quality: 90
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
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
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
        
            alert("Your Request Has been Registered ");
            window.location.href = "home.php"
        }
      })
    })
  </script>

  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM&callback=initMap">
  </script>
  <?php require_once("config/common_script.php") ?>


</body>

</html>