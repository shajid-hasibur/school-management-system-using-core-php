<?php
$title = "Add Subjects";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/sessions.php');
include('authentication.php');
include('configuration/connection.php');
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
                    <h5 class="card-title">Add Subjects</h5>
	    		    <a href="subject.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                </div>
                <div class="card-body">
                    <form action="subject_code.php" method="POST">
                    <div class="col-lg-12">
                        <div class="form-group col-lg-6">
                            <label for="">Subject</label>
                            <input type="text" class="form-control" placeholder="Enter a subject name" name="name">
                            <?php
                                echo validation();
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check">
                                <input type="hidden" name="status" value="0">
                                <input class="form-check-input" type="checkbox" value="1" name="status">
                                <label class="form-check-label" style="color:green;">
                                    Set as additional subject
                                </label>
                            </div>
                        </div><br>
                        <div class="form-group col-lg-6">
                            <button class="btn btn-success" type="submit" name="btn-save">Submit</button>
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
include('includes/footer.php');
// include('includes/script.php');
?>