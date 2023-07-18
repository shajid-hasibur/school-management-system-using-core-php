<?php
$title = "Subject Details";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/sessions.php');
include('authentication.php');
include('configuration/connection.php');
?>

<div class="content-wrapper">
<div class="content-header">
	<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Subject Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Subject Details</li>
                </ol>
            </div><!-- /.col -->   
        </div><!-- /.row -->    
	</div><!-- /.container-fluid -->
</div>	
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php
                echo SuccessMessage();
            ?>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="card-title">Assign Subject List</h5>
	    		    <a href="create_assign_subject.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Assign New Subjects</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead class="bg-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Full Mark</th>
                                <th class="text-center">Pass Mark</th>
                            </thead>
                            <tbody>
                            <?php
                                $class_id = $_GET['class_id'];
                                $query = "SELECT assign_subjects.id,assign_subjects.class_id,assign_subjects.subject_id,assign_subjects.full_mark,assign_subjects.pass_mark,subjects.name FROM assign_subjects LEFT JOIN subjects ON assign_subjects.subject_id = subjects.id WHERE assign_subjects.class_id='$class_id' ORDER BY assign_subjects.subject_id ASC";
                                $query_run = mysqli_query($conn,$query);
                                
                                if(mysqli_num_rows($query_run) > 0){
                                    foreach ($query_run as $key => $value) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $key+1; ?></td>
                                            <td class="text-center"><?php echo $value['name']; ?></td>
                                            <td class="text-center"><?php echo $value['full_mark']; ?></td>
                                            <td class="text-center"><?php echo $value['pass_mark']; ?></td>
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
