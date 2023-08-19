<?php
$title = "Student Promotion";
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath . '/PHP_SCHOOL/sms/admin/includes/header.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/topbar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sidebar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sessions.php');
include($basePath . '/PHP_SCHOOL/sms/admin/authentication.php');
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/connection.php');
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
    // echo "</pre>";

    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];
    }

    $url = 'student_details.php?student_id='.$student_id;

    $sql = "SELECT students.*,assign_students.*,discount_students.*,users.email,users.code
    FROM students
    INNER JOIN assign_students ON students.id = assign_students.student_id
    INNER JOIN users ON students.id = users.student_id
    INNER JOIN discount_students ON assign_students.id = discount_students.assign_student_id WHERE students.id = '$student_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($result_array as &$row) {
            $year_id = $row['year_id'];
            $class_id = $row['class_id'];
            $group_id = $row['group_id'];
            $section_id = $row['section_id'];

            $year_query = "SELECT * FROM years WHERE id = '$year_id'";
            $year_result = mysqli_query($conn, $year_query);
            $year_data = mysqli_fetch_assoc($year_result);
            $row['year'] = $year_data;

            $class_query = "SELECT * FROM classes WHERE id = '$class_id'";
            $class_result = mysqli_query($conn, $class_query);
            $class_data = mysqli_fetch_assoc($class_result);
            $row['class'] = $class_data;

            $section_query = "SELECT * FROM sections WHERE id = '$section_id'";
            $section_result = mysqli_query($conn, $section_query);
            $section_data = mysqli_fetch_assoc($section_result);
            $row['section'] = $section_data;

            $group_query = "SELECT * FROM groups WHERE id = '$group_id'";
            $group_result = mysqli_query($conn, $group_query);
            $group_data = mysqli_fetch_assoc($group_result);
            $row['group'] = $group_data;
        }
    }
    //  echo "<pre>";
    //  print_r($result_array);
    //  echo "</pre>";

    $image_path = $row['image_path'];
    
