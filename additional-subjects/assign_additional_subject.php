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
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Assign Additional Subject</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Assign Additional Subject</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        $db = new Database();
        $db->select("years", "*");
        $years = $db->getResult();

        $db->select("classes", "*");
        $classes = $db->getResult();

        $db->select("groups", "*");
        $groups = $db->getResult();
        ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Additional Subject Students</div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="year_id">Year</label>
                                <select name="year_id" id="year_id" class="form-control">
                                    <option value="">Select Year</option>
                                    <?php
                                    foreach ($years as $year) {
                                    ?>
                                        <option value="<?php echo $year['id']; ?>"><?php echo $year['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="class_id">Class</label>
                                <select name="class_id" id="class_id" class="form-control">
                                    <option value="">Select Class</option>
                                    <?php
                                    foreach ($classes as $class) {
                                    ?>
                                        <option value="<?php echo $class['id']; ?>"><?php echo $class['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="group_id">Group</label>
                                <select name="group_id" id="group_id" class="form-control">
                                    <option value="">Select Group</option>
                                    <?php
                                    foreach ($groups as $group) {
                                    ?>
                                        <option value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group col-3">
                                <button id="search-btn" name="btn-search" class="btn btn-success" type="button" style="margin-top: 32px;">Search</button>
                            </div>
                        </div>
                        <div class="d-none" id="student-table" style="margin-top: 20px;">
                                <table class="table table-bordered" id="">
                                    <thead class="table table-success">
                                        <tr class="text-center">
                                            <th>Student Name</th>
                                            <th>Student Id</th>
                                            <th>Year</th>
                                            <th>Class</th>
                                            <th>Group</th>
                                            <th>Additional Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="student-tbody">

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
        $(document).on('click', '#search-btn', function() {
            let year_id = $('#year_id').val();
            let class_id = $('#class_id').val();
            let group_id = $('#group_id').val();
            let button = $(this).attr('name');

            $.ajax({
                url: "additional_subject_code.php",
                type: "POST",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'group_id': group_id,
                    'btn-search': button,
                },
                dataType: "JSON",
                success: function(res) {
                    console.log(res);
                    let html = "";
                    $('#student-table').removeClass('d-none');
                    $.each(res,function(key,value){
                        let additionalSubjectName = (value.additional_subject && value.additional_subject.name) ? value.additional_subject.name : 'N/A';
                        html += 
                        '<tr class="text-center">' +
                            '<td>' + value.name + '</td>'+
                            '<td>' + value.id_no + '</td>' +
                            '<td>' + value.year.name + '</td>' +
                            '<td>' + value.class.name + '</td>' +
                            '<td>' + value.group.name + '</td>' +
                            '<td>' + additionalSubjectName + '</td>' +
                            '<td>' + 
                                '<a href="additional_sub_student.php?student_id='+value.student_id+'" id="show" class="btn btn-success btn-sm">Assign</a>'
                            + '</td>' +
                        '</tr>';
                    });
                    $('#student-tbody').html(html);
                },
            });
        });
    });
</script>