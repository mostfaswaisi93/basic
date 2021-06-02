@extends('layouts.admin')
@section('title') {{ trans('admin.edit_user') }} @endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ trans('admin.edit_user') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">{{ trans('admin.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}">{{ trans('admin.users') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('admin.edit_user') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <section class="portlet">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <i class="mr-25" data-feather='edit'></i>
                            {{ trans('admin.edit_user') }} - {{ $user->full_name }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('partials.errors')
                            <form action="{{ route('admin.users.update', $user->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row mt-1">
                                    <div class="col-xl-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label>{{ trans('admin.first_name') }}</label>
                                            <input id="first_name" type="text" name="first_name" class="form-control"
                                                value="{{ $user->first_name }}"
                                                placeholder="{{ trans('admin.first_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label>{{ trans('admin.last_name') }}</label>
                                            <input id="last_name" type="text" name="last_name" class="form-control"
                                                value="{{ $user->last_name }}"
                                                placeholder="{{ trans('admin.last_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="email">{{ trans('admin.email') }}:</label>
                                            <input id="email" type="email" name="email" class="form-control"
                                                value="{{ $user->email }}" placeholder="{{ trans('admin.email') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="media mb-2">
                                            <img src="{{ $user->image_path }}" alt="users avatar"
                                                class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                height="90" width="90" />
                                            <div class="media-body mt-50">
                                                <h4 class="mb-1">
                                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                    <span class="align-middle">{{ trans('admin.user_image') }}</span>
                                                </h4>
                                                <div class="col-12 d-flex mt-1 px-0">
                                                    <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                                        <span
                                                            class="d-none d-sm-block">{{ trans('admin.change') }}</span>
                                                        <input class="form-control image" name="image" type="file"
                                                            id="change-picture" hidden
                                                            accept="image/png, image/jpeg, image/jpg" />
                                                        <span class="d-block d-sm-none">
                                                            <i class="mr-0" data-feather="edit"></i>
                                                        </span>
                                                    </label>
                                                    <button class="btn btn-outline-secondary d-block d-sm-none">
                                                        <i class="mr-0" data-feather="trash-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="table-responsive border rounded mt-1">
                                            <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                                <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                <span class="align-middle">{{ trans('admin.permissions') }}</span>
                                            </h6>
                                            @php
                                            $models = ['users', 'categories', 'brands'];
                                            $maps = ['create', 'read', 'update', 'delete', 'print', 'trash'];
                                            @endphp
                                            <table class="table table-striped table-borderless">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        @foreach ($maps as $map)
                                                        <th>
                                                            {{ trans('admin.' .$map) }}
                                                        </th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($models as $index => $model)
                                                    <tr>
                                                        <td> {{ trans('admin.' .$model) }}</td>
                                                        @foreach ($maps as $map)
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="permissions[]"
                                                                    class="custom-control-input"
                                                                    id="{{ $map . '_' . $model }}"
                                                                    {{ $user->hasAnyPermission($map . '_' . $model) ? 'checked' : '' }}
                                                                    value="{{ $map . '_' . $model }}">
                                                                <label class="custom-control-label"
                                                                    for="{{ $map . '_' . $model }}"></label>
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
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">{{ trans('admin.edit') }}</button>
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
