<?php
$title = "School Subjects";
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
<form action="subject_code.php" method="POST">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-red">
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
                    <button type="submit" name="deleteSubBtn" class="btn btn-danger btn-block">Yes, Delete!</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="content-header">
	<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Subjects</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Subjects</li>
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
                    <h5 class="card-title">Subject List</h5>
	    		    <a href="create_subject.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Add New Subject</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover table-warning">
                            <thead class="bg-dark">
                                <th class="text-center">#</th>
                                <th class="text-center">Subjects</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT * FROM subjects";
                                $query_run = mysqli_query($conn,$query);
                                
                                if(mysqli_num_rows($query_run) > 0){
                                    foreach ($query_run as $key => $value) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $key+1?></td>
                                            <td class="text-center"><?php echo $value['name']?></td>
                                            <td class="text-center">
                                                <a href="edit_subject.php?subject_id=<?php echo $value['id'] ?>" class="btn bg-dark btn-sm"><i class="fas fa-edit" style="color: red;"></i></a>
                                                <button type="button" value="<?php echo $value['id']?>" data-toggle="modal" data-target="#exampleModal" class="btn bg-dark btn-sm delete-btn"><i class="fas fa-trash" style="color: red;"></i></button>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('.delete-btn').click(function(e){
            e.preventDefault();
            let subjectId = $(this).val();
            $('.delete-subject-id').val(subjectId);
        });
    });
</script>