?>
	<!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h4 class="m-0">Student Promotion</h4>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
	              <li class="breadcrumb-item active">Student Promotion</li>
	            </ol>
	          </div><!-- /.col -->
	        </div><!-- /.row -->
	      </div><!-- /.container-fluid -->
	    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo notification();
                echo SuccessMessage();
            ?>
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="card-title">Student Registration Form</h5>
					<a href="<?php echo $url; ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
                </div>
                <div class="card-body">
                    <form action="student_code.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label>Student's Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Enter student's name" value="<?php echo $result_array['0']['name'];  ?>">
                            <?php
                               if (isset($_SESSION['error-text']['name'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['name']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['name']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Father's Name</label>
                            <input type="text" value="<?php echo $result_array['0']['fname'];  ?>" name="fname" class="form-control form-control-sm" placeholder="Enter father's name">
                            <?php
                               if (isset($_SESSION['error-text']['fname'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['fname']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['fname']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Mother's Name</label>
                            <input type="text" name="mname" value="<?php echo $result_array['0']['mname'];  ?>" class="form-control form-control-sm" placeholder="Enter mother's name">
                            <?php
                               if (isset($_SESSION['error-text']['mname'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['mname']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['mname']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Contact No</label>
                            <input type="text" name="contact" value="<?php echo $result_array['0']['contact_number']; ?>" class="form-control form-control-sm" placeholder="Enter contact number">
                            <?php
                               if (isset($_SESSION['error-text']['contact'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['contact']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['contact']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Present Address</label>
                            <input type="text" name="address1" value="<?php echo $result_array['0']['address1']; ?>" class="form-control form-control-sm" placeholder="Enter present address">
                            <?php
                               if (isset($_SESSION['error-text']['address1'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['address1']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['address1']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Permanent Address</label>
                            <input type="text" name="address2" value="<?php echo $result_array['0']['address2']; ?>" class="form-control form-control-sm" placeholder="Enter permanent address">
                            <?php
                               if (isset($_SESSION['error-text']['address2'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['address2']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['address2']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Gender</label>
                            <select name="gender" class="form-control form-control-sm">
                                <option value="">Select Gender</option>
                                <option value="Male" <?php if ($result_array['0']['gender'] == 'Male') echo ' selected'; ?>>Male</option>
                                <option value="Female" <?php if ($result_array['0']['gender'] == 'Female') echo ' selected'; ?>>Female</option>
                            </select>
                            <?php
                               if (isset($_SESSION['error-text']['gender'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['gender']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['gender']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Religion</label>
                            <select name="religion" class="form-control form-control-sm">
                                <option value="">Select Religion</option>
                                <option value="Islam" <?php if ($result_array['0']['religion'] == 'Islam') echo ' selected'; ?>>Islam</option>
                                <option value="Hindu" <?php if ($result_array['0']['religion'] == 'Hindu') echo ' selected'; ?>>Hindu</option>
                                <option value="Buddhist" <?php if ($result_array['0']['religion'] == 'Buddhist') echo ' selected'; ?>>Buddhist</option>
                                <option value="Christian" <?php if ($result_array['0']['religion'] == 'Christian') echo ' selected'; ?>>Christian</option>
                                <option value="Other">Other</option>
                            </select>
                            <?php
                               if (isset($_SESSION['error-text']['religion'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['religion']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['religion']);
                            }
                            ?>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Date of Birth</label>
                            <input type="text" id="datepicker" name="dob" value="<?php echo $result_array['0']['dob']; ?>" class="form-control form-control-sm" autocomplete="off">
                            <?php
                               if (isset($_SESSION['error-text']['dob'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['dob']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['dob']);
                            }
                            ?>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Discount</label>
                            <input type="text" name="discount" value="<?php echo $result_array['0']['discount']; ?>" class="form-control form-control-sm" placeholder="Enter discount">
                            <?php
                               if (isset($_SESSION['error-text']['discount'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['discount']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['discount']);
                            }
                            ?>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Year</label>
                            <select name="year_id" class="form-control form-control-sm">
                                <option value="">Select Year</option>
                                <?php
                                    foreach ($years as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"<?php if ($result_array['0']['year']['name'] == $value['name']) echo ' selected'; ?> ><?php echo $value['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <?php
                               if (isset($_SESSION['error-text']['year_id'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['year_id']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['year_id']);
                            }
                            ?>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Class</label>
                            <select name="class_id" class="form-control form-control-sm">
                                <option value="">Select Class</option>
                                <?php
                                    foreach ($classes as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"<?php if ($result_array['0']['class']['name'] == $value['name']) echo ' selected'; ?> ><?php echo $value['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <?php
                               if (isset($_SESSION['error-text']['class_id'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['class_id']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['class_id']);
                            }
                            ?>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Group</label>
                            <select name="group_id" class="form-control form-control-sm">
                                <option value="">Select Group</option>
                                <?php
                                    foreach ($groups as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"<?php if ($result_array['0']['group']['name'] == $value['name']) echo ' selected'; ?> ><?php echo $value['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <?php
                               if (isset($_SESSION['error-text']['group_id'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['group_id']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['group_id']);
                            }
                            ?>
                        </div>
                        <div class="from-group col-lg-4">
                            <label>Section</label>
                            <select name="section_id" class="form-control form-control-sm">
                                <option value="">Select Section</option>
                                <?php
                                    foreach ($sections as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"<?php if ($result_array['0']['section']['name'] == $value['name']) echo ' selected'; ?> ><?php echo $value['name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <?php
                               if (isset($_SESSION['error-text']['section_id'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['section_id']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['section_id']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $result_array['0']['email'] ?>" class="form-control form-control-sm">
                            <?php
                               if (isset($_SESSION['error-text']['email'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['email']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['email']);
                            }
                            ?>
                        </div>
                        <!-- <div class="from-group col-lg-4">
                            <label>Student Photo</label><br>
                            <input name="sphoto" type="file" id="fileInput"><br>
                            
                        </div> -->
                        <div class="from-group col-lg-4">
                            <label for="formFileSm" class="form-label">Student Photo</label>
                            <input class="form-control form-control-sm" id="formFileSm" type="file" name="sphoto">
                            <?php
                               if (isset($_SESSION['error-text']['sphoto'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['sphoto']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['sphoto']);
                            }
                            ?>
                            <?php
                               if (isset($_SESSION['error-text']['sphotoType'])) {
                                ?>
                                <span style="font-size:14px;color:red;"><?php echo $_SESSION['error-text']['sphotoType']; ?></span>
                                <?php
                                unset($_SESSION['error-text']['sphotoType']);
                            }
                            ?>
                        </div>
                        <div class="form-group col-lg-4">
                        <img id="previewImage" src="#" alt="Selected Image" style="height:70px; width:50px; display: none;">
                        </div>
                        <div class="form-group col-lg-12">
                        <?php
                        echo '<img class="img-fluid" style="width: 110px; height: 150px; border:4px solid white; padding:5px;"  src="' . $image_path . '" alt="Student Image">';
                        ?>
                        </div>
                        <div class="form-group col-lg-12">
                            <button type="submit" class="btn btn-block bg-dark" name="btn-promotion">Promote This Student</button>
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
<style>
    .ui-datepicker-header {
      background-color: #007BFF; /* Set your desired background color */
      color: #ffffff; /* Set your desired font color */
    }
    .ui-datepicker-calendar td a.ui-state-hover {
      background-color: #007BFF; /* Set your desired hover background color */
      color: #ffffff; /* Set your desired hover font color */
    }
    .ui-datepicker-calendar td a.ui-state-active {
      background-color: red; /* Set your desired selected background color */
      color: red; /* Set your desired selected font color */
    }
</style>
<script>
  $(function() {
    // Initialize the Datepicker
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd", // Format of the date displayed in the input
        // minDate: 0, // Minimum date (0 means today)
        // maxDate: "+1y", // Maximum date (+1y means one year from today)
        showButtonPanel: false, // Show a button panel below the Datepicker
        changeMonth: true, // Allow changing months
        changeYear: true, // Allow changing years
        yearRange: "1990:2030"
    });
    
  });
</script>
<script>
  $(document).ready(function() {
    // Handle file input change event
    $("#formFileSm").change(function() {
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
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>