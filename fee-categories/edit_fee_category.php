<?php
$title = "Edit Fee Category";
$basePath = $_SERVER['DOCUMENT_ROOT'];
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
	            <h1 class="m-0">Update Fee Category</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Update Fee Category</li>
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
	    					<h5 class="card-title">Update Fee Category</h5>
							<a href="fee_category.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	    				</div>
	    				<div class="card-body">
	    					<?php
	    						if (isset($_GET['fee_category_id'])) {
	    							$fee_category_id = $_GET['fee_category_id'];

	    							$query = "SELECT * FROM fee_categories WHERE id='$fee_category_id' ";
	    							$query_run = mysqli_query($conn,$query);
	    							if (mysqli_num_rows($query_run) > 0) {
	    								foreach ($query_run as $key => $value) {
	    									$feeId = $value['id'];
	    									$fee_name = $value['name'];
	    								}
	    							}else{
	    								echo "No records found";
	    							}
	    						}
	    					?>
	    					<form action="fee_category_code.php" method="POST">
		    					<div class="row">
		    						<div class="col-md-4">
		    							<input type="hidden" name="fee_category_id" value="<?php echo $feeId; ?>">
		    							<div class="form-group">
			    							<label>Fee Category</label>
			    							<input type="text" name="name" class="form-control" placeholder="Enter fee category" value="<?php echo $fee_name; ?>">
			    							<?php
			    								if (isset($_SESSION['validation'])) {
			    									?>
			    									<span style="font-size:14px;color:red;"><?php echo $_SESSION['validation']; ?></span>
				    								<?php
				    								unset($_SESSION['validation']);
			    								}
			    								if (isset($_SESSION['unique-fee'])) {
			    									?>
			    									<span style="font-size:14px;color:red;"><?php echo $_SESSION['unique-fee'];?></span>
			    								    <?php
			    								    unset($_SESSION['unique-fee']);
			    								}
			    							?>
		    						    </div>
		    						</div>
		    						<div class="col-md-4">
		    							<div class="form-group">
			    							<button style="margin-top: 32px;" type="submit" class="btn btn-primary" name="btn-update">Update</button>
		    						    </div>
		    						</div>
		    					</div>
	    					</form>
	    				</div>
	    			</div>	
	    		</div>
	        </div>
	   </div>
</div>


<?php
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>