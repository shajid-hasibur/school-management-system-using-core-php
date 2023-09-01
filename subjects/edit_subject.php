<?php
$title = "Edit Subjects";
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
<div class="content-header">
	<div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Subjects</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Add Subjects</li>
                </ol>
            </div>
        </div>
	</div>
</div>

<div class="container-fluid">
    <div class="row"> 
         <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="card-title">Edit Subjects</h5>
	    		    <a href="subject.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                </div>
                <div class="card-body">
                    <?php
                        
                        if(isset($_GET['subject_id'])){
                            $subject_id = $_GET['subject_id'];
                            $query = "SELECT * FROM subjects WHERE id='$subject_id'";
                            $query_run = mysqli_query($conn,$query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach ($query_run as $key => $value) {
                                    $subjectId = $value['id'];
                                    $subject = $value['name'];
                                    $status = $value['status'];
                                }
                            }
                        }
                    ?>
                    <form action="subject_code.php" method="POST">
                    <div class="col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="">Subject</label>
                            <input type="hidden" name="subject_id" value="<?php echo $subjectId; ?>">
                            <input type="text" class="form-control" placeholder="Enter a subject name" name="name" value="<?php echo $subject; ?>">
                            <?php
                                echo validation();
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check">
                                <input type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" value="1" name="status" <?php echo ($status == 1?'checked':'') ?>>
                                <label class="form-check-label" style="color:green;">
                                    Set as additional subject
                                </label>
                            </div>
                        </div><br>
                        <div class="form-group col-lg-6">
                            <button class="btn btn-success" type="submit" name="btn-update">Update</button>
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
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>