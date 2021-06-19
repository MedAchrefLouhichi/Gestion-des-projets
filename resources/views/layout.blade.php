<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <title>Silver Digital</title>

    <meta name="description"
        content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
    <link rel="icon" type="image/png" href="" />

    <link rel="stylesheet" href="{{ asset('/css/index/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index/profile.css') }}">
    <script src="{{ asset('js/vendor/modernizr.min.js') }}">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>
    <div id="page-wrapper">
        <!-- Preloader -->
        <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
        <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>Welcome</strong>User</h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
            </div>
        </div>
        <!-- END Preloader -->

        <!-- Page Container -->

        <div id="page-container" class="sidebar-mini sidebar-visible-lg sidebar-no-animations">
            <!-- Alternative Sidebar -->
            <div id="sidebar-alt">
                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-alt-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Sidebar Section -->
                        <a href="index.html" class="sidebar-title">
                            <i class="gi gi-cogwheel pull-right"></i> <strong>Notification</strong>
                        </a>
                        <div class="sidebar-section">Section content..</div>
                        <!-- END Sidebar Section -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Alternative Sidebar -->

            <!-- Main Sidebar -->
            <div id="sidebar">
                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Brand -->
                        <a href="{{ route('home') }}" class="sidebar-brand">
                            @csrf
                            <i class="gi gi-flash"></i><span
                                class="sidebar-nav-mini-hide"><strong>Silver</strong>Digital</span>
                        </a>
                        <!-- END Brand -->

                        <!-- User Info -->
                        <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                            <div class="sidebar-user-avatar">
                                <a href="{{ Route('profile', ['id' => Auth::user()->id]) }}">
                                    <img src="{{ asset('photos/' . Auth::user()->image) }}" alt="avatar">
                                </a>
                            </div>
                            <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                            <div class="sidebar-user-links">
                                <a href="{{ Route('profile', ['id' => Auth::user()->id]) }}" data-toggle="tooltip"
                                    data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                                <a href="{{ route('inbox') }}" data-toggle="tooltip" data-placement="bottom"
                                    title="Messages"><i class="gi gi-envelope"></i></a>
                                <a href="javascript:{}" onclick="document.getElementById('my_logout').submit();"
                                    data-toggle="tooltip" data-placement="bottom" title="Logout"><i
                                        class="gi gi-exit"></i></a>


                            </div>
                        </div>
                        <!-- END User Info -->
                        <!-- Sidebar Navigation -->
                        <ul class="sidebar-nav">
                            @if (Auth::user()->role === 1)
                                <li>
                                    <a href="{{ route('home') }}" class=""><i
                                            class="gi gi-stopwatch sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">Dashboard</span></a>
                                </li>
                            @endif
                            <!--@if (Auth::user()->role === 2 || Auth::user()->role === 3) <li>
                                    <a href="ajouterproject" class=""><i
                                            class="gi gi-folder_open sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">Project Managment</span></a>
                                </li> @endif -->
                            @if (Auth::user()->role === 2 || Auth::user()->role === 3)
                                <li>
                                    <a href="{{ route('projectmanage') }}" class=""><i
                                            class="gi gi-folder_open sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">Project Managment</span></a>
                                </li>
                            @endif
                            @if (Auth::user()->role === 4)
                                <li>
                                    <a href="{{ route('taskmanagement') }}" class=""><i
                                            class="hi hi-tasks sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">Task Managment</span></a>
                                </li>
                            @endif
                            <li>
                                @if (Auth::user()->role === 1)
                                    <a href="#" class="sidebar-nav-menu"><i
                                            class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i
                                            class="gi gi-cogwheel sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">Admin Panel</span></a>
                                    <ul>
                                        <li>
                                            <a href="{{ route('manageusers') }}">User Management</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('projectmanage') }}">Project Management</a>
                                        </li>
                                    </ul>
                            </li>
                            @endif
                            @if (Auth::user()->role !== 3)
                                <li>
                                    <!--<i class="gi gi-message_empty sidebar-nav-icon"></i>Message Center</a>-->
                                    <a href="#" class="sidebar-nav-menu"><i
                                            class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i
                                            class="gi gi-message_empty sidebar-nav-icon"></i><span
                                            class="sidebar-nav-mini-hide">Message Center</span></a>
                                    <ul>
                                        <li>
                                            <a href="{{ route('inbox') }}">Inbox</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('destinataire') }}">Compose a message</a>
                                        </li>
                                    </ul>


                                </li>

                            @endif

                        </ul>

                        <!-- END Sidebar Navigation -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">
                <!-- Header -->
                <header class="navbar navbar-inverse header-fixed-top">
                    <!-- Left Header Navigation -->
                    <ul class="nav navbar-nav-custom">
                        <!-- Main Sidebar Toggle Button -->
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                <i class="fa fa-bars fa-fw"></i>
                            </a>
                        </li>
                        <!-- END Main Sidebar Toggle Button -->

                        <!-- Template Options -->
                        <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="gi gi-settings"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-options">
                                <li class="dropdown-header text-center">Header Style</li>
                                <li>
                                    <div class="btn-group btn-group-justified btn-group-sm">
                                        <a href="javascript:void(0)" class="btn btn-primary"
                                            id="options-header-default">Light</a>
                                        <a href="javascript:void(0)" class="btn btn-primary"
                                            id="options-header-inverse">Dark</a>
                                    </div>
                                </li>
                                <li class="dropdown-header text-center">Page Style</li>
                                <li>
                                    <div class="btn-group btn-group-justified btn-group-sm">
                                        <a href="javascript:void(0)" class="btn btn-primary"
                                            id="options-main-style">Default</a>
                                        <a href="javascript:void(0)" class="btn btn-primary"
                                            id="options-main-style-alt">Alternative</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- END Template Options -->
                    </ul>
                    <!-- END Left Header Navigation -->


                    <!-- Right Header Navigation -->
                    <ul class="nav navbar-nav-custom pull-right">
                        <!-- User Dropdown -->
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('photos/' . Auth::user()->image) }}" alt="avatar"> <i
                                    class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Options</li>
                                <li>
                                    <a href="{{ Route('profile', ['id' => Auth::user()->id]) }}">
                                        <i class="fa fa-user-o fa-fw pull-right"></i>
                                        <span class="badge pull-right"></span>
                                        Profile
                                    </a>
                                    <a href="{{ route('home') }}">
                                        <i class="gi gi-home fa-fw pull-right"></i>
                                        <span class="badge pull-right"></span>
                                        Home
                                    </a>

                                    <a href="{{ route('inbox') }}">
                                        <i class="fa fa-envelope-o fa-fw pull-right"></i>
                                        <span class="badge pull-right"></span>
                                        Inbox
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:{}" onclick="document.getElementById('my_logout').submit();">
                                        <i class=" gi gi-log_out fa-fw pull-right"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END User Dropdown -->
                    </ul>
                    <!-- END Right Header Navigation -->
                </header>
                <!-- END Header -->

                <!-- Page content -->

                <div id="page-content">
                    @yield('content')
                </div>
                <!-- END Page Content -->


                <!-- Form Buttons -->
                <form action="{{ route('logout') }}" method="post" id="my_logout">
                    @csrf
                </form>
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>

    <!-- Footer -->

    <!-- END Footer -->

    <!-- END Page Wrapper -->

    <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
    <script src="{{ asset('/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/Index/plugins.js') }}"></script>
    <script src="{{ asset('/js/Index/app.js') }}"></script>
    <script src="{{ asset('/js/Index/index.js') }}"></script>

</body>

</html>
