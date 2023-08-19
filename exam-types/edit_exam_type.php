<?php
$title = "Edit Exam Types";
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
	            <h1 class="m-0">Update Exam Type</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Update Exam Type</li>
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
	    					<h5 class="card-title">Update Exam Type</h5>
							<a href="exam_type.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	    				</div>
	    				<div class="card-body">
	    					<?php
	    						if (isset($_GET['exam_type_id'])) {
	    							$exam_type_id = $_GET['exam_type_id'];

	    							$query = "SELECT * FROM exam_types WHERE id='$exam_type_id' ";
	    							$query_run = mysqli_query($conn,$query);
	    							if (mysqli_num_rows($query_run) > 0) {
	    								foreach ($query_run as $key => $value) {
	    									$examId = $value['id'];
	    									$exam_name = $value['name'];
	    								}
	    							}else{
	    								echo "No records found";
	    							}
	    						}
	    					?>
	    					<form action="exam_type_code.php" method="POST">
		    					<div class="row">
		    						<div class="col-md-4">
		    							<input type="hidden" name="exam_type_id" value="<?php echo $examId; ?>">
		    							<div class="form-group">
			    							<label>Fee Category</label>
			    							<input type="text" name="name" class="form-control" placeholder="Enter exam type" value="<?php echo $exam_name; ?>">
			    							<?php
			    								if (isset($_SESSION['validation'])) {
			    									?>
			    									<span style="font-size:14px;color:red;"><?php echo $_SESSION['validation']; ?></span>
				    								<?php
				    								unset($_SESSION['validation']);
			    								}
			    								if (isset($_SESSION['unique-exam'])) {
			    									?>
			    									<span style="font-size:14px;color:red;"><?php echo $_SESSION['unique-exam'];?></span>
			    								    <?php
			    								    unset($_SESSION['unique-exam']);
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