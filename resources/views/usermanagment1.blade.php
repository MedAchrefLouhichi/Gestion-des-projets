@extends('layout')
@section('content')

    <div id="page-content" style="min-height: 709px;">
        <!--Content Header-->
        <div class="content-header">
            <div class="header-section">
                <h1>
                    <i class="gi gi-user"></i>User Management<br><small>
                </h1>
            </div>
        </div>
        <ul class="breadcrumb breadcrumb-top">
            <li><a href="{{ Route('home') }}"></a>Home</li>
            <li><a href="{{ Route('usermanagement') }}">User Management</a></li>
            <li><a href="{{ Route('manageusers') }}">All Users</a></li>
        </ul>
        <!-- END Content Header -->


        <!-- Example Content -->
        <div class="block">
            <div class="block-title">
                <h2><strong>SilverDigital</strong> Users</h2>
                <div class="block-options pull-right">
                    <a href="{{ route('persocreate') }}" class="gi gi-plus"> </a>
                    <a href="{{ route('usermanagement') }}" class="gi gi-search"> </a>
                </div>
            </div>
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
                <table id="general-table"
                    class="table table-vcenter table-hover table-bordered table-striped table-condensed">
                    <thead>
                        <th> <i class="fa fa-picture-o"></i></th>
                        <th> <i class="gi gi-user"></i></th>
                        <th> Username</th>
                        <th> Email</th>
                        <th> Role</th>
                        <th> Phone</th>
                        <th> Action</th>
                    </thead>
                    <tbody>

                        @foreach ($users as $item)
                            <tr>
                                <td class="text-center">
                                    <img style="height:100px; width:100px" src="{{ asset('photos/' . $item->image) }}"
                                        class="img-circle">
                                </td>
                                <td>
                                    <h5><a href="{{ route('profile', ['id' => $item->id]) }}">{{ $item->name }}</a></h5>
                                </td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    {{ $item->email }}</a>
                                </td>
                                <td>
                                    @if ($item->role == 1)
                                        <button type="button" class="btn btn-xs btn-primary">Admin</button>
                                    @endif
                                    @if ($item->role == 2)
                                        <button type="button" class="btn btn-xs btn-success">Commercial</button>
                                    @endif
                                    @if ($item->role == 3)
                                        <button type="button" class="btn btn-xs btn-warning">Client</button>
                                    @endif
                                    @if ($item->role == 4)
                                        <button type="button" class="btn btn-xs btn-info">Personnel</button>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->phone }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-s">
                                        <a href="{{ route('update', ['id' => $item->id]) }}" data-toggle="tooltip"
                                            title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('delete', ['id' => $item->id]) }}" data-toggle="tooltip"
                                            title="Delete" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this project ?')"><i
                                                class="fa fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!-- END Page Content -->

            </div>
        </div>
    @endsection
