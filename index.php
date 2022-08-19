<html>
    <?php require_once("config/head.php")?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
    <body>
        <div class="container" style="width:350px; margin-top:10%;">
            <form>
    <!-- mobile input -->
    <div class="form-outline mb-4">
    <label class="form-label" for="form2Example1">Mobile No</label>
        <input type="email" id="mobile_no" class="form-control" />
        
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
    <label class="form-label" for="form2Example2">Password</label>
        <input type="password" id="password" class="form-control" />
    
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
        <!-- Checkbox -->
        <div class="form-check">
           <br>
        </div>
        </div>

        <div class="col">
        <!-- Simple link -->
      
        </div>
    </div>

    <!-- Submit button -->
    <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button>

    <!-- Register buttons -->
    <div class="text-center">
        <p>Dont have account? <a href="register.php">Register</a></p>
        
    </div>
    </form>
        </div>
   
    </body>


    <script>
        $(".btn-block").click(function(){
            let no= $("#mobile_no").val();
            let pass=$("#password").val();
            $.ajax({
                url:"login.php",
                type:"POST",
                data:{no:no,pass:pass},
                success:function(res){
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