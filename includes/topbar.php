<?php
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath.'/PHP_SCHOOL/sms/admin/authentication.php');
?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light bg-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/PHP_SCHOOL/sms/admin/dashboard.php" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php
              if (isset($_SESSION['auth'])) {
                echo $_SESSION['auth_user']['user_name'];
              }
            ?>
              
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Profile</a>
              <form action="/PHP_SCHOOL/sms/admin/logout.php" method="POST">
                  <button type="submit" name="logout_btn" class="dropdown-item">Sign Out</button>
              </form>
            </div>
        </div>
      </li>
    </ul>
  </nav>