<?php
$title = "Edit Student Sections";
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
	            <h1 class="m-0">Update Student Section</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Update Student Section</li>
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
	    					<h5 class="card-title">Update Student Section</h5>
							<a href="student_section.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	    				</div>
	    				<div class="card-body">
                            <?php
                                if(isset($_GET['section_id'])){
                                    $section_id = $_GET['section_id'];
                                    $query = "SELECT * FROM sections WHERE id='$section_id' ";
                                    $query_run = mysqli_query($conn,$query);
                                    
                                    if(mysqli_num_rows($query_run) > 0){
                                        foreach ($query_run as $key => $value) {
                                            $sectionId = $value['id'];
                                            $section = $value['name'];
                                        }
                                    }
                                }
                            ?>
	    					<form action="section_code.php" method="POST">
                                <input type="hidden" name="section_id" value="<?php echo $sectionId; ?>">
		    					<div class="row">
		    						<div class="col-md-4">
		    							<div class="form-group">
			    							<label>Section</label>
			    							<input type="text" name="name" class="form-control" placeholder="Enter section" value="<?php echo $section; ?>">
			    							<?php
			    								if (isset($_SESSION['validation'])) {
			    									?>
			    									<span style="font-size:14px;color:red;"><?php echo $_SESSION['validation']; ?></span>
				    								<?php
				    								unset($_SESSION['validation']);
			    								}
			    								if (isset($_SESSION['unique-section'])) {
			    									?>
			    									<span style="font-size:14px;color:red;"><?php echo $_SESSION['unique-section'];?></span>
			    								    <?php
			    								    unset($_SESSION['unique-section']);
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
include('includes/footer.php');
// include('includes/script.php');
?>
