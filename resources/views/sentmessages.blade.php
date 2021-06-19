@extends('layout')
@section('content')
    <div id="page-wrapper">


        <!-- Page content -->
        <div id="page-content">
            <!-- Inbox Header -->
            <div class="content-header">
                <div class="header-section">
                    <h1><i class="gi gi-envelope"></i> Inbox<br><small>Your Message Center</small></h1>
                </div>
            </div>
            <ul class="breadcrumb breadcrumb-top">
                <li>Pages</li>
                <li>Message Center</li>
                <li><a href="">Inbox</a></li>
            </ul>
            <!-- END Inbox Header -->

            <!-- Inbox Content -->
            <div class="row">
                <!-- Inbox Menu -->
                <div class="col-sm-4 col-lg-3">
                    <!-- Menu Block -->
                    <div class="block full">
                        <!-- Menu Title -->
                        <div class="block-title clearfix">
                            <div class="block-options pull-right">
                                <a href="" onclick='window.location.reload(true);' class="btn btn-alt btn-sm btn-default"
                                    data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
                            </div>
                            <div class="block-options pull-left">
                                <a href="page_ready_inbox_compose.html" class="btn btn-alt btn-sm btn-default"><i
                                        class="fa fa-pencil"></i> Compose Message</a>
                            </div>
                        </div>
                        <!-- END Menu Title -->

                        <!-- Menu Content -->
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="{{ route('inbox') }}">
                                    <span class="badge pull-right">{{ $nbr }}</span>
                                    <i class="fa fa-angle-right fa-fw"></i> <strong>Inbox</strong>
                                </a>
                            </li>
                            <li class="active">
                                <a href="" onclick='window.location.reload(true);'>
                                    <i class="fa fa-angle-right fa-fw"></i> <strong>Sent</strong>
                                </a>
                            </li>
                            <!-- END Menu Content -->
                    </div>
                    <!-- END Menu Block -->


                    <!-- Account Stats Block -->
                    <div class="block">
                        <!-- Account Status Title -->
                        <div class="block-title">
                            <h2><i class="fa fa-user"></i> Account <strong>Status</strong></h2>
                        </div>
                        <!-- END Account Status Title -->

                        <!-- Account Stats Content -->
                        <div class="row block-section text-center">
                            <div class="col-xs-12">
                                <div>
                                    <img src="{{ asset('photos/' . Auth::user()->image) }}" alt="avatar"
                                        class="pie-avatar img-circle" width="75 ">
                                </div>
                            </div>
                        </div>
                        <table class="table table-borderless table-striped table-vcenter">
                            <tbody>
                                <tr>
                                    <td class="text-right" style="width: 50%;"><strong>Active since</strong></td>
                                    <td>{{ Auth::user()->created_at->format('d/m/Y') }} </td>
                                </tr>
                                <tr>
                                    <td class="text-right"><strong>Job in Company</strong></td>
                                    <td><span class="text-danger">
                                            @if (Auth::user()->role === 1)
                                                Admin
                                            @endif
                                            @if (Auth::user()->role === 2)
                                                Commercial
                                            @endif
                                            @if (Auth::user()->role === 4)
                                                Personnel
                                            @endif
                                        </span></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- END Account Status Content -->
                    </div>
                    <!-- END Account Status Block -->
                </div>
                <!-- END Inbox Menu -->

                <!-- Messages List -->
                <div class="col-sm-8 col-lg-9">
                    <!-- Messages List Block -->
                    <div class="block">
                        <!-- Messages List Title -->
                        <div class="block-title">
                            <h2>Sent <strong>{{ $nbri }}</strong></h2>
                        </div>
                        <!-- END Messages List Title -->

                        <!-- Messages List Content -->
                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-hover table-vcenter">
                                <thead>

                                </thead>
                                <tbody>
                                    @foreach ($messages as $item)
                                        @csrf

                                        <!-- Use the first row as a prototype for your column widths -->
                                        <tr>
                                            <td class="text-center" style="width: 30px;">
                                                <i class="fa fa-user"></i>
                                            </td>
                                            <td style="width: 20%;" name="name">
                                                <a
                                                    href="{{ route('profile', ['id' => App\Models\User::find($item->idrec)->id]) }}">
                                                    {{ App\Models\User::find($item->idrec)->name }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('viewmsg', ['id' => $item->id]) }}"><strong>
                                                        {{ $item->objet }}</strong></a>

                                            </td>
                                            <td class="text-right" style="width: 90px;"><em>{{ $item->created_at }}</em>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END Messages List Content -->
                    </div>
                    <!-- END Messages List Block -->
                </div>
                <!-- END Messages List -->
            </div>
            <!-- END Inbox Content -->
        </div>
        <!-- END Page Content -->

    </div>
    <!-- END Main Container -->




    <!-- END User Settings -->

    <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->

    <!-- Load and execute javascript code used only in this page -->
@endsection
