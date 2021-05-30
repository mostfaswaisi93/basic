@extends('layouts.admin')
@section('title') {{ trans('admin.create_patient') }} @endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ trans('admin.create_patient') }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">{{ trans('admin.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.patients.index') }}">{{ trans('admin.patients') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ trans('admin.create_patient') }}</li>
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
                            <i class="mr-25" data-feather='plus-circle'></i>
                            {{ trans('admin.create_patient') }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @include('partials.errors')
                            <form action="{{ route('admin.patients.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    @foreach (config('translatable.locales') as $locale)
                                    <div class="col-xl-6 col-md-6 col-12 mt-1">
                                        <div class="form-group">
                                            <label for="name">{{ trans('admin.' . $locale . '.name') }}</label>
                                            <input id="name[{{ $locale }}]" type="text" name="name[{{ $locale }}]"
                                                class="form-control" value="{{ old('name.' . $locale) }}"
                                                placeholder="{{ trans('admin.' . $locale . '.name') }}">
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="price">{{ trans('admin.price') }}</label>
                                            <input id="price" type="text" name="price" class="form-control"
                                                value="{{ old('price') }}" placeholder="{{ trans('admin.price') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">{{ trans('admin.add') }}</button>
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