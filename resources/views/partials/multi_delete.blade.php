<script type="text/javascript">
    // Multiple Delete
    $(document).on('click', '.multi_delete', function(){
        var allids = [];
        $('.item_checkbox:checked').each(function() {
            allids.push($(this).attr('data-id'))
        });
        var item_checked = allids.length;
        var string_ids = allids.join(",");
        var swalAlert;
        if (item_checked > 0) {
            swalAlert = swal({
                title: "{{ trans('admin.multi_delete') }} "+ item_checked +"!",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ trans('admin.yes') }}',
                cancelButtonText: '{{ trans('admin.cancel') }}'
            })
        } else {
            swalAlert = swal({
                title: "{{ trans('admin.no_multi_data') }}",
                type: "warning",
                showCloseButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                focusCancel: true,
                cancelButtonColor: '#222223',
                cancelButtonText: '{{ trans('admin.close') }}'
            })
        }
        swalAlert.then(function(result){
            if(result.value){
                $.ajax({
                    url: getLocation + "/destroy/all",
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'ids=' + string_ids,
                    success: function(data){
                        $('#data-table').DataTable().ajax.reload();
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.deleted_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.deleted_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }
                });
            }
        });
    });
</script>
