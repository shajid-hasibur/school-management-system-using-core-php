<?php
$title = "Student List";
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('authentication.php');
include('configuration/connection.php');
include('includes/sessions.php');
?>

<div class="content-wrapper">
    <?php
        if (isset($_GET['student_id'])) {
            $student_id = $_GET['student_id'];
        }
    ?>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="send_mail.php" method="post">
                    <input type="hidden" name="page_id" value="<?php echo $student_id; ?>">
                    <div class="modal-header bg-red">
                        <h5 class="modal-title" id="staticBackdropLabel">Send Mail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>To</label>
                        <input type="text" class="form-control form-control-sm" name="to" id="to">
                        <label>Subject</label>
                        <input type="text" class="form-control form-control-sm" name="mail_subject">
                        <label>Body</label>
                        <textarea name="mail_body" class="form-control form-control-sm" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="btn-send" class="btn btn-danger">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    //getting the student id from url
    // if (isset($_GET['student_id'])) {
    //     $student_id = $_GET['student_id'];
    // }

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

    $image_path = $row['image_path'];
    // echo $image_path;
    // echo "<pre>";
    // print_r($result_array);
    // echo "</pre>";
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Student Details</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Student Details</li>
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
                        <h5 class="card-title">Student Profile</h5>
                        <a href="student_list.php" class="btn btn-success btn-sm float-right"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center" style="background-color: #d1f4ff">
                                        <?php
                                        echo '<img class=" img-fluid" style="width: 110px; height: 150px;"  src="' . $image_path . '" alt="Student Image">';
                                        ?>
                                        <h5 class="my-3"><?php echo $row['name']; ?></h5>
                                        <strong>
                                            <p class="text-muted mb-1">Student ID : <?php echo $row['id_no']; ?></p>
                                        </strong>
                                        <strong>
                                            <p class="text-muted mb-1">Class : <?php echo $row['class']['name']; ?></p>
                                        </strong>
                                        <strong>
                                            <p class="text-muted mb-1">Year : <?php echo $row['year']['name']; ?></p>
                                        </strong>
                                        <strong>
                                            <p class="text-muted mb-1">Section : <?php echo $row['section']['name']; ?></p>
                                        </strong>
                                        <strong>
                                            <p class="text-muted mb-1">Group : <?php echo $row['group']['name']; ?></p>
                                        </strong>
                                        <strong>
                                            <p class="text-muted mb-1">Discount : <?php echo $row['discount'] . '%'; ?></p>
                                        </strong>
                                        <div class="d-flex justify-content-center mb-2">
                                            <button id="myButton" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-warning"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;Send Mail</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body" style="background-color: #d1f4ff">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Student Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['name']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Father's Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['fname']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Mother's Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['mname']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Gender</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['gender']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Religion</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['religion']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Date of Birth</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['dob']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Registration Date</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['created_at']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p  class="text-muted mb-0"><?php echo $row['email']; ?></p>
                                                <input type="hidden" id="get-mail" value="<?php echo $row['email']; ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Phone</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['contact_number']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Present Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['address1']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Permanent Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['address2']; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Login Password</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row['code']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card" style="background-color: #d1f4ff">
                                    <div class="card-body mt-3 mb-3 d-flex justify-content-center align-items-center">
                                        <a href="" class="btn bg-dark" style="width: 180px;"><i class="fas fa-graduation-cap" style="color: red;"></i>&nbsp;Promotion</a>
                                        <a href="" class="btn bg-dark" style="width: 180px; margin-left: 10px;"><i class="fas fa-trash" style="color: red;"></i>&nbsp;Delete Record</a>
                                        <a href="" class="btn bg-dark" style="width: 180px; margin-left: 10px;"><i class="fas fa-edit" style="color: red;"></i>&nbsp;Update Information</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>

<script>
    let button = document.getElementById("myButton");
    button.addEventListener("click",function(){
        let tag = document.getElementById("get-mail");
        let value = tag.value;
        let field = document.getElementById("to");
        field.value = value;
    })
</script>