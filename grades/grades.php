<?php
$title = "Grading system details";
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="grade_code.php" method="post">
                    <div class="modal-header bg-red">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Grades</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <strong>Are you sure want to delete this grade?</strong>
                    <input type="hidden" name="grade_id" id="grade-id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btn-delete" class="btn btn-danger btn-block"><i class="fas fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Marks Grades</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Marks Grades</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    echo SuccessMessage();
                    echo notification();
                ?>
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="card-title">Marks Grade</div>
                        <a href="create_grade.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Add New Grade</a>
                    </div>
                    <div class="card-body">
                        <?php
                            $db = new Database();
                            $db->select("grades", "*");
                            $grades = $db->getResult();
                        ?>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-warning">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Letter Grade</th>
                                        <th>Grade Point</th>
                                        <th>Start Marks</th>
                                        <th>End Marks</th>
                                        <th>Point Range</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($grades as $key => $grade) {
                                        ?>
                                        <tr class="text-center">
                                            <td><?php echo $key+1; ?></td>
                                            <td><?php echo $grade['grade_name']; ?></td>
                                            <td><?php echo $grade['grade_point']; ?></td>
                                            <td><?php echo $grade['start_mark']; ?></td>
                                            <td><?php echo $grade['end_mark']; ?></td>
                                            <td><?php echo $grade['start_point']; ?> - <?php echo $grade['end_point']; ?></td>
                                            <td><?php echo $grade['remarks']; ?></td>
                                            <td>
                                            <a href="edit_grade.php?grade_id=<?php echo $grade['id'] ?>" class="btn bg-dark btn-sm"><i class="fas fa-edit" style="color: red;"></i></a>
                                                <button id="delete" type="button" value="<?php echo $grade['id']; ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn bg-dark btn-sm"><i class="fas fa-trash" style="color: red;"></i></button>
                                            </td>
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
</div>

<?php
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>
<script>
    $(document).ready(function(){
        $(document).on('click','#delete',function(){
            let id = $(this).val();
            $('#grade-id').val(id);
        });
    });
</script>