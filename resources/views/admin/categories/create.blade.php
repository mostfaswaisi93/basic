@extends('layouts.admin')
@section('title') {{ trans('admin.create_category') }} @endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ trans('admin.create_category') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">{{ trans('admin.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.categories.index') }}">{{ trans('admin.categories') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('admin.create_category') }}</li>
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
                            <i class="mr-25" data-feather='plus'></i>
                            {{ trans('admin.create_category') }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('partials.errors')
                            <form action="{{ route('admin.categories.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row mt-1">
                                    <div class="col-xl-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label>{{ trans('admin.first_name') }}</label>
                                            <input id="first_name" type="text" name="first_name" class="form-control"
                                                value="{{ old('first_name') }}"
                                                placeholder="{{ trans('admin.first_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label>{{ trans('admin.last_name') }}</label>
                                            <input id="last_name" type="text" name="last_name" class="form-control"
                                                value="{{ old('last_name') }}"
                                                placeholder="{{ trans('admin.last_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="email">{{ trans('admin.email') }}:</label>
                                            <input id="email" type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="{{ trans('admin.email') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label>{{ trans('admin.password') }}:</label>
                                            <input id="password" type="password" name="password" class="form-control"
                                                placeholder="{{ trans('admin.password') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12">
                                        <div class="form-group">
                                            <label>{{ trans('admin.password_confirmation') }}:</label>
                                            <input id="password_confirmation" type="password"
                                                name="password_confirmation" class="form-control"
                                                placeholder="{{ trans('admin.password_confirmation') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">{{ trans('admin.add') }}</button>
                                        <button type="reset" class="btn btn-outline-secondary">
                                            {{ trans('admin.reset') }}
                                        </button>
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
