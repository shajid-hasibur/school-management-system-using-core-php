<?php
$title = "Add Fee Category Amount";
$basePath = $_SERVER['DOCUMENT_ROOT'];
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
                    <h1 class="m-0">Add Fee Amount</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Fee Amount</li>
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
                        <h5 class="card-title">Add Fee Amount</h5>
                        <a href="fee_category_amount.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                    <div class="card-body">
                        <?php
                        $query = "SELECT * FROM fee_categories";
                        $query_run = mysqli_query($conn, $query);
                        $categories = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

                        $class_query = "SELECT * FROM classes";
                        $class_query_run = mysqli_query($conn, $class_query);
                        $classes = mysqli_fetch_all($class_query_run, MYSQLI_ASSOC);
                        ?>
                        <form action="fee_category_amount_code.php" method="POST">
                            <div class="col-lg-12">
                                <div id="main-item">
                                    <div class="form-group row">
                                        <label class="col-form-label" style="width: 130px;">Fee Category :</label>
                                        <div class="col-md-4">
                                            <select name="fee_category_id" class="form-control">
                                                <option value="">Select Fee</option>
                                                <?php
                                                foreach ($categories as $key => $category) {
                                                ?>
                                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            if (isset($_SESSION['validation'])) {
                                            ?>
                                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['validation']; ?></span>
                                            <?php
                                                unset($_SESSION['validation']);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label" for="" style="width: 130px;">Class :</label>
                                        <div class="col-md-4">
                                            <select name="class_id[]" class="form-control">
                                                <option value="">Select Class</option>
                                                <?php
                                                foreach ($classes as $key => $class) {
                                                ?>
                                                    <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            if (isset($_SESSION['class-validate'])) {
                                            ?>
                                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['class-validate']; ?></span>
                                            <?php
                                                unset($_SESSION['class-validate']);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label" for="" style="width: 130px;">Fee Amount :</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="amount[]">
                                            <?php
                                            if (isset($_SESSION['amount-validate'])) {
                                            ?>
                                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['amount-validate']; ?></span>
                                            <?php
                                                unset($_SESSION['amount-validate']);
                                            }
                                            ?>
                                        </div>

                                        <div class="form-group col-4">
                                            <button type="button" class="btn btn-success add-btn"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-primary" name="btn-save">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div id="additional-element" class="d-none">
        <div id="remove-additional-element">
            <div class="form-group row">
                <label class="col-form-label" for="" style="width: 130px;">Class :</label>
                <div class="col-md-4">
                    <select name="class_id[]" class="form-control">
                        <option value="">Select Class</option>
                        <?php
                        foreach ($classes as $key => $class) {
                        ?>
                            <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <?php
                    if (isset($_SESSION['class-validate'])) {
                    ?>
                        <span style="font-size:14px;color:red;"><?php echo $_SESSION['class-validate']; ?></span>
                    <?php
                        unset($_SESSION['class-validate']);
                    }
                    ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label" for="" style="width: 130px;">Fee Amount :</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="amount[]">
                    <?php
                    if (isset($_SESSION['amount-validate'])) {
                    ?>
                        <span style="font-size:14px;color:red;"><?php echo $_SESSION['amount-validate']; ?></span>
                    <?php
                        unset($_SESSION['amount-validate']);
                    }
                    ?>
                </div>

                <div class="form-group col-4">
                    <button type="button" class="btn btn-success add-btn"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-danger remove-btn" style="margin-left: 5px;"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.add-btn', function() {
            let html = $('#additional-element').html();
            $('#main-item').append(html);
        });
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('#remove-additional-element').remove();
        });
    });
</script>

<?php
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>