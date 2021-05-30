<script type="text/javascript">
    // Delete
    $(document).on('click', '.delete', function(){
        id = $(this).attr('id');
        swal({
            title: "{{ trans('admin.delete_msg') }}",
            type: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('admin.yes') }}',
            cancelButtonText: '{{ trans('admin.cancel') }}'
        }).then(function(result){
            if(result.value){
                $.ajax({
                    url: getLocation + "/destroy/" + id,
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