<?php
$title = "Student Classes";
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath . '/PHP_SCHOOL/sms/admin/includes/header.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/topbar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sidebar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sessions.php');
include($basePath . '/PHP_SCHOOL/sms/admin/authentication.php');
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/connection.php');
?>

<div class="content-wrapper">
<form action="class_code.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <h5 class="modal-title" id="exampleModalLabel">Delete Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Are you sure want to delete this class?</strong>
        <input type="hidden" name="delete_id" class="delete-class-id">
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="deleteClassBtn" class="btn btn-danger btn-block">Yes, Delete!</button>
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
	            <h1 class="m-0">Student Class</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Student Class</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>

	     <div class="container-fluid">    	
	    	<div class="row">
	    		<div class="col-lg-12">
					<?php
						echo notification();
						echo SuccessMessage();
					?>
	    			<div class="card">
	    				<div class="card-header bg-dark">
	    					<h5 class="card-title">Student Class</h5>
	    					<a href="create_student_class.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Add New Class</a>
	    				</div>
	    				<div class="card-body">

	    					<div class="table-responsive">
	    						<table id="example1" class="table table-bordered table-warning">
	    							<thead class="bg-dark">
	    								<tr>
	    									<th class="text-center" >#</th>
	    									<th class="text-center" >Class</th>
	    									<th class="text-center" >Action</th>
	    								</tr>
	    							</thead>
	    							<tbody>
	    								<?php
	    								$query = "SELECT * FROM classes";
	    								$query_run = mysqli_query($conn,$query);
	    								if (mysqli_num_rows($query_run) > 0) {
	    									foreach ($query_run as $key => $value) {
	    										?>
	    											<tr>
	    												<td class="text-center" ><?php echo $key+1 ?></td>
	    												<td class="text-center" ><?php echo $value['name'] ?></td>
	    												<td class="text-center" >
	    													<a  href="edit_class_page.php?class_id=<?php echo $value['id']?>" type="button" class="btn bg-dark btn-sm"><i class="fas fa-edit" style="color: red;"></i></a>
															<button value="<?php echo $value['id']?>" type="button" data-toggle="modal" data-target="#exampleModal" class="btn bg-dark btn-sm delete-btn"><i class="fas fa-trash" style="color: red;"></i></button>
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

<script type="text/javascript">
  $(document).ready(function(){
      $('.delete-btn').click(function(e){
        e.preventDefault();
        let classId = $(this).val();
        $('.delete-class-id').val(classId);
      });
  });
</script>
<?php
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>