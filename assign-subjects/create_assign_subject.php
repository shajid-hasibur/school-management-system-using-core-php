<?php
$title = "Add Subject To Class";
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
	            <h1 class="m-0">Assign Subjects To Class</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Assign Subjects To Class</li>
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
            ?>
	    	<div class="card">
	    		<div class="card-header bg-dark">
	    			<h5 class="card-title">Add Subjects</h5>
					<a href="assign_subject.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	    		</div>
	    		<div class="card-body">
                <?php
                    $query = "SELECT * FROM classes";
                    $query_run = mysqli_query($conn,$query);
                    $classes = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

                    $query2 = "SELECT * FROM subjects";
                    $query2_run = mysqli_query($conn,$query2);
                    $subjects = mysqli_fetch_all($query2_run, MYSQLI_ASSOC);
                ?>         
	    		<form action="assign_subject_code.php" method="POST">
                    <div class="main-item">
                        <div class="form-group col-lg-4">
                            <label>Class</label>
                            <select name="class_id" class="form-control" required>
                            <option value="">Select Class</option>
                            <?php
                                foreach ($classes as $key => $class) {
                                    ?>
                                    <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                    <?php
                                }
                            ?>
                            </select>
                        </div>        
                        <div class="form-row col-lg-12">
                            <div class="form-group col-lg-4">
                                <label>Subject</label>
                                <select name="subject_id[]" class="form-control" required>
                                <option value="">Select Subject</option>
                                <?php
                                    foreach ($subjects as $key => $subject) {
                                    ?>
                                    <option value="<?php echo $subject['id'];?>"><?php echo $subject['name'] ;?></option>
                                    <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Full Mark</label>
                                <input type="text" class="form-control" name="full_mark[]" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label>Pass Mark</label>
                                <input type="text" class="form-control" name="pass_mark[]" required>
                            </div>
                            <div class="form-group col-lg-2" style="margin-top: 32px;">
                                <button type="button" class="btn btn-primary add-btn"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" name="btn-save">Submit</button>
                    </div>	
	    		</form>
	    		</div>
	    	</div>
	    </div>
	</div>
</div>
</div>
<div class="d-none" id="extra-item">
    <div id="remove-extra-item">
    <div class="form-row col-lg-12">
        <div class="form-group col-lg-4">
            <label>Subject</label>
            <select name="subject_id[]" class="form-control" required>
            <option value="">Select Subject</option>
            <?php
            foreach ($subjects as $key => $subject) {
                ?>
                <option value="<?php echo $subject['id'];?>"><?php echo $subject['name'] ;?></option>
                <?php
            }
            ?>
            </select>
        </div>
        <div class="form-group col-lg-3">
            <label>Full Mark</label>
            <input type="text" class="form-control" name="full_mark[]" required>
        </div>
        <div class="form-group col-lg-3">
            <label>Pass Mark</label>
            <input type="text" class="form-control" name="pass_mark[]" required>
        </div>
        <div class="form-group col-lg-2" style="margin-top: 32px;">
            <button type="button" class="btn btn-primary add-btn"><i class="fa fa-plus"></i></button>
            <button type="button" class="btn btn-danger remove-btn"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    </div>
</div>	    
<script>

$(document).ready(function(){
    $(document).on('click','.add-btn',function(){
        let html = $('#extra-item').html();
        $('.main-item').append(html);
    });

    $(document).on('click','.remove-btn',function(){
        $(this).closest('#remove-extra-item').remove();
    });
});

</script>
<?php
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>
