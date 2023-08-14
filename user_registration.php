<?php
$title = "User Registration";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('authentication.php');
?>

<div class="content-wrapper">
		<div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">User Registration Form</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item active">User Registration</li>
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
						<h1 class="card-title">Registration Form</h1>
						<a href="registration.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
					</div>
					<div class="card-body">
						<div class="card col-12">
							<div class="card-body mt-3 mb-3 d-flex justify-content-center align-items-center">
								<div class="">
									<form action="create_user.php" method="POST">
										<div class="form-row">
										<div class="form-group col-4">
											<label>Name</label>
											<input type="text" name="name" class="form-control" placeholder="Enter Name">	
											<?php
												if (isset($_SESSION['name'])) {
													?>
														<span style="font-size:14px;color:red;"><?php echo $_SESSION['name']?></span>
													<?php
													unset($_SESSION['name']);
												}
											?>
										</div>
										<div class="form-group col-4">
											<label>Phone</label>
											<input type="text" name="phone" class="form-control" placeholder="Enter Phone">
											<?php
												if (isset($_SESSION['phone'])) {
													?>
														<span style="font-size:14px;color:red;"><?php echo $_SESSION['phone']?></span>
													<?php
													unset($_SESSION['phone']);
												}
											?>
										</div>
										<div class="form-group col-4">
											<label>Email</label>
											<input type="email" name="email" class="form-control" placeholder="Enter Email">
											<?php
												if (isset($_SESSION['email'])) {
													?>
														<span style="font-size:14px;color:red;"><?php echo $_SESSION['email']?></span>
													<?php
													unset($_SESSION['email']);
												}
											?>
											<?php
												if (isset($_SESSION['existing_mail'])) {
													?>
														<span style="font-size:14px;color:red;"><?php echo $_SESSION['existing_mail']?></span>
													<?php
													unset($_SESSION['existing_mail']);
												}
											?>
										</div>
										<div class="form-group col-4">
											<label>Password</label>
											<input type="password" name="password" class="form-control" placeholder="Enter Password">
											<?php
												if (isset($_SESSION['password'])) {
													?>
														<span style="font-size:14px;color:red;"><?php echo $_SESSION['password']?></span>
													<?php
													unset($_SESSION['password']);
												}
											?>
										</div>
										<div class="form-group col-4">
											<label>Confirm Password</label>
											<input type="password" name="cpassword" class="form-control" placeholder="Enter confirm Password">
											<?php
												if (isset($_SESSION['unmatch_pass'])) {
													?>
														<span style="font-size:14px;color:red;"><?php echo $_SESSION['unmatch_pass']?></span>
													<?php
													unset($_SESSION['unmatch_pass']);
												}
											?>
											<?php
												if (isset($_SESSION['cpassword'])) {
													?>
														<span style="font-size:14px;color:red;"><?php echo $_SESSION['cpassword']?></span>
													<?php
													unset($_SESSION['cpassword']);
												}
											?>
										</div>
										<div class="form-group col-4">
											<label>Usertype</label>
											<select name="usertype" class="form-control">
												<option value="">Select Usertype</option>
												<option value="1">Admin</option>
												<option value="2">Employee</option>
											</select>
											<?php
												if (isset($_SESSION['usertype'])) {
													?>
														<span style="font-size:14px;color:red;"><?php echo $_SESSION['usertype']?></span>
													<?php
													unset($_SESSION['usertype']);
												}
											?>
										</div>
										<div class="form-group col-12">
											<button type="submit" name="add_user" class="btn btn-primary btn-block">Save</button>
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
include('includes/footer.php');
?>
