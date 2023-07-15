<?php
$title = "Registered Users";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('configuration/connection.php');
include('authentication.php');
?>

<div class="content-wrapper">
	<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<form action="create_user.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-dark">
        <strong>Are you sure want to delete this record?</strong>
        <input type="hidden" name="delete_id" class="delete-user-id">
      </div>
      <div class="modal-footer bg-dark">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="deleteUserBtn" class="btn btn-primary">Yes, Delete!</button>
      </div>
    </div>
  </div>
</div>
</form>

	<div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">Registered User</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	              <li class="breadcrumb-item active">Registered Users</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<?php
				if (isset($_SESSION['status'])) {
					?>
						<div class="alert alert-primary alert-dismissible fade show col-md-4" role="alert">

					  		<?php
					  			echo "<h4>".$_SESSION['status']."</h4>";
					  		?>
					  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</div>
					<?php
					
					unset($_SESSION['status']);
				}
				?>
				<div class="card">
					<div class="card-header bg-dark">
						<h3 class="card-title">Registered User</h3>
							<a class="btn btn-success btn-sm float-right" type="button" 
							href="user_registration.php">
								<i class="fa fa-plus-circle"></i>&nbsp;Add User</a>
					</div>
					<div class="card-body">
						<table id="example1" class="table table-bordered">
							<thead class="bg-dark">
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$query = "SELECT * FROM users";
								$query_run = mysqli_query($conn,$query);
								if (mysqli_num_rows($query_run) > 0) {
									foreach ($query_run as $key => $value) {
										?>
											<tr>
												<td><?php echo $key+1 ?></td>
												<td><?php echo $value['name'] ?></td>
												<td><?php echo $value['phone'] ?></td>
												<td><?php echo $value['email'] ?></td>
												<td>
													<button type="button" data-toggle="modal" data-target="#exampleModal" value="<?php echo $value['id'] ?>" class="btn btn-danger btn-sm delete-btn">Delete</button>
													<a href="edit-user.php?user_id=<?php echo $value['id']; ?>" class="btn btn-success btn-sm">Edit</a>
												</td>
											</tr>
										<?php
									}
								}
								else{
									?>
										<tr>
											<td>No records found</td>
										</tr>
									<?php
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
<?php 
include('includes/script.php');

?>
<?php
include('includes/footer.php');
?>

<script type="text/javascript">
  $(document).ready(function(){
      $('.delete-btn').click(function(e){
        e.preventDefault();
        let userId = $(this).val();
        $('.delete-user-id').val(userId);
      });
  });
</script>