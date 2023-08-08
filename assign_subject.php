<?php
$title = "Subject List Classwise";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/sessions.php');
include('authentication.php');
include('configuration/connection.php');
?>

<div class="content-wrapper">
<form action="subject_code.php" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Subjects</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to delete this subject?</strong>
                    <input type="hidden" name="delete_id" class="delete-subject-id">
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" name="deleteSubBtn" class="btn btn-primary">Yes, Delete!</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="content-header">
	<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Assign Subjects</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Assign Subjects</li>
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
                                <th class="text-center">Class</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT assign_subjects.class_id, classes.name FROM assign_subjects
                                INNER JOIN classes ON assign_subjects.class_id = classes.id
                                GROUP BY assign_subjects.class_id";
                                $query_run = mysqli_query($conn,$query);
                                
                                if(mysqli_num_rows($query_run) > 0){
                                    foreach ($query_run as $key => $value) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $key+1?></td>
                                            <td class="text-center"><?php echo $value['name']?></td>
                                            <td class="text-center">
                                                <a href="edit_assign_subject.php?class_id=<?php echo $value['class_id'] ?>" class="btn btn-sm bg-dark"><i class="fas fa-edit"></i></a>
                                                <a href="assign_subject_details.php?class_id=<?php echo $value['class_id'] ?>" class="btn btn-sm bg-dark"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                                <a href="delete_assign_subject.php?class_id=<?php echo $value['class_id'] ?>" class="btn btn-sm bg-dark"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
// include('includes/script.php');
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.delete-btn').click(function(e){
            e.preventDefault();
            let subjectId = $(this).val();
            $('.delete-subject-id').val(subjectId);
        });
    });
</script>