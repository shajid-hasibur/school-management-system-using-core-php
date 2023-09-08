<?php
$title = "Create Grade";
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath . '/PHP_SCHOOL/sms/admin/authorisation.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/header.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/topbar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sidebar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sessions.php');
include($basePath . '/PHP_SCHOOL/sms/admin/authentication.php');
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/database.php');
?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Create Grade</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Create Grade</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        if(isset($_GET['grade_id'])){
            $id = $_GET['grade_id'];
            $db = new Database();
            $db->select("grades","*","",$id);
            $grade = $db->getResult();
        }
        
        ?>
        <div class="row">
            <div class="col-12">
                    <?php
                        echo notification();
                    ?>
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="card-title">Create Grade</div>
                        <a href="grades.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                    <div class="card-body">
                        <form action="grade_code.php" method="POST">
                            <input type="hidden" name="page_id" value="<?php echo $id; ?>">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="letter_grade">Letter Grade</label>
                                    <input type="text" name="grade_name" value="<?php echo $grade['0']['grade_name']; ?>" class="form-control" placeholder="Enter letter grade">
                                    <?php
                                        echo validation('grade_name');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="grade_point">Grade Point</label>
                                    <input type="text" name="grade_point" value="<?php echo $grade['0']['grade_point']; ?>" class="form-control" placeholder="Enter grade point">
                                    <?php
                                        echo validation('grade_point');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="start_mark">Start Marks</label>
                                    <input type="text" name="start_mark" value="<?php echo $grade['0']['start_mark']; ?>" class="form-control" placeholder="Enter start marks">
                                    <?php
                                        echo validation('start_mark');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="end_mark">End Marks</label>
                                    <input type="text" name="end_mark" value="<?php echo $grade['0']['end_mark']; ?>" class="form-control" placeholder="Enter end mark">
                                    <?php
                                        echo validation('end_mark');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="start_point">Start Point</label>
                                    <input type="text" name="start_point" value="<?php echo $grade['0']['start_point']; ?>" class="form-control" placeholder="Enter start point">
                                    <?php
                                        echo validation('start_point');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="end_point">End Point</label>
                                    <input type="text" name="end_point" value="<?php echo $grade['0']['end_point']; ?>" class="form-control" placeholder="Enter letter grade">
                                    <?php
                                        echo validation('end_point');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" name="remarks" value="<?php echo $grade['0']['remarks']; ?>" class="form-control" placeholder="Enter remarks">
                                    <?php
                                        echo validation('remarks');
                                    ?>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-success btn-block" name="btn-update">Update</button>
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