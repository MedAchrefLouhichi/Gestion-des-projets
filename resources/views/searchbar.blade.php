@extends('layout')
@section('content')

    <div id="page-content" style="min-height: 709px;">
        <!--Content Header Begin -->
        <div class="content-header">
            <div class="header-section">
                <h1>
                    <i class="gi gi-user"></i><small>Search Results<br></small>
                </h1>
            </div>
        </div>
        <ul class="breadcrumb breadcrumb-top">
            <li>Home</li>
            <li><a href="{{ Route('manageuser') }}">Search Result</a></li>
        </ul>
        <!-- END Content Header -->


        <!-- Page Content -->
        <div class="table-responsive">
            <table id="general-table" class="table table-vcenter table-hover table-bordered table-striped">
                <thead>
                    <th><i class="fa fa-picture-o"></i></th>
                    <th><i class="gi gi-user"></i></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Action</th>
                </thead>
                <tbody>
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
                    @foreach ($users as $item)
                        <tr>
                            <td class="text-center">
                                <img style="height:100px; width:100px" src="{{ asset('photos/' . $item->image) }}"
                                    class="img-circle">
                            </td>
                            <td>
                                <a href="{{ Route('profile', ['id' => $item->id]) }}">{{ $item->name }}</a>
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
                            </td>
                            <td>
                                {{ $item->phone }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-s">
                                    <a href="{{ route('update', ['id' => $item->id]) }}" data-toggle="tooltip"
                                        title="Edit" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('delete', ['id' => $item->id]) }}" data-toggle="tooltip"
                                        title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <!--END Page Content -->

                </tbody>
            </table>
        </div>
    @endsection
