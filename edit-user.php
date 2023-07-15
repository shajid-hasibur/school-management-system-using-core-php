<?php
$title = "Edit User Data";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('authentication.php');
include('configuration/connection.php');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">Update User Data</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Update User</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>

	    <div class="container-fluid">
	    	<div class="row">
	    		<div class="col-lg-12">
	    			<div class="card">
	    				<div class="card-header bg-dark">
	    					<h3 class="card-title">Update Registered User</h3>
							<a href="registration.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	    				</div>
	    				<div class="card-body">
	    					
	    					<?php
	    						if (isset($_GET['user_id'])) {
	    							$user_id = $_GET['user_id'];

	    							$query = "SELECT * FROM users WHERE id='$user_id'";
	    							$query_run = mysqli_query($conn,$query);
	    							
	    							if (mysqli_num_rows($query_run) > 0) {
	    								foreach($query_run as $value){
	    									$user_id = $value['id'];
	    									$name = $value['name'];
	    									$phone = $value['phone'];
	    									$email = $value['email'];
	    								}
	    							}else{
	    								echo "No records found";
	    							}
	    						}
	    					?>
	    					<div class="row">
	    						<div class="col-md-6">
	    							<form action="user-update-code.php" method="POST">
	    								<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
		    							<div class="form-group">
		    								<label>Name</label>
		    								<input type="text" name="name" value="<?php echo $name ?>" class="form-control" placeholder="Enter Name">
		    							</div>
		    							<div class="form-group">
		    								<label>Phone</label>
		    								<input type="text" name="phone" value="<?php echo $phone ?>" class="form-control" placeholder="Enter Phone">
		    							</div>
		    							<div class="form-group">
		    								<label>Email</label>
		    								<input type="email" name="email" value="<?php echo $email ?>" class="form-control" placeholder="Enter Email">
		    							</div>
		    							<div class="form-group">
		    								<label>Password</label>
		    								<input type="password" name="password" class="form-control" placeholder="Enter Password">
		    							</div>
		    							<div class="form-group">
		    								<label>Confirm Password</label>
		    								<input type="password" name="cpassword" class="form-control" placeholder="Enter confirm password">
		    								<?php
		    									if (isset($_SESSION['unmatch_pass'])) {
		    										?>
		    											<span style="font-size:14px;color:red;"><?php echo $_SESSION['unmatch_pass']; ?></span>
		    										<?php
		    										unset($_SESSION['unmatch_pass']);
		    									}
		    								?>
		    							</div>
		    							<div class="form-group">
		    								<button class="btn btn-primary btn-outline-light" type="submit" name="update-btn">Update</button>
		    							</div>
	    							</form>
	    						</div>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>	
</div>	

<?php
include('includes/footer.php');
?>
<?php 
include('includes/script.php');
?>