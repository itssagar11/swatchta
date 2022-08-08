<html>
    <?php require_once("config/head.php")?>

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
            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
            <label class="form-check-label" for="form2Example31"> Remember me </label>
        </div>
        </div>

        <div class="col">
        <!-- Simple link -->
        <a href="#!">Forgot password?</a>
        </div>
    </div>

    <!-- Submit button -->
    <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button>

    <!-- Register buttons -->
    <div class="text-center">
        <p>Not a member? <a href="#!">Register</a></p>
        
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

                    }else if(res==3){
                        window.location.href="home.php";
                    }else if(res==2){
                        window.location.href="employee.php";
                    }
                }
            })
        })

    </script>
</html>