<?php
$title = "Student Group";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('authentication.php');
include('configuration/database.php');
include('includes/sessions.php');
?>


<div class="content-wrapper">
<?php


$obj = new Database();
$obj->select('years','*',null,'name=2016');
echo "<pre>";
print_r($obj->getResult());
echo "</pre>";

?>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="post">
                    <input type="hidden" name="page_id" value="">
                    <div class="modal-header bg-red">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Grades</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btn-send" class="btn btn-danger btn-block"><i class="fas fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
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
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="card-title">Marks Grade</div>

                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>