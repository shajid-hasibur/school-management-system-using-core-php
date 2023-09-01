<?php
$title = "Edit User Data";
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath . '/PHP_SCHOOL/sms/admin/authorisation.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/header.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/topbar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sidebar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sessions.php');
include($basePath . '/PHP_SCHOOL/sms/admin/authentication.php');
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/connection.php');
?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">Edit User Data</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Edit User</li>
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
	    					<h3 class="card-title">Edit Registered User</h3>
							<a href="users.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
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
											$usertype = $value['usertype'];
	    								}
	    							}else{
	    								echo "No records found";
	    							}
	    						}
	    					?>
	    					<div class="row">
	    						<div class="col-md-6">
	    							
	    						</div>
								<div class="card col-12">
									<div class="card-body mt-3 mb-3 d-flex justify-content-center align-items-center">
									<form action="user_code.php" method="POST">
	    								<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		    							<div class="form-row">
											<div class="form-group col-4">
												<label>Name</label>
												<input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter Name">
												<?php
													if (isset($_SESSION['name'])) {
														?>
															<span style="font-size:14px;color:red;"><?php echo $_SESSION['name']; ?></span>
														<?php
														unset($_SESSION['name']);
													}
												?>
											</div>
											<div class="form-group col-4">
												<label>Phone</label>
												<input type="text" name="phone" value="<?php echo $phone;?>" class="form-control" placeholder="Enter Phone">
												<?php
													if (isset($_SESSION['phone'])) {
														?>
															<span style="font-size:14px;color:red;"><?php echo $_SESSION['phone']; ?></span>
														<?php
														unset($_SESSION['phone']);
													}
												?>
											</div>
											<div class="form-group col-4">
												<label>Email</label>
												<input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter Email">
												<?php
													if (isset($_SESSION['email'])) {
														?>
															<span style="font-size:14px;color:red;"><?php echo $_SESSION['email']; ?></span>
														<?php
														unset($_SESSION['email']);
													}
												?>
											</div>
											<div class="form-group col-4">
												<label>Password</label>
												<input type="password" name="password" class="form-control" placeholder="Enter Password">
												<?php
													if (isset($_SESSION['password'])) {
														?>
															<span style="font-size:14px;color:red;"><?php echo $_SESSION['password']; ?></span>
														<?php
														unset($_SESSION['password']);
													}
												?>
											</div>
											<div class="form-group col-4">
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
												<?php
													if (isset($_SESSION['cpassword'])) {
														?>
															<span style="font-size:14px;color:red;"><?php echo $_SESSION['cpassword']; ?></span>
														<?php
														unset($_SESSION['cpassword']);
													}
												?>
												
											</div>
											<div class="form-group col-4">
												<label>Usertype</label>
												<select name="usertype" class="form-control">
													<option value="">Select Usertype</option>
													<option value="1" <?php if ($usertype === '1') echo 'selected'; ?>>Admin</option>
													<option value="2" <?php if ($usertype === '2') echo 'selected'; ?>>Employee</option>
												</select>
												<?php
													if (isset($_SESSION['usertype'])) {
														?>
															<span style="font-size:14px;color:red;"><?php echo $_SESSION['usertype']; ?></span>
														<?php
														unset($_SESSION['usertype']);
													}
												?>
											</div>
											<div class="form-group col-12">
												<button class="btn btn-success btn-block" type="submit" name="update-btn">Update</button>
											</div>
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
</div>	

<?php
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>
