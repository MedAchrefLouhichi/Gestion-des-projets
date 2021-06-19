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
                            @if ($message->idem == $user->id)
                                <li class="active">
                                    <a href="{{ route('inbox') }}">
                                        <span class="badge pull-right">{{ $nbri }}</span>
                                        <i class="fa fa-angle-right fa-fw"></i> <strong>Inbox</strong>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sentmsg') }}">
                                        <span class="badge pull-right">{{ $nbr }}</span>
                                        <i class="fa fa-angle-right fa-fw"></i> <strong>Sent</strong>
                                    </a>
                                </li>
                            @endif
                            @if ($message->idrec == $user->id)
                                <li>
                                    <a href="{{ route('inbox') }}">
                                        <span class="badge pull-right">{{ $nbri }}</span>
                                        <i class="fa fa-angle-right fa-fw"></i> <strong>Inbox</strong>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="{{ route('sentmsg') }}">
                                        <span class="badge pull-right">{{ $nbr }}</span>
                                        <i class="fa fa-angle-right fa-fw"></i> <strong>Sent</strong>
                                    </a>
                                </li>
                            @endif
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
                                    <td>{{ Auth::user()->created_at->format('d/m/Y') }} <a
                                            href="page_ready_pricing_tables.html" data-toggle="tooltip"
                                            title="Upgrade to VIP"></a></td>
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
                <div class="col-sm-8 col-lg-9">
                    <!-- View Message Block -->
                    <div class="block full">
                        <!-- View Message Title -->
                        <div class="block-title">
                            <h2><strong>{{ $message->objet }}</strong> <small>
                        </div>
                        <!-- END View Message Title -->

                        <!-- Message Meta -->
                        <table class="table table-borderless table-vcenter remove-margin">
                            <tbody>
                                <tr>
                                    <td class="text-center" style="width: 80px;">
                                        <a href="page_ready_user_profile.html" class="pull-left">
                                            <img style="height:80px; width:80px"
                                                src="{{ asset('photos/' . $user->image) }} " alt="Avatar"
                                                class="img-circle">
                                        </a>
                                    </td>
                                    <td class="hidden-xs">
                                        <a
                                            href="{{ route('profile', ['id' => $user->id]) }}"><strong>{{ $user->name }}</strong></a>
                                    </td>
                                    <td class="text-right"><strong>{{ $message->created_at }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <!-- END Message Meta -->

                        <!-- Message Body -->
                        <p><strong>Dear</strong> {{ Auth::user()->name }} </p>
                        {{ $message->contenu }}
                        <hr>
                        <!-- END Message Body -->

                    </div>
                    <!-- END View Message Block -->
                </div>
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
