<?php
$title = "Exam Type";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('authentication.php');
include('configuration/connection.php');
?>


<div class="content-wrapper">
<form action="exam_type_code.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Are you sure want to delete this exam type?</strong>
        <input type="hidden" name="delete_id" class="delete-exam-id">
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="deleteExamBtn" class="btn btn-primary">Yes, Delete!</button>
      </div>
    </div>
  </div>
</div>
</form>
	<!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">Exam Type</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Exam Type</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>				

	    <div class="container-fluid">    	
	    	<div class="row">
	    		<div class="col-md-4">
		    	<?php
					if (isset($_SESSION['status'])) {
					    ?>
					    <div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong><?php echo $_SESSION['status']; ?></strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					    <?php
					   	unset($_SESSION['status']);
					   }
		    	?>				
	    	</div>
	    		<div class="col-lg-12">
	    			<div class="card">
	    				<div class="card-header bg-dark">
	    					<h5 class="card-title">Exam Type</h5>
	    					<a href="create_exam_type.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Add Exam Type</a>
	    				</div>
	    				<div class="card-body">

	    					<div class="table-responsive">
	    						<table id="example1" class="table table-bordered">
	    							<thead class="bg-dark">
	    								<tr>
	    									<th style="width:10%">#</th>
	    									<th style="width:45%">Exam Type</th>
	    									<th style="width:45%">Action</th>
	    								</tr>
	    							</thead>
	    							<tbody>
	    								<?php
	    								$query = "SELECT * FROM exam_types";
	    								$query_run = mysqli_query($conn,$query);
	    								if (mysqli_num_rows($query_run) > 0) {
	    									foreach ($query_run as $key => $value) {
	    										?>
	    											<tr>
	    												<td><?php echo $key+1 ?></td>
	    												<td><?php echo $value['name'] ?></td>
	    												<td>
	    													<a  href="edit_exam_type.php?exam_type_id=<?php echo $value['id']?>" type="button" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Edit</a>
															<button value="<?php echo $value['id']?>" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash"></i>&nbsp;Delete</button>
	    												</td>
	    											</tr>
	    										<?php
	    									}
	    								}

	    								?>
	    							</tbody>
	    						</table>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
</div>


<?php
include('includes/footer.php');
include('includes/script.php');
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.delete-btn').click(function(e){
			e.preventDefault();
			let examTypeId = $(this).val();
			$('.delete-exam-id').val(examTypeId);
		});
	});
</script>
