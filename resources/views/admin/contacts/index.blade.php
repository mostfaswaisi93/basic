@extends('layouts.admin')
@section('title') {{ trans('admin.contacts') }} @endsection

@section('content')

<div class="content-body">
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title"><b>{{ trans('admin.contacts') }}</b></h4>
                    </div>
                    <div class="card-body mt-2">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-row mb-1">
                                        <div class="col-lg-2">
                                            <label for="filterStatus">{{ trans('admin.status') }}:</label>
                                            <select id="filterStatus" class="form-control"
                                                onchange="filter_status(this);">
                                                <option value="" selected="selected">{{ trans('admin.all') }}</option>
                                                <option value='1'>{{ trans('admin.active') }}</option>
                                                <option value='0'>{{ trans('admin.inactive') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="my-0" />
                    <div class="table-responsive" style="padding: 10px">
                        <table id="data-table"
                            class="table table-striped table-bordered table-hover table-sm dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>{{ trans('admin.name') }}</th>
                                    <th class="status">{{ trans('admin.status') }}</th>
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
@include('partials.status')
@include('partials.multi_delete')

<script type="text/javascript">
    var getLocation = "contacts";
    $(document).ready(function(){
        // DataTable
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            drawCallback: function(settings){ feather.replace(); },
            order: [[ 2, "desc" ]],
            ajax: {
                url: "{{ route('admin.contacts.index') }}",
            },
            columns: [
                { data: 'id' },
                {
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                { data: 'name_trans' },
                { data: 'enabled' },
                { data: 'created_at', className: 'created_at' },
                { data: 'action', orderable: false,
                    render: function(data, type, row, meta) {
                        // Action Buttons
                        return (
                            '<span>' +
                                '@if(auth()->user()->can('update_contacts'))' +
                                    '<a id="'+ row.id +'" name="edit" class="item-edit edit mr-1" data-toggle="modal" data-target="#contactModal" title="{{ trans("admin.edit") }}">' +
                                    feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                                    '</a>' +
                                '@endif' +
                            '</span>' +
                            '<span>' +
                                '@if(auth()->user()->can('delete_contacts'))' +
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
            },
            {
                "targets": 4,
                render: function (data, type, row, meta){
                    var $checked = $(`
                        <div class="custom-switch-status">
                            <div class="custom-control custom-switch custom-switch-success">
                                <input type="checkbox" data-id="${row.id}" id="status(${row.id})" 
                                class="custom-control-input status" ${ row.enabled == 1 ? 'checked' : '' }
                                onchange=selectStatus(${row.id}) >
                                <label class="custom-control-label" for="status(${row.id})" title="{{ trans('admin.update_status') }}">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>
                        </div>
                    `);
                    $checked.prop('checked', true).attr('checked', 'checked');
                    return $checked[0].outerHTML
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
                  className: '@if (auth()->user()->can("trash_contacts")) btn dtbtn btn-sm btn-danger multi_delete @else btn dtbtn btn-sm btn-danger disabled @endif',
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
                  className: '@if (auth()->user()->can("print_contacts")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  extend: 'print', attr: { 'title': '{{ trans("admin.print") }}' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true, 
                  className: 'btn dtbtn btn-sm btn-danger',
                  text: '<i data-feather="file"></i> PDF',
                  pageSize: 'A4', attr: { 'title': 'PDF' }
                },
                { text: '<i data-feather="plus"></i> {{ trans("admin.create_contact") }}',
                  className: '@if (auth()->user()->can("create_contacts")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  attr: {
                    'title': '{{ trans("admin.create_contact") }}',
                    'data-toggle': 'modal',
                    'data-target': '#contactModal',
                    'name': 'create_contact',
                    'id': 'create_contact' }
                },
            ],
            language: {
                url: getDataTableLanguage(),
                search: ' ',
                searchPlaceholder: '{{ trans("admin.search") }}...'
            }
        });
    });

    // Filter Status
    function filter_status(enabled_filter = null){
        enabled = enabled_filter.value;
        $('#data-table').DataTable().ajax.url(getLocation +'?enabled='+ enabled +'&type=filter').load();
    }
</script>

@endpush