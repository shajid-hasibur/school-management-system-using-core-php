<?php
$title = "Remove subject";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/sessions.php');
include('authentication.php');
include('configuration/connection.php');
?>

<div class="content-wrapper">
<form action="assign_subject_code.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Assigned Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Are you sure want to delete this subject?</strong>
        <input type="hidden" name="delete_id" class="delete-assign-subject">
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="deleteAssignSubject" class="btn btn-primary">Yes, Delete!</button>
      </div>
    </div>
  </div>
</div>
</form>
<div class="content-header">
    <?php
        if(isset($_GET['class_id'])){
            $class_id = $_GET['class_id'];
            $sql = "SELECT * FROM classes WHERE id = '$class_id'";
            $sql_run = mysqli_query($conn,$sql);
            foreach ($sql_run as $key => $value) {
                $class = $value['name'];
            }
        }
    ?>
	<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Subject Details of <?php echo $class; ?></h1>
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
	    		    <!-- <a href="create_assign_subject.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Assign New Subjects</a> -->
                    <a href="assign_subject.php" class="btn btn-primary btn-sm float-right mr-2"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead class="bg-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Full Mark</th>
                                <th class="text-center">Pass Mark</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                            <?php
                                
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
                                            <td class="text-center">
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
            let assignSubjectId = $(this).val();
            $('.delete-assign-subject').val(assignSubjectId);
        });
    });
</script>
