@extends('layouts.admin')
@section('title') {{ trans('admin.create_user') }} @endsection

@section('content')

<div class="content-body">
    <section class="portlet">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="feather icon-user-plus mr-25"></i>
                            {{ trans('admin.create_user') }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('partials.errors')
                            <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ trans('admin.first_name') }}</label>
                                                <input id="first_name" type="text" name="first_name"
                                                    class="form-control" value="{{ old('first_name') }}"
                                                    placeholder="{{ trans('admin.first_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ trans('admin.last_name') }}</label>
                                                <input id="last_name" type="text" name="last_name" class="form-control"
                                                    value="{{ old('last_name') }}"
                                                    placeholder="{{ trans('admin.last_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ trans('admin.username') }}</label>
                                                <input id="username" type="text" name="username" class="form-control"
                                                    value="{{ old('username') }}"
                                                    placeholder="{{ trans('admin.username') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ trans('admin.email') }}</label>
                                                <input id="email" type="email" name="email" class="form-control"
                                                    value="{{ old('email') }}" placeholder="{{ trans('admin.email') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ trans('admin.password') }}</label>
                                                <input id="password" type="password" name="password"
                                                    class="form-control" placeholder="{{ trans('admin.password') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>{{ trans('admin.password_confirmation') }}</label>
                                                <input id="password_confirmation" type="password"
                                                    name="password_confirmation" class="form-control"
                                                    placeholder="{{ trans('admin.password_confirmation') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="media mb-2">
                                            <a class="mr-2 my-25" href="#">
                                                <img src="{{ asset('images/users/default.png') }}" alt="users avatar"
                                                    class="users-avatar-shadow rounded image img-thumbnail image-preview"
                                                    height="70" width="70">
                                            </a>
                                            <div class="media-body mt-50">
                                                <label>{{ trans('admin.user_image') }}</label>
                                                <div class="col-12 d-flex mt-1 px-0">
                                                    <input type="file" class="form-control-file image" name="image"
                                                        id="image" style="display:none;">
                                                    <button class="btn btn-primary" onclick="FileUpload();">
                                                        <i class="fa fa-plus"></i>
                                                        {{ trans('admin.file_upload') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive border rounded px-1">
                                            <h6 class="border-bottom py-1 mx-1 mb-0 font-medium-2">
                                                <i class="feather icon-lock mr-50"></i>
                                                {{ trans('admin.permissions') }}
                                            </h6> <br>
                                            @php
                                            $models = ['users', 'categories', 'countries', 'cities'];
                                            $maps = ['create', 'read', 'update', 'delete'];
                                            @endphp
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        @foreach ($maps as $map)
                                                        <th>
                                                            {{ trans('admin.' .$map) }}
                                                        </th>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" name="" id="select-all">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span> {{ trans('admin.select_all_permissions') }}
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <i class="feather icon-pocket feather-select"></i>
                                                                &nbsp;
                                                                <input type="checkbox" name="" id="select-create"
                                                                    title="{{ trans('admin.select_all') }}">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <i class="feather icon-pocket feather-select"></i>
                                                                &nbsp;
                                                                <input type="checkbox" name="" id="select-read"
                                                                    title="{{ trans('admin.select_all') }}">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <i class="feather icon-pocket feather-select"></i>
                                                                &nbsp;
                                                                <input type="checkbox" name="" id="select-update"
                                                                    title="{{ trans('admin.select_all') }}">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </th>
                                                        <th>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <i class="feather icon-pocket feather-select"></i>
                                                                &nbsp;
                                                                <input type="checkbox" name="" id="select-delete"
                                                                    title="{{ trans('admin.select_all') }}">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($models as $index => $model)
                                                    <tr>
                                                        <td> {{ trans('admin.' .$model) }}</td>
                                                        @foreach ($maps as $map)
                                                        <td>
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" name="permissions[]"
                                                                    value="{{ $map . '_' . $model }}">
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ trans('admin.add') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')

<script type="text/javascript">
    document.getElementById('select-all').onclick = function() {
  var checkboxes = document.getElementsByName('permissions[]');
  for (var checkbox of checkboxes) {
    checkbox.checked = this.checked;
  }
}

// Select All By Name
var models = ["users", "categories", "countries", "cities"];
var mLen = models.length;
var maps = ["create", "read", "update", "delete"];
var text;
document.getElementById('select-create').onclick = function() {
  for (i = 0; i < mLen; i++) {
    text = "create_" + models[i];
  }
  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  for (var checkbox of checkboxes) {
    checkbox.checked = this.checked;
  }
}
</script>

@endpush