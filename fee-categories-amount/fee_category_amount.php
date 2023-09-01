<?php
$title = "Fee Category Amount";
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
	            <h1 class="m-0">Fee Category Amount</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Fee Category Amount</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>				

	    <div class="container-fluid">
			<?php
				echo SuccessMessage();
				echo notification();
			?>    	
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
	    					<h5 class="card-title">Fee Category Amount</h5>
	    					<a href="create_fee_amount.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Add Fee Amount</a>
	    				</div>
	    				<div class="card-body">

	    					<div class="table-responsive">
	    						<table id="example1" class="table table-bordered table-warning">
	    							<thead class="bg-dark">
	    								<tr>
	    									<th class="text-center">#</th>
	    									<th class="text-center">Fee Type</th>
	    									<th class="text-center">Action</th>
	    								</tr>
	    							</thead>
	    							<tbody>
	    								<?php
	    								$query = "SELECT fee_category_amounts.fee_category_id,fee_categories.name FROM fee_category_amounts INNER JOIN fee_categories ON fee_category_amounts.fee_category_id = fee_categories.id GROUP BY fee_category_amounts.fee_category_id";
	    								$query_run = mysqli_query($conn,$query);

	    								if (mysqli_num_rows($query_run) > 0) {
	    									foreach ($query_run as $key => $value) {
	    										?>
	    											<tr>
	    												<td class="text-center"><?php echo $key+1 ?></td>
	    												<td class="text-center"><?php echo $value['name'] ?></td>
	    												<td class="text-center">
	    													<a  href="edit_fee_category_amount.php?fee_category_id=<?php echo $value['fee_category_id']?>" type="button" class="btn bg-dark btn-sm"><i class="fas fa-edit" style="color: red;"></i></a>
															<a  href="fee_category_amount_details.php?fee_category_id=<?php echo $value['fee_category_id']?>" class="btn bg-dark btn-sm"><i class="fas fa-info-circle" style="color: red;"></i></a>
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
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>

