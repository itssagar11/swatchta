<?php
require_once("header.php");
$id = $_GET['id'];
?>
<style> 


button {
    background-color: #04AA6D;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
  }
  #imageprev{
    width: 450px;
    height:480px;
  }

  button:hover {
    opacity: 0.8;
  }

</style>
<script type="text/javascript" src="webcamjs/webcam.min.js"></script>
<div id="layoutSidenav_content">

    <main>
        <div id="my_camera"></div>
        <p><input type=button class="btn btn-sm btn-primary form-control tt" style="width:100px;" value="Take Snapshot" onClick="take_snapshot()"> <input type=button class="btn btn-sm btn-primary form-control rt" style="width:100px;" value="Retake" onClick="retake()"><input type=button class="btn btn-sm btn-primary form-control ss" style="width:100px;" value="Upload" onClick="saveSnap()"></p>
    </main>
</div>


<script>
    let lat;
    let lon;
    service_id=<?php echo $id?>;
    let address;
    let img;
    $(document).ready(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(getCoodinates);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        console.log("sd");
    });

    function getCoodinates(position) {
        lat = position.coords.latitude;
        lon = position.coords.longitude;
        const geocodingUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lon}&key=AIzaSyCdk0GkRdoCCpgU-T_rBFoU_CFPWB5KnBM`;
        fetch(geocodingUrl)
            .then(response => response.json())
            .then(data => {
                address = data.results[0].formatted_address;
            });
    }

    Webcam.set({
        width: 450,
        height: 480,
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
            width: 450,
            height: 480,
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
        img = text;
        $(".ss").val("uploaded");
        $("#nextBtn").css("display", "block");
        $.ajax({
            url:"completeReq.php",
            type:"post",
            data:{
                id:service_id,
                address:address,
                lat:lat,
                lon:lon,
                img:img
            },
            success:function(resp){
                if(resp==1){
                    window.location.href="employee.php";
                }
            }
        })
      });
    }

</script>