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
                <li><a href="{{ route('inbox') }}">Inbox</a></li>
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
                                <a href="{{ route('destinataire') }}" class="btn btn-alt btn-sm btn-default"><i
                                        class="fa fa-pencil"></i> Compose Message</a>
                            </div>
                        </div>
                        <!-- END Menu Title -->

                        <!-- Menu Content -->
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active">
                                <a href="page_ready_inbox.html">
                                    <span class="badge pull-right"></span>
                                    <i class="fa fa-angle-right fa-fw"></i> <strong>Inbox</strong>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('sentmsg') }}">
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
                            <div class="col-xs-20">
                                <div>
                                    <img src="{{ asset('photos/' . Auth::user()->image) }}" alt="avatar"
                                        class="pie-avatar img-circle" width="160 ">
                                </div>
                            </div>
                        </div>
                        <table class="table table-borderless table-striped table-vcenter">
                            <tbody>
                                <tr>
                                    <td class="text-right" style="width: 50%;"><strong>Active since</strong></td>
                                    <td>{{ Auth::user()->created_at }} <a href="page_ready_pricing_tables.html"
                                            data-toggle="tooltip" title="Upgrade to VIP"></a></td>
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
                    <!-- Compose Message Block -->
                    <div class="block">
                        <!-- Compose Message Title -->
                        <div class="block-title">
                            <h2>Compose <strong>Message</strong></h2>
                        </div>
                        <!-- END Compose Message Title -->

                        <!-- Compose Message Content -->
                        <form action="{{ route('msgstore') }}" method="post" class="form-horizontal form-bordered">
                            @csrf
                            <div class=" form-group">
                                <label class="col-md-3 col-lg-2 control-label" for="compose-to">To</label>
                                <div class="col-md-9 col-lg-10">
                                    <input type="email" id="compose-to" name="email"
                                        class="form-control form-control-borderless" placeholder="Where to?"
                                        value="{{ $user->email }}">
                                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-lg-2 control-label" for="compose-subject">Subject</label>
                                <div class="col-md-9 col-lg-10">
                                    <input type="text" id="compose-subject" name="object"
                                        class="form-control form-control-borderless" placeholder="Your subject..">
                                    <span class="text-danger">@error('object') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-lg-2 control-label" for="compose-message">Message</label>
                                <div class="col-md-9 col-lg-10">
                                    <textarea id="compose-message" name="contenu" rows="20" class="form-control"
                                        placeholder="Your message.."></textarea>
                                    <span class="text-danger">@error('contenu') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-sm btn-primary"
                                        onclick="return confirm('This message will be sent and not modified permanetly?')"><i
                                            class="fa fa-share"></i>
                                        Send</button>
                                </div>
                            </div>
                        </form>
                        <!-- END Compose Message Content -->
                    </div>
                    <!-- END Compose Message Block -->
                </div>
            </div>
            <!-- END Inbox Content -->
        </div>
        <!-- END Page Content -->

    </div>
@endsection
