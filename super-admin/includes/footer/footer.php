
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/chart.js/Chart.min.js"></script>
    <script src="../assets/plugins/sparklines/sparkline.js"></script>
    <script src="../assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="../assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="../assets/plugins/moment/moment.min.js"></script>
    <script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../assets/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../assets/dist/js/adminlte.js"></script>
    <script src="../assets/dist/js/pages/dashboard.js"></script>
    <script src="../assets/dist/js/select2.js"></script>
    <script src="../assets/dist/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function(){
            var select2 = $("select").select2({
                templateResult: formatOption
            });
            select2.data('select2').$selection.css('height', '38px');
            function formatOption (option) {
                var $option = $(
                    '<div><strong>' + option.text + '</strong></div>' +
                    '<small>' + option.title + '</small>'
                );
                return $option;
            };
        });
    </script>
    </body>
</html>