<script type="text/javascript">
    // Force Delete
    $(document).on('click', '.force', function(){
        id = $(this).attr('id');
        swal({
            title: "{{ trans('admin.force_msg') }}",
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
                    url: getLocation + "/force/" + id,
                    success: function(data){
                        $('#data-table').DataTable().ajax.reload();
                        $('#trash-table').DataTable().ajax.reload();
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.forced_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.forced_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }
                });
            }
        });
    });
</script>
