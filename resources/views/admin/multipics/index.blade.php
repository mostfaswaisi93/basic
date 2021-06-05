@include('admin.partials.header')
@include('admin.partials.sidebar')

<link rel="stylesheet" type="text/css" href="{{ url('backend/app-assets/vendors/css/extensions/jstree.min.css') }}">

@if (app()->getLocale() == 'en')

<link rel="stylesheet" type="text/css"
    href="{{ url('backend/app-assets/css/plugins/extensions/ext-component-tree.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('backend/app-assets/css/pages/app-file-manager.css') }}">

@else

<link rel="stylesheet" type="text/css"
    href="{{ url('backend/app-assets/css-rtl/plugins/extensions/ext-component-tree.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('backend/app-assets/css-rtl/pages/app-file-manager.css') }}">

@endif

@section('title') {{ trans('admin.multipics') }} @endsection
<div class="app-content content file-manager-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-file-manager">
                    <div class="sidebar-inner">
                        <div class="dropdown dropdown-actions">
                            <button class="btn btn-primary add-file-btn text-center btn-block" type="button"
                                id="addNewFile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="align-middle">Add New</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="addNewFile">
                                <div class="dropdown-item" data-toggle="modal" data-target="#new-folder-modal">
                                    <div class="mb-0">
                                        <i data-feather="folder" class="mr-25"></i>
                                        <span class="align-middle">Folder</span>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="mb-0" for="file-upload">
                                        <i data-feather="upload-cloud" class="mr-25"></i>
                                        <span class="align-middle">File Upload</span>
                                        <input type="file" id="file-upload" hidden />
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div for="folder-upload" class="mb-0">
                                        <i data-feather="upload-cloud" class="mr-25"></i>
                                        <span class="align-middle">Folder Upload</span>
                                        <input type="file" id="folder-upload" webkitdirectory mozdirectory hidden />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="body-content-overlay"></div>

                    <div class="file-manager-main-content">
                        <div class="file-manager-content-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-xl-none float-left align-middle ml-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="file-actions">
                                    <i data-feather="trash"
                                        class="font-medium-2 cursor-pointer d-sm-inline-block d-none mr-50"></i>
                                </div>
                                <div class="btn-group btn-group-toggle view-toggle ml-50" data-toggle="buttons">
                                    <label class="btn btn-outline-primary p-50 btn-sm active">
                                        <input type="radio" name="view-btn-radio" data-view="grid" checked />
                                        <i data-feather="grid"></i>
                                    </label>
                                    <label class="btn btn-outline-primary p-50 btn-sm">
                                        <input type="radio" name="view-btn-radio" data-view="list" />
                                        <i data-feather="list"></i>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="file-manager-content-body">
                            <div class="view-container">
                                <h6 class="files-section-title mt-25 mb-75">Folders</h6>
                                <div class="files-header">
                                    <h6 class="font-weight-bold mb-0">Filename</h6>
                                    <div>
                                        <h6 class="font-weight-bold file-item-size d-inline-block mb-0">Size</h6>
                                        <h6 class="font-weight-bold file-last-modified d-inline-block mb-0">Last
                                            modified</h6>
                                        <h6 class="font-weight-bold d-inline-block mr-1 mb-0">Actions</h6>
                                    </div>
                                </div>
                                <div class="card file-manager-item folder level-up">
                                    <div class="card-img-top file-logo-wrapper">
                                        <div class="d-flex align-items-center justify-content-center w-100">
                                            <i data-feather="arrow-up"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pl-2 pt-0 pb-1">
                                        <div class="content-wrapper">
                                            <p class="card-text file-name mb-0">...</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card file-manager-item folder">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1"></label>
                                    </div>
                                    <div class="card-img-top file-logo-wrapper">
                                        <div class="dropdown float-right">
                                            <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center w-100">
                                            <i data-feather="folder"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="content-wrapper">
                                            <p class="card-text file-name mb-0">Projects</p>
                                            <p class="card-text file-size mb-0">2gb</p>
                                            <p class="card-text file-date">01 may 2019</p>
                                        </div>
                                        <small class="file-accessed text-muted">Last accessed: 21 hours ago</small>
                                    </div>
                                </div>
                                <div class="card file-manager-item folder">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2" />
                                        <label class="custom-control-label" for="customCheck2"></label>
                                    </div>
                                    <div class="card-img-top file-logo-wrapper">
                                        <div class="dropdown float-right">
                                            <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center w-100">
                                            <i data-feather="folder"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="content-wrapper">
                                            <p class="card-text file-name mb-0">Design</p>
                                            <p class="card-text file-size mb-0">500mb</p>
                                            <p class="card-text file-date">05 may 2019</p>
                                        </div>
                                        <small class="file-accessed text-muted">Last accessed: 18 hours ago</small>
                                    </div>
                                </div>
                                <div class="card file-manager-item folder">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3" />
                                        <label class="custom-control-label" for="customCheck3"></label>
                                    </div>
                                    <div class="card-img-top file-logo-wrapper">
                                        <div class="dropdown float-right">
                                            <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center w-100">
                                            <i data-feather="folder"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="content-wrapper">
                                            <p class="card-text file-name mb-0">UI Kit</p>
                                            <p class="card-text file-size mb-0">200mb</p>
                                            <p class="card-text file-date">01 may 2019</p>
                                        </div>
                                        <small class="file-accessed text-muted">Last accessed: 2 days ago</small>
                                    </div>
                                </div>
                                <div class="card file-manager-item folder">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4" />
                                        <label class="custom-control-label" for="customCheck4"></label>
                                    </div>
                                    <div class="card-img-top file-logo-wrapper">
                                        <div class="dropdown float-right">
                                            <i data-feather="more-vertical" class="toggle-dropdown mt-n25"></i>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center w-100">
                                            <i data-feather="folder"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="content-wrapper">
                                            <p class="card-text file-name mb-0">Documents</p>
                                            <p class="card-text file-size mb-0">50.3mb</p>
                                            <p class="card-text file-date">10 may 2019</p>
                                        </div>
                                        <small class="file-accessed text-muted">Last accessed: 6 days ago</small>
                                    </div>
                                </div>


                                <div class="d-none flex-grow-1 align-items-center no-result mb-3">
                                    <i data-feather="alert-circle" class="mr-50"></i>
                                    No Results
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-menu dropdown-menu-right file-dropdown">
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i data-feather="eye" class="align-middle mr-50"></i>
                            <span class="align-middle">Preview</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i data-feather="user-plus" class="align-middle mr-50"></i>
                            <span class="align-middle">Share</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i data-feather="copy" class="align-middle mr-50"></i>
                            <span class="align-middle">Make a copy</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i data-feather="edit" class="align-middle mr-50"></i>
                            <span class="align-middle">Rename</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                            data-target="#app-file-manager-info-sidebar">
                            <i data-feather="info" class="align-middle mr-50"></i>
                            <span class="align-middle">Info</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i data-feather="trash" class="align-middle mr-50"></i>
                            <span class="align-middle">Delete</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <i data-feather="alert-circle" class="align-middle mr-50"></i>
                            <span class="align-middle">Report</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br> <br>
@include('admin.partials.footer')

<script src="{{ url('backend/app-assets/vendors/js/extensions/jstree.min.js') }}"></script>
<script src="{{ url('backend/app-assets/js/scripts/pages/app-file-manager.js') }}"></script>

@push('scripts')

@include('partials.delete')
@include('partials.force')
@include('partials.restore')
@include('partials.multi_delete')

<script type="text/javascript">
    var getLocation = "multipics";

</script>

@endpush
