  <footer class="main-footer bg-dark">
    <strong>Copyright &copy; 2022-2023 <a href="#">Md.Hasibur Rahman</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<!-- jQuery -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- DataTables  & Plugins -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/jszip/jszip.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/moment/moment.min.js"></script>
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/PHP_SCHOOL/sms/admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/PHP_SCHOOL/sms/admin/assets/dist/js/adminlte.js"></script>
<!--AdminLTE for demo purposes --> 
<!-- <script src="assets/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="/PHP_SCHOOL/sms/admin/assets/dist/js/pages/dashboard.js"></script> 
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>