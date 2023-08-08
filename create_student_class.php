<?php
$title = "Add Student Class";
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
	            <h1 class="m-0">Add Student Class</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Add Student Class</li>
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
	    					<h5 class="card-title">Add Student Class</h5>
							<a href="student_class.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	    				</div>
	    				<div class="card-body">
	    					<form action="class_code.php" method="POST">
		    					<div class="row">
		    						<div class="col-md-4">
		    							<div class="form-group">
			    							<label>Class</label>
			    							<input type="text" name="name" class="form-control" placeholder="Enter Class">
			    							<?php
			    								if (isset($_SESSION['validation'])) {
			    									?>
			    									<span style="font-size:14px;color:red;"><?php echo $_SESSION['validation']; ?></span>
				    								<?php
				    								unset($_SESSION['validation']);
			    								}
			    								if (isset($_SESSION['unique-class'])) {
			    									?>
			    									<span style="font-size:14px;color:red;"><?php echo $_SESSION['unique-class'];?></span>
			    								    <?php
			    								    unset($_SESSION['unique-class']);
			    								}
			    							?>
		    						    </div>
		    						</div>
		    						<div class="col-md-4">
		    							<div class="form-group">
			    							<button style="margin-top: 32px;" type="submit" class="btn btn-primary" name="btn-save">Save</button>
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
include('includes/footer.php');
// include('includes/script.php');
?>
