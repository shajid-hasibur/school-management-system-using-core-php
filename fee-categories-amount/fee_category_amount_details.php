<?php
$title = "Fee Category Amount Details";
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
    <?php
    if (isset($_GET['fee_category_id'])) {
        $fee_category_id = $_GET['fee_category_id'];

        $sql = "SELECT * FROM fee_category_amounts WHERE fee_category_id = '$fee_category_id'";
        $sql_run = mysqli_query($conn, $sql);
        $fcAmounts = mysqli_fetch_all($sql_run, MYSQLI_ASSOC);
        // var_dump($fcAmounts);
        foreach ($fcAmounts as &$row) {
            $feeCatId = $row['fee_category_id'];
            $class_id = $row['class_id'];

            $sql2 = "SELECT * FROM fee_categories WHERE id ='$feeCatId'";
            $sql2_run = mysqli_query($conn, $sql2);
            $fee_data = mysqli_fetch_assoc($sql2_run);
            $row['fee_category_name'] = $fee_data;

            $sql3 = "SELECT * FROM classes WHERE id = '$class_id'";
            $sql3_run = mysqli_query($conn, $sql3);
            $class_data = mysqli_fetch_assoc($sql3_run);
            $row['class'] = $class_data;
        }
    }

    ?>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="fee_category_amount_code.php" method="post">
                    <div class="modal-header bg-red">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Fee Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <strong>Are you sure you want to delete this record?</strong>
                        <input type="hidden" name="delete_record" id="delete_record">
                        <input type="hidden" name="page_id" value="<?php echo $fee_category_id; ?>">
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" name="delete-btn" class="btn btn-danger btn-block">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Fee Category Amount Details</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Fee Category Amount Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php
                echo SuccessMessage();
                ?>
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="card-title">Fee Category Amount Details</h5>
                        <a href="fee_category_amount.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-warning table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fee Category</th>
                                        <th class="text-center">Class</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($fcAmounts as $key => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $key + 1; ?></td>
                                            <td class="text-center"><?php echo $value['fee_category_name']['name']; ?></td>
                                            <td class="text-center"><?php echo $value['class']['name']; ?></td>
                                            <td class="text-center"><?php echo $value['amount']; ?></td>
                                            <td class="text-center">
                                                <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button" value="<?php echo $value['id']; ?>" class="btn btn-sm bg-dark delete_id"><i class="fas fa-trash" style="color: red;"></i></button>
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
    $(document).ready(function() {
        $('.delete_id').click(function(e) {
            e.preventDefault();
            let feeCatId = $(this).val();
            $('#delete_record').val(feeCatId);
        });
    });
</script>