<?php
$title = "Edit Assign Subjects of Class";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('includes/sessions.php');
include('authentication.php');
include('configuration/connection.php');
?>

<div class="content-wrapper">
<?php
    $sql1 = "SELECT * FROM years";
    $sql_run1 = mysqli_query($conn,$sql1);
    $years = mysqli_fetch_all($sql_run1, MYSQLI_ASSOC);

    $sql2 = "SELECT * FROM classes";
    $sql_run2 = mysqli_query($conn,$sql2);
    $classes = mysqli_fetch_all($sql_run2, MYSQLI_ASSOC);

    $sql3 = "SELECT * FROM sections";
    $sql_run3 = mysqli_query($conn,$sql3);
    $sections = mysqli_fetch_all($sql_run3, MYSQLI_ASSOC);

    $sql4 = "SELECT * FROM groups";
    $sql_run4 = mysqli_query($conn,$sql4);
    $groups = mysqli_fetch_all($sql_run4, MYSQLI_ASSOC);
    // echo "<pre>";
    //     print_r($groups);
    // echo "</pre>"
?>
	<!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h4 class="m-0">Student Registration</h4>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Student Registration</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="card-title">Student Registration Form</h5>
					<a href="assign_subject.php" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                </div>
                <div class="card-body">
                    <form action="student_code.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label>Student's Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Enter student's name">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Father's Name</label>
                            <input type="text" name="fname" class="form-control form-control-sm" placeholder="Enter father's name">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Mother's Name</label>
                            <input type="text" name="mname" class="form-control form-control-sm" placeholder="Enter mother's name">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Contact No</label>
                            <input type="text" name="contact" class="form-control form-control-sm" placeholder="Enter contact number">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Present Address</label>
                            <input type="text" name="address1" class="form-control form-control-sm" placeholder="Enter present address">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Permanent Address</label>
                            <input type="text" name="address2" class="form-control form-control-sm" placeholder="Enter permanent address">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Gender</label>
                            <select name="gender" class="form-control form-control-sm">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Religion</label>
                            <select name="religion" class="form-control form-control-sm">
                                <option value="">Select Religion</option>
                                <option value="Islam">Islam</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddhist">Buddhist</option>
                                <option value="Christian">Christian</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Date of Birth</label>
                            <input type="text" id="datepicker" name="dob" class="form-control form-control-sm">
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Discount</label>
                            <input type="text" name="discount" class="form-control form-control-sm" placeholder="Enter discount">
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Year</label>
                            <select name="year_id" class="form-control form-control-sm">
                                <option value="">Select Year</option>
                                <?php
                                    foreach ($years as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Class</label>
                            <select name="class_id" class="form-control form-control-sm">
                                <option value="">Select Class</option>
                                <?php
                                    foreach ($classes as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Group</label>
                            <select name="group_id" class="form-control form-control-sm">
                                <option value="">Select Group</option>
                                <?php
                                    foreach ($groups as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Section</label>
                            <select name="section_id" class="form-control form-control-sm">
                                <option value="">Select Section</option>
                                <?php
                                    foreach ($sections as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control form-control-sm">
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Student Photo</label><br>
                            <input name="sphoto" type="file" id="fileInput">
                        </div>
                        <div class="form-group col-lg-4">
                        <img id="previewImage" src="#" alt="Selected Image" style="height:70px; width:50px; display: none;">
                        </div>
                        <div class="form-group col-lg-12">

                        </div>
                        <div class="form-group col-lg-12">
                            <button type="submit" class="btn btn-success btn-block" name="btn-save">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        
</div>        
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include jQuery Datepicker plugin -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script>
  $(function() {
    // Initialize the Datepicker
    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy", // Format of the date displayed in the input
        // minDate: 0, // Minimum date (0 means today)
        // maxDate: "+1y", // Maximum date (+1y means one year from today)
        showButtonPanel: false, // Show a button panel below the Datepicker
        changeMonth: true, // Allow changing months
        changeYear: true, // Allow changing years
        yearRange: "1970:2030"
    });
    
  });
</script>
<script>
  $(document).ready(function() {
    // Handle file input change event
    $("#fileInput").change(function() {
      readURL(this);
    });

    // Function to read and display the selected image
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          // Set the 'src' attribute of the image element to the data URL
          $("#previewImage").attr('src', e.target.result);
          // Show the image element
          $("#previewImage").show();
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  });
</script>

<?php
include('includes/footer.php');
include('includes/script.php');
?>