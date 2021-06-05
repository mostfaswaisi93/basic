@extends('layouts.admin')
@section('title') {{ trans('admin.create_brand') }} @endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ trans('admin.create_brand') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">{{ trans('admin.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.multipics.index') }}">{{ trans('admin.multipics') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('admin.create_brand') }}</li>
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
                            {{ trans('admin.create_brand') }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('partials.errors')
                            <form action="{{ route('admin.multipics.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row mt-1">
                                    @foreach (config('translatable.locales') as $locale)
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">{{ trans('admin.' . $locale . '.name') }}</label>
                                            <input id="name[{{ $locale }}]" type="text" name="name[{{ $locale }}]"
                                                class="form-control" value="{{ old('name.' . $locale) }}"
                                                placeholder="{{ trans('admin.' . $locale . '.name') }}">
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-12">
                                        <div class="media mb-2">
                                            <img src="{{ asset('images/multipics/default.png') }}" alt="multipics avatar"
                                                class="user-avatar multipics-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                height="150" width="300" />
                                            <div class="media-body mt-50">
                                                <h4 class="mb-1">
                                                    <i data-feather="image" class="font-medium-4 mr-25"></i>
                                                    <span class="align-middle">{{ trans('admin.brand_image') }}</span>
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
