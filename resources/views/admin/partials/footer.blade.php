<!-- BEGIN: Footer -->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-md-left d-block d-md-inline-block">
            <b>{{ trans('admin.copyright') }} &copy; <span id="year"></span></b>
            <a href="https://github.com/mostfaswaisi93" title="Github">mostfaswaisi93</a>
            <b> - {{ trans('admin.all_rights') }}.</b>
        </span>
        <span class="float-md-right d-none d-md-block"><b>v1.0.0</b></span>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button">
    <i data-feather="arrow-up"></i>
</button>
<!-- END: Footer -->

<!-- BEGIN: Vendor JS -->
<script src="{{ url('backend/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS -->

<!-- BEGIN: Time Picker -->
<script src="{{ url('backend/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ url('backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<!-- END: Time Picker -->

<!-- BEGIN: Theme JS -->
<script src="{{ url('backend/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ url('backend/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS -->

<!-- Custom js -->
<script src="{{ url('backend/js/functions.js') }}"></script>
<script src="{{ url('backend/js/toastr.js') }}"></script>
<script src="{{ url('backend/js/image_preview.js') }}"></script>

<!-- CDNs -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- DataTables CDNs -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.foundation.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ url('backend/js/pdfMake/pdfmake.js') }}"></script>
<script src="{{ url('backend/js/pdfMake/vfs_fonts.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script src="{{ url('backend/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>

{!! Toastr::message() !!}

@stack('scripts')

</body>
<!-- END: Body -->

</html>