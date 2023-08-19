<?php
$title = "Student List";
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
    $query1 = "SELECT * FROM years";
    $query1_run = mysqli_query($conn, $query1);
    $years = mysqli_fetch_all($query1_run, MYSQLI_ASSOC);

    $query2 = "SELECT * FROM classes";
    $query2_run = mysqli_query($conn, $query2);
    $classes = mysqli_fetch_all($query2_run, MYSQLI_ASSOC);

    $query3 = "SELECT * FROM sections";
    $query3_run = mysqli_query($conn, $query3);
    $sections = mysqli_fetch_all($query3_run, MYSQLI_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $yearId = $_POST['year_id'];
        $classId = $_POST['class_id'];
        $sectionId = $_POST['section_id'];

        $sql = "SELECT students.*,assign_students.*,discount_students.*,users.email,users.code
        FROM students
        INNER JOIN assign_students ON students.id = assign_students.student_id
        INNER JOIN users ON students.id = users.student_id
        INNER JOIN discount_students ON assign_students.id = discount_students.assign_student_id
        WHERE assign_students.year_id = '$yearId' AND assign_students.class_id = '$classId' AND assign_students.section_id = '$sectionId'";
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
    }

   
    // echo "<pre>";
    // print_r($result_array);
    // echo "</pre>";
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Student List</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Student List</li>
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
                    echo notification();
                ?>
                <div class="card">
                    <div class="card-body">


                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-row">
                                <div class="form-group col-3">
                                    <label for="">Year</label>
                                    <select name="year_id" id="year" class="form-control form-control-sm">
                                        <option value="">Select Year</option>
                                        <?php
                                        foreach ($years as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger" id="year-error"></span>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Class</label>
                                    <select name="class_id" id="class" class="form-control form-control-sm">
                                        <option value="">Select Class</option>
                                        <?php
                                        foreach ($classes as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger" id="class-error"></span>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Section</label>
                                    <select name="section_id" id="section" class="form-control form-control-sm">
                                        <option value="">Select Section</option>
                                        <?php
                                        foreach ($sections as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text-danger" id="section-error"></span>
                                </div>
                                <div class="form-group col-3">
                                    <Button type="submit" class="btn btn-success btn-sm" style="margin-top: 32px;">Search</Button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                    <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="card-title">Student List</h5>
                        <a href="student_registration.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Student Registration</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-warning table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Student Name</th>
                                        <th class="text-center">Student ID</th>
                                        <th class="text-center">Class</th>
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Section</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($result_array)) {
                                        foreach ($result_array as $key => $value) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $key + 1; ?></td>
                                                <td class="text-center"><?php echo $value['name']; ?></td>
                                                <td class="text-center"><?php echo $value['id_no']; ?></td>
                                                <td class="text-center"><?php echo $value['class']['name']; ?></td>
                                                <td class="text-center"><?php echo $value['year']['name']; ?></td>
                                                <td class="text-center"><?php echo $value['section']['name']; ?></td>
                                                <td class="text-center"><?php echo $value['code']; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                                        <a href="student_details.php?student_id=<?php echo $value['student_id'] ?>" type="button" class="btn bg-dark btn-sm"><i class="fas fa-info-circle" title="Details" style="color: red;"></i></a>

                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
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


<script>
    $(document).ready(function() {
        $("form").submit(function(event) {
            let year = $("#year").val();
            let class_name = $("#class").val();
            let section_name = $("#section").val();

            let year_error = $("#year-error");
            let class_error = $("#class-error");
            let section_error = $("#section-error");

            if(year === ''){
                year_error.text('Please select a year.');
                event.preventDefault();
            }else if(class_name === ''){
                class_error.text('Please select a class.');
                event.preventDefault();
            }else if(section_name === ''){
                section_error.text('Please select a section.');
                event.preventDefault();
            }else{
                year_error.text('');
                class_error.text('');
                section_error.text('');
            }
        });
    });
</script>

<?php
include($basePath . '/PHP_SCHOOL/sms/admin/includes/footer.php');
?>