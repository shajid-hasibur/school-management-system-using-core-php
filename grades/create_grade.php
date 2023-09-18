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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="card-title">Create Grade</div>
                        <a href="grades.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                    <div class="card-body">
                        <form action="grade_code.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label for="letter_grade">Letter Grade</label>
                                    <input type="text" name="grade_name" class="form-control" placeholder="Enter letter grade">
                                    <?php
                                        echo validate('grade_name');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="grade_point">Grade Point</label>
                                    <input type="text" name="grade_point" class="form-control" placeholder="Enter grade point">
                                    <?php
                                        echo validate('grade_point');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="start_mark">Start Marks</label>
                                    <input type="text" name="start_mark" class="form-control" placeholder="Enter start marks">
                                    <?php
                                        echo validate('start_mark');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="end_mark">End Marks</label>
                                    <input type="text" name="end_mark" class="form-control" placeholder="Enter end mark">
                                    <?php
                                        echo validate('end_mark');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="start_point">Start Point</label>
                                    <input type="text" name="start_point" class="form-control" placeholder="Enter start point">
                                    <?php
                                        echo validate('start_point');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="end_point">End Point</label>
                                    <input type="text" name="end_point" class="form-control" placeholder="Enter letter grade">
                                    <?php
                                        echo validate('end_point');
                                    ?>
                                </div>
                                <div class="form-group col-4">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Enter remarks">
                                    <?php
                                        echo validate('remarks');
                                    ?>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-success btn-block" name="btn-save">Submit</button>
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