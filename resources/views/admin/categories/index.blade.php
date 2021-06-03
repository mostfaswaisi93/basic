@extends('layouts.admin')
@section('title') {{ trans('admin.categories') }} @endsection

@section('content')

<div class="content-body">
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active" id="category-tab" data-toggle="tab"
                                    href="#category" aria-controls="category" role="tab" aria-selected="true">
                                    <i data-feather="list"></i><span
                                        class="d-none d-sm-block">{{ trans('admin.categories') }}</span>
                                </a>
                            </li>
                            @if(auth()->user()->can('trashlist_categories'))
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" id="trash-tab" data-toggle="tab"
                                    href="#trash" aria-controls="trash" role="tab" aria-selected="false">
                                    <i data-feather="info"></i><span
                                        class="d-none d-sm-block">{{ trans('admin.trashed') }}</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane table-responsive active" id="category" aria-labelledby="category-tab"
                            role="tabpanel" style="padding: 10px">
                            <table id="data-table"
                                class="table table-striped table-bordered table-hover table-sm dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>{{ trans('admin.name') }}</th>
                                        <th>{{ trans('admin.user') }}</th>
                                        <th>{{ trans('admin.created_at') }}</th>
                                        <th>{{ trans('admin.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="tab-pane table-responsive" id="trash" aria-labelledby="trash-tab" role="tabpanel"
                            style="padding: 10px">
                            <table id="trash-table"
                                class="table table-striped table-bordered table-hover table-sm dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('admin.name') }}</th>
                                        <th>{{ trans('admin.user') }}</th>
                                        <th>{{ trans('admin.deleted_at') }}</th>
                                        <th>{{ trans('admin.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.categories.modal')
    </section>
</div>

@endsection

@push('scripts')

@include('partials.delete')
@include('partials.force')
@include('partials.restore')
@include('partials.multi_delete')

<script type="text/javascript">
    var getLocation = "categories";
    $(document).ready(function(){
        // DataTable
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            drawCallback: function(settings){ feather.replace(); },
            order: [[ 2, "desc" ]],
            ajax: {
                url: "{{ route('admin.categories.index') }}",
            },
            columns: [
                { data: 'id' },
                {
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                { data: 'name_trans' },
                { data: 'user',
                    render: function(data, type, row, meta) {
                        return "<div class='badge badge-light-primary'>"+ data +"</div>";
                    }
                },
                { data: 'created_at', className: 'created_at',
                    render: function(data, type, row, meta){
                        var text1 = "<div>"+ data +" - </div>";
                        var text2 = "<div>"+ row.created_at_before +"</div>";
                        return text1 + text2;
                    }
                },
                { data: 'action', orderable: false,
                    render: function(data, type, row, meta) {
                        // Action Buttons
                        return (
                            '<span>' +
                                '@if(auth()->user()->can('update_categories'))' +
                                    '<a id="'+ row.id +'" name="edit" class="item-edit edit mr-1" data-toggle="modal" data-target="#categoryModal" title="{{ trans("admin.edit") }}">' +
                                    feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                                    '</a>' +
                                '@endif' +
                            '</span>' +
                            '<span>' +
                                '@if(auth()->user()->can('delete_categories'))' +
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
                  className: '@if (auth()->user()->can("trash_categories")) btn dtbtn btn-sm btn-danger multi_delete @else btn dtbtn btn-sm btn-danger disabled @endif',
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
                  className: '@if (auth()->user()->can("print_categories")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  extend: 'print', attr: { 'title': '{{ trans("admin.print") }}' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-danger',
                  text: '<i data-feather="file"></i> PDF',
                  pageSize: 'A4', attr: { 'title': 'PDF' }
                },
                { text: '<i data-feather="plus"></i> {{ trans("admin.create_category") }}',
                  className: '@if (auth()->user()->can("create_categories")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  attr: {
                    'title': '{{ trans("admin.create_category") }}',
                    'data-toggle': 'modal',
                    'data-target': '#categoryModal',
                    'name': 'create_category',
                    'id': 'create_category' }
                },
            ],
            language: {
                url: getDataTableLanguage(),
                search: ' ',
                searchPlaceholder: '{{ trans("admin.search") }}...'
            }
        });

        $('#trash-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            drawCallback: function(settings){ feather.replace(); },
            order: [[ 2, "desc" ]],
            ajax: {
                url: "{{ route('categories.trashed') }}",
            },
            columns: [
                {
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }, searchable: false, orderable: false
                },
                { data: 'name_trans' },
                { data: 'user',
                    render: function(data, type, row, meta) {
                        return "<div class='badge badge-light-primary'>"+ data +"</div>";
                    }
                },
                { data: 'deleted_at', className: 'deleted_at',
                    render: function(data, type, row, meta){
                        var text1 = "<div>"+ data +" - </div>";
                        var text2 = "<div>"+ row.deleted_at_before +"</div>";
                        return text1 + text2;
                    }
                },
                { data: 'action', orderable: false,
                    render: function(data, type, row, meta) {
                        // Action Buttons
                        return (
                            '<span>' +
                                '<a id="'+ row.id +'" name="restore" class="item-edit restore mr-1" title="{{ trans("admin.restore") }}">' +
                                feather.icons['corner-left-up'].toSvg({ class: 'font-small-4' }) +
                                '</a>' +
                            '</span>' +
                            '<span>' +
                                '<a id="'+ row.id +'" class="item-edit force" title="{{ trans("admin.force_delete") }}">' +
                                feather.icons['x-circle'].toSvg({ class: 'font-small-4 mr-50' }) +
                                '</a>' +
                            '</span>'
                        );
                    }
                }
            ],
            "columnDefs": [],
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
                  className: '@if (auth()->user()->can("print_categories")) btn dtbtn btn-sm btn-primary @else btn dtbtn btn-sm btn-primary disabled @endif',
                  extend: 'print', attr: { 'title': '{{ trans("admin.print") }}' }
                },
                { extend: 'pdfHtml5', charset: "UTF-8", bom: true,
                  className: 'btn dtbtn btn-sm btn-danger',
                  text: '<i data-feather="file"></i> PDF',
                  pageSize: 'A4', attr: { 'title': 'PDF' }
                },
            ],
            language: {
                url: getDataTableLanguage(),
                search: ' ',
                searchPlaceholder: '{{ trans("admin.search") }}...'
            }
        });

        // Open Modal
        $(document).on('click', '#create_category', function(){
            $('.modal-title').text("{{ trans('admin.create_category') }}");
            $('#action_button').val("Add");
            $('#categoryForm').trigger("reset");
            $('#form_result').html('');
            $('#action').val("Add");
        });

        // Add Data
        $('#categoryForm').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.categories.store') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data)
                    {
                        var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<div class="alert-body">' + data.errors[count] + '</div>';
                    }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        $('#categoryForm')[0].reset();
                        $('#data-table').DataTable().ajax.reload();
                        $('#trash-table').DataTable().ajax.reload();
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.added_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.added_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }
                        $('#form_result').html(html);
                    }
                });
            }
            if($('#action').val() == "Edit")
            {
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.categories.update') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data)
                    {
                        var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<div class="alert-body">' + data.errors[count] + '</div>';
                    }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        $('#categoryForm')[0].reset();
                        $('#data-table').DataTable().ajax.reload();
                        $('#trash-table').DataTable().ajax.reload();
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        var lang = "{{ app()->getLocale() }}";
                        if (lang == "ar") {
                            toastr.success('{{ trans('admin.updated_successfully') }}');
                        } else {
                            toastr.success('{{ trans('admin.updated_successfully') }}', '', {positionClass: 'toast-bottom-left'});
                        }
                    }
                        $('#form_result').html(html);
                    }
                });
            }
        });

        // Edit Data
        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/admin/categories/"+ id +"/edit",
                dataType: "json",
                success: function(html){
                    $('#name_ar').val(html.data.name.ar);
                    $('#name_en').val(html.data.name.en);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("{{ trans('admin.edit_category') }}");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                }
            });
        });
    });

</script>

@endpush
