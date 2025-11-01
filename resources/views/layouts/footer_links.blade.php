<!-- CORE PLUGINS-->
<script src="{{asset('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendors/metisMenu/dist/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-idletimer/dist/idle-timer.min.js')}}"></script>
<script src="{{asset('assets/vendors/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="{{asset('assets/vendors/dataTables/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/scripts/toastr-demo.js')}}"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src="{{asset('assets/vendors/bootstrap-sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- CORE SCRIPTS-->
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#datatable').DataTable({
            pageLength: 10, // Default to 10 rows per page
            fixedHeader: true,
            responsive: true,
            "sDom": 'rtip',
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }]
        });

        // Listen for keyup events on the search box
        $('#key-search').on('keyup', function () {
            table.search(this.value).draw();
        });

        // Listen for change event on the type-filter
        $('#type-filter').on('change', function () {
            table.column(4).search($(this).val()).draw();
        });

        // Listen for change event on rows-per-page filter
        $('#rows-per-page').on('change', function () {
            var pageLength = $(this).val();
            table.page.len(pageLength).draw();
        });
    });
</script>

@if(Session::has('message'))
    @php $type = Session::get('alert-type', 'info') @endphp
    <script type="text/javascript">
        $(function () {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000"
            };

            @if(trim($type) == "success")
            toastr.success("{{ session('message') }}", "Success");
            @elseif(trim($type) == "error")
            toastr.error("{{ session('message') }}", "Error");
            @elseif(trim($type) == "warning")
            toastr.warning("{{ session('message') }}", "Warning");
            @elseif(trim($type) == "info")
            toastr.info("{{ session('message') }}", "Info");
            @endif
        });
    </script>
@endif

@yield('Scripts')
