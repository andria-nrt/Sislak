<!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  </div><!--wrapper-->



  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('/expert/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/js/bootstrap-treeview.js') }}"></script>
  <!-- simplebar js -->
  <script src="{{ asset('/expert/assets/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- waves effect js -->
  <script src="{{ asset('/expert/assets/js/waves.js') }}"></script>
  <!-- sidebar-menu js -->
  <script src="{{ asset('/expert/assets/js/sidebar-menu.js') }}"></script>
  <!-- Custom scripts -->
  <script src="{{ asset('/expert/assets/js/app-script.js') }}"></script>
  <!--Form Validatin Script-->
  <script src="{{ asset('/expert/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
  <!--notification js -->
  <script src="{{ asset('/expert/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/notifications/js/notifications.min.js') }}"></script>
  <!--Sweet Alerts -->
  <script src="{{ asset('/expert/assets/plugins/alerts-boxes/js/sweetalert.min.js') }}"></script>
  <!--Bootstrap Datepicker Js-->
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

  <!--Select Plugins Js-->
  <script src="{{ asset('/expert/assets/plugins/select2/js/select2.min.js') }}"></script>

  <!--Data Tables js-->
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/jszip.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/pdfmake.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/vfs_fonts.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('/expert/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js') }}"></script>

  <script src="{{ asset('/expert/assets/js/custom.js') }}"></script>
  <script>
        $(document).ready(function() {
            $('.single-select').select2();
        });
  </script>

  @yield('js')  
  
</body>
</html>