<?php
  session_start();
  include('configuration/connection.php');
  
  if (isset($_SESSION['auth'])) {
      $_SESSION['status-logged'] = "You are already logged in";
      header('location: dashboard.php');
  }
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<section class="vh-100 gradient-custom" style="background-color:white;">

  <div class="container py-5 h-100" >
    <div class="row d-flex justify-content-center align-items-center h-100">
             
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <?php
          include('message.php');
        ?>
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-4">
             
            <div class="mb-md-5 mt-md-4">
                <form action="login_code.php" method="POST">
                  <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                  <p class="text-white-50 mb-3">Please enter your login and password!</p>
                          <?php
                            if (isset($_SESSION['status'])) {
                              ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['status']?></span>
                              <?php
                              unset($_SESSION['status']);
                            }
                            if (isset($_SESSION['auth_status'])) {
                              ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['auth_status']?></span>
                              <?php
                              unset($_SESSION['auth_status']);
                            }            
                          ?>
                         <!--  <?php
                                  
                          ?> -->

                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="typeEmailX">Email</label>
                    <input type="email" id="typeEmailX" name="email" class="form-control form-control-md" />
                  </div>

                  <div class="form-outline form-white mb-4">
                    <label class="form-label" for="typePasswordX">Password</label>
                    <input type="password" id="typePasswordX" name="password" class="form-control form-control-md" />
                  </div>

                  <p class="small  pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                  <button class="btn btn-outline-light px-5" name="login_btn" type="submit">Login</button>
             </form> 
                  <div class="d-flex justify-content-center text-center mt-4 pt-1">
                    <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                    <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                  </div>
                 
            </div>

            <!-- <div>
              <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div> -->

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
include('includes/script.php');

?>