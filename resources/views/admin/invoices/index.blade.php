@extends('layouts.admin')
@section('title') {{ trans('admin.invoices') }} @endsection

@section('content')

<div class="content-body">
    <section>
        <div class="card">
            <div class="card-header">
                <div class="tbl-title">{{ trans('admin.invoices') }}</div>
            </div>
            <hr>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" class="check_all" onclick="check_all()" name="ids">
                                            <span class="vs-checkbox vs-checkbox-sm">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.status') }}</th>
                                    <th>{{ trans('admin.created_at') }}</th>
                                    <th>
                                        @if(auth()->user()->can(['update_invoices', 'delete_invoices']))
                                        {{ trans('admin.actions') }}
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')

@include('partials.delete')
{{-- @include('partials.multi_delete.blade') --}}

<script type="text/javascript">
    var getLocation = "invoices";
    $(document).ready(function(){
        // DataTable
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [[ 2, "desc" ]],
            ajax: {
                url: "{{ route('admin.invoices.index') }}",
            },
            columns: [
                {
                    render: function(data, type, row, meta) {
                        return '<div class="vs-checkbox-con vs-checkbox-primary"><input type="checkbox" name="item[]" class="item_checkbox" value="' + row.id + '"><span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check"><i class="vs-icon feather icon-check"></i></span></span></div>';
                    }, searchable: false, orderable: false
                },
                {
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                { data: 'name_trans' },
                { data: 'enabled',
                    render: function(data, type, row, meta) {
                        var text = data ? "{{ trans('admin.active') }}" : "{{ trans('admin.inactive') }}";
                        var color = data ? "success" : "danger"; 
                        return "<div class='badge badge-" +color+ "'>"+ text +"</div>";
                    }, searchable: false, orderable: false
                },
                { data: 'created_at' },
                { data: 'action', orderable: false }
            ],
            dom:  "<'row'<''l><'col-sm-8 text-center'B><''f>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { text: '<i class="feather icon-refresh-ccw"></i> {{ trans("admin.refresh") }}',
                  className: 'btn dtbtn btn-sm btn-dark',
                  attr: { title: '{{ trans("admin.refresh") }}' },
                    action: function (e, dt, node, config) {
                        dt.ajax.reload(null, false);
                    }
                },
                { text: '<i data-feather="trash-2"></i> {{ trans("admin.trash") }}',
                className: 'btn dtbtn btn-sm btn-danger multi_delete delBtn',
                  attr: { title: '{{ trans("admin.trash") }}' }
                },
                { extend: 'csvHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i class="feather icon-file"></i> CSV',
                  attr: { title: 'CSV' }
                },
                { extend: 'excelHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i class="feather icon-file"></i> Excel',
                  attr: { title: 'Excel' }
                },
                { extend: 'print', className: 'btn dtbtn btn-sm btn-primary',
                  text: '<i class="feather icon-printer"></i> {{ trans("admin.print") }}',
                  attr: { title: '{{ trans("admin.print") }}' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true, 
                  className: 'btn dtbtn btn-sm bg-gradient-danger',
                  text: '<i class="feather icon-file"></i> PDF',
                  pageSize: 'A4', attr: { title: 'PDF' }
                },
                { text: '<i class="feather icon-plus"></i> {{ trans("admin.create_invoice") }}',
                  className: '@if (auth()->user()->can("create_invoices")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  attr: {
                          title: '{{ trans("admin.create_invoice") }}',
                          href: '{{ route("admin.invoices.create") }}' 
                        },
                    action: function (e, dt, node, config)
                    {
                        // href location
                        window.location.href = '{{ route("admin.invoices.create") }}';
                    }
                },
            ],
            language: {
                url: getDataTableLanguage(),
                search: ' ',
                searchPlaceholder: '{{ trans("admin.search") }}...'
            }
        });
    });

    // Multiple Delete
    $(document).on('click', '.multi_delete', function(){
        var item_checked = $('input[class="item_checkbox"]:checkbox').filter(":checked").length;
        var allids = [];
        var swalAlert;
        if (item_checked > 0) {
            swalAlert = swal({
                title: "{{ trans('admin.multi_delete') }} "+ item_checked +"!",
                type: 'warning',
                showCloseButton: true,
                showCancelButton: true,
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
                cancelButtonColor: '#222223',
                cancelButtonText: '{{ trans('admin.close') }}'
            })
        }
        swalAlert.then(function(result){
            if(result.value){
                $.ajax({
                    type: "DELETE",
                    url: getLocation + "/multi" + item_checked,
                    success: function(data){
                        $('#data-table').DataTable().ajax.reload();
                        toastr.success('{{ trans('admin.deleted_successfully') }}!');
                    }
                });
            }
        });
    });
</script>

@endpush