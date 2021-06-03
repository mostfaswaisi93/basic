<script type="text/javascript">
    // Restore Data
    $(document).on('click', '.restore', function(){
        id = $(this).attr('id');
        swal({
            title: "{{ trans('admin.restore_msg') }}",
            type: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('admin.restore') }}',
            cancelButtonText: '{{ trans('admin.cancel') }}'
        }).then(function(result){
            if(result.value){
                $.ajax({
                    url: getLocation + "/restore/" + id,
                    success: function(data){
                        $('#data-table').DataTable().ajax.reload();
                        $('#trash-table').DataTable().ajax.reload();
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.restore_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.restore_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }
                });
            }
        });
    });
</script>
