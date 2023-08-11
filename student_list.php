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
    $sql = "SELECT students.*,assign_students.*,discount_students.*,users.email,users.code
    FROM students
    INNER JOIN assign_students ON students.id = assign_students.student_id
    INNER JOIN users ON students.id = users.student_id
    INNER JOIN discount_students ON assign_students.id = discount_students.assign_student_id";
    $result = mysqli_query($conn,$sql);
    if($result){
        $result_array = mysqli_fetch_all($result,MYSQLI_ASSOC);
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
                <div class="card">
                    <div class="card-header bg-dark">
                        <h5 class="card-title">Student Group</h5>
                        <a href="student_registration.php" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i>&nbsp;Student Registration</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-inverse table-bordered table-hover">
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
                                        if($result_array){
                                            foreach ($result_array as $key => $value) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $key+1; ?></td>
                                                        <td class="text-center"><?php echo $value['name']; ?></td>
                                                        <td class="text-center"><?php echo $value['id_no']; ?></td>
                                                        <td class="text-center"><?php echo $value['class']['name']; ?></td>
                                                        <td class="text-center"><?php echo $value['year']['name']; ?></td>
                                                        <td class="text-center"><?php echo $value['section']['name']; ?></td>
                                                        <td class="text-center"><?php echo $value['code']; ?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                                <button type="button" class="btn bg-dark btn-sm"><i class="fas fa-edit"></i></button>
                                                                <button type="button" class="btn bg-dark btn-sm"><i class="fas fa-info-circle"></i></button>
                                                                <button type="button" class="btn bg-dark btn-sm"><i class="fas fa-trash"></i></button>
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

<?php
include('includes/footer.php');
?>