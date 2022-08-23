<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>  Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor-user/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css-user/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-light">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name"
                                            placeholder="Full Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="house"
                                            placeholder="House No">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="address"
                                        placeholder="Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="tel" class="form-control form-control-user"
                                            id="mobile" placeholder="Mobile no">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="pass" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <?php
                                                            if(isset($_GET['refer'])){

                                                           
                                                        
                                                        ?>
                                        <input type="tel" class="form-control form-control-user"
                                            id="refer" placeholder="Refer Code">
                                            <?php }else{?>
                                                <input type="tel" class="form-control form-control-user"
                                            id="refer" placeholder="Refer Code">
                                                <?php }?>
                                    </div>
                                    
                                </div>
                                <a  class="btn btn-primary btn-user btn-block" onclick="create()">
                                    Register Account
                                </a>
                                <hr>
                             
                            </form>
                            <hr>
                            <div class="text-center">
                                
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor-user/jquery/jquery.min.js"></script>
    <script src="vendor-user/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor-user/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js-user/sb-admin-2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

</body>
<script> 
    function create(){
  
        name=$('#name').val();
        house=$('#house').val();
        address=$('#address').val();
        mobile=$('#mobile').val();
        pass=$('#pass').val();
        refer=$('#refer').val();
    console.log(name,house,address,mobile,pass,refer)
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