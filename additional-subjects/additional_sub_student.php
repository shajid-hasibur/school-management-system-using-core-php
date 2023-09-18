<?php
$title = "Assign Additional Subject";
$basePath = $_SERVER['DOCUMENT_ROOT'];
include($basePath . '/PHP_SCHOOL/sms/admin/authorisation.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/header.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/topbar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sidebar.php');
include($basePath . '/PHP_SCHOOL/sms/admin/includes/sessions.php');
include($basePath . '/PHP_SCHOOL/sms/admin/authentication.php');
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/database.php');
include($basePath . '/PHP_SCHOOL/sms/admin/configuration/connection.php');
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Additional Subject Student</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Additional Subject Student</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php
        if (isset($_GET['student_id'])) {
            $id = $_GET['student_id'];

            $sql = "SELECT students.*,assign_students.*,discount_students.*,users.email,users.code
            FROM students
            INNER JOIN assign_students ON students.id = assign_students.student_id
            INNER JOIN users ON students.id = users.student_id
            INNER JOIN discount_students ON assign_students.id = discount_students.assign_student_id WHERE students.id = '$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $result_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($result_array as &$row) {
                    $year_id = $row['year_id'];
                    $class_id = $row['class_id'];
                    $group_id = $row['group_id'];
                    $section_id = $row['section_id'];
                    $add_subject_id = $row['add_subject_id'];

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

                    $add_sub_query = "SELECT * FROM subjects WHERE id = '$add_subject_id'";
                    $sub_result = mysqli_query($conn, $add_sub_query);
                    $sub_data = mysqli_fetch_assoc($sub_result);
                    $row['additional_subject'] = $sub_data;
                }
            }
            $image_path = $row['image_path'];
            $image_url = 'http://localhost/PHP_SCHOOL/sms/admin/students/' . $image_path;

            $db = new Database();
            $db->select("subjects","*","","status=1");
            $result = $db->getResult();
        }
        ?>
        <div class="row">
            <div class="col-12">
                <?php 
                    echo SuccessMessage();
                    echo notification();
                ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title float-left">Additional Subject Student</div>
                        <div class="float-right">
                            <a class="btn btn-success btn-sm" href="assign_additional_subject.php"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <?php
                                        echo '<img class="img-fluid" style="width: 110px; height: 150px; border:4px solid white; padding:5px;"  src="' . $image_url . '" alt="Student Image">';
                                        ?>
                                        <h5 class="my-3"><strong><?php echo $row['name']; ?></strong></h5>
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
                                        <strong>
                                            <p class="text-muted mb-1"><mark>Assigned Additional Subject : <?php echo isset($row['additional_subject']['name']) ? $row['additional_subject']['name'] : 'N/A'; ?></mark></p>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-header text-center">
                                        <span><b>Select a additional subject from dropdown</b></span>
                                    </div>
                                    <div class="card-body">
                                        <form action="additional_subject_code.php" method="post">
                                        <label for="">Subjects :</label>
                                            <select name="add_subject_id" id="" class="form-control col-10">
                                                <option value="">Select Additional Subject</option>
                                                <?php 
                                                    foreach ($result as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                            <input type="hidden" name="student_id" value="<?php echo $id; ?>">
                                            <button type="submit" name="sub-assign" class="btn btn-success mt-2">Submit</button>
                                        </form>
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
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>