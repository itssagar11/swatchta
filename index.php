

<!-- Copyright (c) 2021 Sagar Bisht  -->

<!-- --- ----- ----- --- -- - - - -- - -- - -->
<!doctype>
<html>
  <head>
     <meta data-rh="true" name="theme-color" content="#000000" />
     <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@362&display=swap"
      rel="stylesheet"
    />
    <meta
      name="viewport"
      content="width=device-width,minimum-scale=1,initial-scale=1"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <title> Swatchta-SignIn</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <style>

      body{
        margin:10px;
        display:flex;
         font-family: "Rubik", sans-serif;
        justify-content:space-around;
        align-items:center;
        flex-wrap:wrap;
        
      }
      .form-container{
        margin:20px;
        
        width:400px;
      }
      .branding{
        width:350px;
      }
      input{
        margin:15px 1px 15px 1px;
        width:95%;
        height:30px;
        padding:2px 2px;
        border:none;
        border-bottom:1px solid #878787;
        
        
       
      }
      input[type=button]{
        background-color:#00A14D;
        border:1px solid #00A14D;
        color:#ffffff;
        padding:10px;
        width:80%;
        border-radius:20px;
        fot-size:16px;
        font-width:normal;
      }
      input:focus{
        outline:none;
        width:96%;
      }
      hr{
        width:10%;
        height:3px;
        background-color:#FCA435;
        border:none;
      }
      .quotes{
        color:#FCA435;
        font-size:2rem;
      }
      .otp_box{
        display:none;
      }
    
    </style>
  </head>
  <body>
    <div class="form-container">
         <center>
      <h1 style="color:#FCA435">
        Sign in 
      </h1>
  <p style="color:#FCA435">
        Enter the Mobile Number and Password associated with your account.
      </p>
            <!-- Login -->
            <input type="tel" class="textbox login_box" id="no" name="txt_user" placeholder="Mobile Number" /><br>
        
            <input type="Password" class="textbox login_box" id="pass"  name="txt_pwd" placeholder="Password"/><br>
        
            <input type="button" value="LOG IN" name="but_submit" id="but_submit"  class="login_box btn-block"/>
           <br> <span>or</span><br>
           <a href="registor.php" style="color:FCA435;">Create an account</a>
            <small id="message"></small>
        
</center> 
    </div>
    <div class="branding">
      <center>
      <hr>
      <img src="images/logo1.png" width="250px">
      <h3 class="quotes">
      
      </h3>
  
        </center>
    </div>
  </body>
 
</html>

    <script>
        $(".btn-block").click(function(){
            $("#message").html("<br><span style='color:#15c18b;'>Please wait..</span>");
            let no= $("#no").val();
            let pass=$("#pass").val();
            $.ajax({
                url:"login.php",
                type:"POST",
                data:{no:no,pass:pass},
                success:function(res){
                    $("#message").html("");
                    if(res==0){
                        Swal.fire({
  position: 'top-end',
  icon: 'error',
  title: 'Invalid credentials',
  showConfirmButton: false,
  timer: 1500
})
                    }else if(res==3){
                        window.location.href="home.php";
                    }else if(res==2){
                        window.location.href="employee.php";
                    }else if(res==1){
                        window.location.href="admin/deshboard.php";
                    }
                }
            })
        })

    </script>
</html>