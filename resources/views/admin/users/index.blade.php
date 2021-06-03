@extends('layouts.admin')
@section('title') {{ trans('admin.users') }} @endsection

@section('content')

<div class="content-body">
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title"><b>{{ trans('admin.users') }}</b></h4>
                    </div>
                    <div class="table-responsive" style="padding: 10px">
                        <table id="data-table"
                            class="table table-striped table-bordered table-hover table-sm dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th class="image">{{ trans('admin.image') }}</th>
                                    <th>{{ trans('admin.data') }}</th>
                                    <th>{{ trans('admin.last_login') }}</th>
                                    <th>{{ trans('admin.created_at') }}</th>
                                    <th>{{ trans('admin.actions') }}</th>
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
@include('partials.multi_delete')

<script type="text/javascript">
    var getLocation = "users";
    $(document).ready(function(){
        // DataTable
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            drawCallback: function(settings){ feather.replace(); },
            order: [[ 3, "desc" ]],
            ajax: {
                url: "{{ route('admin.users.index') }}",
            },
            columns: [
                { data: 'id' },
                {
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                { data: 'image_path',
                    render: function(data, type, row, meta) {
                        return "<img src=" + data + " width='50px' class='img-thumbnail' />";
                    }, searchable: false, orderable: false
                },
                { data: 'full_name',
                    render: function(data, type, row, meta){
                        var text1 = "<div><b>{{ trans('admin.full_name') }}: </b>"+ row.full_name +" - </div>";
                        var text2 = "<div><b>{{ trans('admin.email') }}: </b>"+ row.email +"</div>";
                        return text1 + text2;
                    }
                },
                { data: 'last_login_at', className: 'last_login_at',
                    render: function(data, type, row, meta){
                        var text1 = "<div>"+ data +" - </div>";
                        var text2 = "<div>"+ row.last_login +"</div>";
                        return text1 + text2;
                    }
                },
                { data: 'created_at', className: 'created_at',
                    render: function(data, type, row, meta){
                        var text1 = "<div>"+ data +" - </div>";
                        var text2 = "<div>"+ row.created_date +"</div>";
                        return text1 + text2;
                    }
                },
                { data: 'action', orderable: false,
                    render: function(data, type, row, meta) {
                        // Action Buttons
                        return (
                            '<span>' +
                                '@if(auth()->user()->can('update_users'))' +
                                    '<a id="'+ row.id +'" href="users/'+ row.id +'/edit" name="edit" class="item-edit edit mr-1" title="{{ trans("admin.edit") }}">' +
                                    feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                                    '</a>' +
                                '@endif' +
                            '</span>' +
                            '<span>' +
                                '@if(auth()->user()->can('delete_users'))' +
                                    '<a id="'+ row.id +'" class="item-edit delete" title="{{ trans("admin.delete") }}">' +
                                    feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                                    '</a>' +
                                '@endif' +
                            '</span>'
                        );
                    }
                }
            ],
            "columnDefs": [
            {
                // Checkboxes
                "targets": 0,
                orderable: false,
                responsivePriority: 3,
                render: function(data, type, row, meta) {
                    return (
                        '<div class="custom-control custom-checkbox">' +
                            '<input class="custom-control-input dt-checkboxes item_checkbox" data-id="'+ row.id +'" type="checkbox" id="'+ row.id +'" />' +
                            '<label class="custom-control-label" for="'+ row.id +'"></label>' +
                        '</div>'
                    );
                },
                checkboxes: {
                    selectAllRender:
                        '<div class="custom-control custom-checkbox">' +
                            '<input class="custom-control-input" type="checkbox" id="checkboxSelectAll" />' +
                            '<label class="custom-control-label" for="checkboxSelectAll"></label>' +
                        '</div>'
                }
            } ],
            dom:  "<'row'<''l><'col-sm-8 text-center'B><''f>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { text: '<i data-feather="refresh-ccw"></i> {{ trans("admin.refresh") }}',
                  className: 'btn dtbtn btn-sm btn-dark',
                  attr: { 'title': '{{ trans("admin.refresh") }}' },
                    action: function (e, dt, node, config) {
                        dt.ajax.reload(null, false);
                    }
                },
                { text: '<i data-feather="trash-2"></i> {{ trans("admin.trash") }}',
                  className: '@if (auth()->user()->can("trash_users")) btn dtbtn btn-sm btn-danger multi_delete @else btn dtbtn btn-sm btn-danger disabled @endif',
                  attr: { 'title': '{{ trans("admin.trash") }}' }
                },
                { extend: 'csvHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i data-feather="file"></i> CSV',
                  attr: { 'title': 'CSV' }
                },
                { extend: 'excelHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-success',
                  text: '<i data-feather="file"></i> Excel',
                  attr: { 'title': 'Excel' }
                },
                { text: '<i data-feather="printer"></i> {{ trans("admin.print") }}',
                  className: '@if (auth()->user()->can("print_users")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  extend: 'print', attr: { 'title': '{{ trans("admin.print") }}' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-danger',
                  text: '<i data-feather="file"></i> PDF',
                  pageSize: 'A4', attr: { 'title': 'PDF' }
                },
                { text: '<i data-feather="plus"></i> {{ trans("admin.create_user") }}',
                  className: '@if (auth()->user()->can("create_users")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  attr: {
                        'title': '{{ trans("admin.create_user") }}',
                        href: '{{ route("admin.users.create") }}'
                    },
                    action: function (e, dt, node, config)
                    {
                        // href location
                        window.location.href = '{{ route("admin.users.create") }}';
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

</script>

@endpush
