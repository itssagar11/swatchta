<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                      
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  id="name"type="text" placeholder="Enter your name"  required/>
                                                        <label for="inputFirstName">Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" id="house" required placeholder="Enter your last name" />
                                                        <label for="inputLastName">House No</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" required id="address" />
                                                <label for="inputEmail">Address</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  id="mobile" required type="tel" placeholder="Create a password" />
                                                        <label for="inputPassword">Mobile no</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="password"id="pass" required placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm"> Password</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <?php
                                                            if(isset($_GET['refer'])){

                                                           
                                                        
                                                        ?>
                                                        <input class="form-control"  type="text" id="refer" value="<?php echo $_GET['refer']?>" placeholder="Create a password" disabled/>
                                                        <label for="inputPassword"> Refer Code</label>
                                                        <?php }else{?>
                                                            <input class="form-control" type="password" id="text" placeholder="Create a password" />
                                                        <label for="inputPassword">Have Refer Code</label>
                                                            <?php }?>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button onclick="create()" class="btn btn-primary btn-block" href="index.php">Create Account</button></div>
                                            </div>
                                        
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="index.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
               <?php  require_once('footer.php')?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </body>
    <script> 
    function create(){
  
        name=$('#name').val();
        house=$('#house').val();
        address=$('#address').val();
        mobile=$('#mobile').val();
        pass=$('#pass').val();
        refer=$('#refer').val();
    
        $.ajax({
            url:'registor_helper.php',
            type:'post',
            data:{
                name:name,
                house:house,
                address:address,
                mobile:mobile,
                pass:pass,
                refer:refer,
                

            },
            success:function(resp){
                    if(resp==1){
                        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'Your work has been saved',
  showConfirmButton: false,
  timer: 1500
})
setTimeout(function(){ window.location.href="index.php"},1520);
                    }
            }
        })
    }

</script>
</html>
