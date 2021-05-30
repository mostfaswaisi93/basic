<!-- BEGIN: Menu -->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ml-auto">
            <!-- Start Language -->
            <li class="nav-item dropdown dropdown-language">
                @if(app()->getLocale() == 'en')
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-us"></i>
                    <span class="selected-language">English</span>
                </a>
                @else
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-sa"></i>
                    <span class="selected-language">العربية</span>
                </a>
                @endif
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if($localeCode == LaravelLocalization::getCurrentLocale())
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        @if(app()->getLocale() == 'en')
                        <i class="flag-icon flag-icon-us"></i>
                        @else
                        <i class="flag-icon flag-icon-sa"></i>
                        @endif
                        {{ $properties['native'] }}
                    </a>
                    @elseif($url = LaravelLocalization::getLocalizedURL($localeCode))
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        @if(app()->getLocale() == 'en')
                        <i class="flag-icon flag-icon-sa"></i>
                        @else
                        <i class="flag-icon flag-icon-us"></i>
                        @endif
                        {{ $properties['native'] }}
                    </a>
                    @endif
                    @endforeach
                </div>
            </li>
            <!-- End Language -->
            <!-- Start Search -->
            <li class="nav-item nav-search">
                <a class="nav-link nav-link-search">
                    <i class="ficon" data-feather="search"></i>
                </a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="..." tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>
            <!-- End Search -->
            <li class="nav-item dropdown dropdown-notification mr-25">
                <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i>
                    <span class="badge badge-pill badge-danger badge-up">5</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar">
                                        <img src="{{ url('backend/app-assets/images/portrait/small/avatar-s-15.jpg') }}"
                                            alt="avatar" width="32" height="32">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam
                                            🎉</span>winner!</p><small class="notification-text"> Won the monthly best
                                        seller badge.</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar">
                                        <img src="{{ url('backend/app-assets/images/portrait/small/avatar-s-3.jpg') }}"
                                            alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">New
                                            message</span>&nbsp;received</p><small class="notification-text"> You have
                                        10 unread messages</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Revised Order
                                            👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order
                                        updated</small>
                                </div>
                            </div>
                        </a>
                        <div class="media d-flex align-items-center">
                            <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                            <div class="custom-control custom-control-primary custom-switch">
                                <input class="custom-control-input" id="systemNotification" type="checkbox" checked="">
                                <label class="custom-control-label" for="systemNotification"></label>
                            </div>
                        </div>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">
                                            <i class="avatar-icon" data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Server
                                            down</span>&nbsp;registered</p><small class="notification-text"> USA Server
                                        is down due to hight CPU usage</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-success">
                                        <div class="avatar-content">
                                            <i class="avatar-icon" data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Sales
                                            report</span>&nbsp;generated</p><small class="notification-text"> Last month
                                        sales report generated</small>
                                </div>
                            </div>
                        </a>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-warning">
                                        <div class="avatar-content">
                                            <i class="avatar-icon" data-feather="alert-triangle"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">High
                                            memory</span>&nbsp;usage</p><small class="notification-text"> BLR Server
                                        using high memory</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer">
                        <a class="btn btn-primary btn-block" href="javascript:void(0)">Read
                            all notifications
                        </a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">
                            {{ auth()->user()->full_name }}
                        </span>
                        {{-- <span class="user-status">{{ trans('admin.available') }} {{ ucfirst(auth()->user()->roles->first()->name) }}</span> --}}
                        <span class="user-status">{{ auth()->user()->roles->first()->name }}</span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{ url('backend/app-assets/images/portrait/small/avatar-s-11.jpg') }}"
                            alt="avatar" height="35" width="35">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="page-profile.html">
                        <i class="mr-50" data-feather="user"></i>
                        {{ trans('admin.profile') }}
                    </a>
                    {{-- <a class="dropdown-item" href="app-email.html">
                        <i class="mr-50" data-feather="mail"></i>
                        Inbox
                    </a>
                    <a class="dropdown-item" href="app-todo.html">
                        <i class="mr-50" data-feather="check-square"></i>
                        Task
                    </a>
                    <a class="dropdown-item" href="app-chat.html">
                        <i class="mr-50" data-feather="message-square"></i>
                        Chats
                    </a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                        <i class="mr-50" data-feather="settings"></i>
                        {{ trans('admin.settings') }}
                    </a>
                    {{-- <a class="dropdown-item" href="page-pricing.html">
                        <i class="mr-50" data-feather="credit-card"></i>
                        Pricing
                    </a>
                    <a class="dropdown-item" href="page-faq.html">
                        <i class="mr-50" data-feather="help-circle"></i>
                        FAQ
                    </a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="mr-50" data-feather="power"></i> {{ trans('admin.logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Menu -->