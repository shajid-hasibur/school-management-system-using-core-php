
  <!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-dark">
    <!-- Brand Logo -->
    <a href="/PHP_SCHOOL/sms/admin/dashboard.php" class="brand-link">
      <img src="/PHP_SCHOOL/sms/admin/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PHPSMS</span>
    </a>

    <!-- Sidebar -->
  <div class="sidebar">
  <?php
    $username = $_SESSION['auth_user']['user_name'];
  ?>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/PHP_SCHOOL/sms/admin/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $username; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
              <a href="/PHP_SCHOOL/sms/admin/users/users.php" class="nav-link">
                <i style="color:#fa3939;" class="fas fa-users"></i>
                <p style="color:white;">Users</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="fas fa-school" style="color: #fa3939;"></i>
                <p style="color:white;">
                  Environment Setup
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/student-years/student-year.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Student Year</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/student-classes/student_class.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Student Class</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/student-groups/student_group.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Student Group</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/student-sections/student_section.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Student Section</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/fee-categories/fee_category.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Fee Category</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/fee-categories-amount/fee_category_amount.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Fee Category Amount</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/exam-types/exam_type.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Exam Types</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/subjects/subject.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">School Subjects</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/assign-subjects/assign_subject.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Assign Subjects</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/additional-subjects/assign_additional_subject.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-arrow-right"></i>
                    <p style="color:white;">Additional Subjects</p>
                  </a>
                </li>
              </ul>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="fas fa-graduation-cap" style="color: #fa3939;"></i>
                <p style="color:white;">
                  Students Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/students/student_registration.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-plus-circle"></i>
                    <p style="color:white;">Student Registration</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/students/student_list.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-search"></i>
                    <p style="color:white;">Search Students</p>
                  </a>
                </li>
              </ul>
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="fas fa-book-open" style="color: #fa3939;"></i>
                <p style="color:white;">
                  Marks Management
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-plus-circle"></i>
                    <p style="color:white;">Marks Entry</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-edit"></i>
                    <p style="color:white;">Marks Edit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/PHP_SCHOOL/sms/admin/grades/grades.php" class="nav-link">
                    <i style="color:#fa3939;" class="fas fa-atom"></i>
                    <p style="color:white;">Grades</p>
                  </a>
                </li>
              </ul>
          </li>
      </ul>
    </nav>
      <!-- /.sidebar-menu -->
  </div>
    <!-- /.sidebar -->
</aside>

  <!-- Content Wrapper. Contains page content -->