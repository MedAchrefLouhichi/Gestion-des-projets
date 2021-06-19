@extends('layout')
@section('content')

    <div id="page-content" style="min-height: 709px;">
        <!--Content Header Begin -->
        <div class="content-header">
            <div class="header-section">
                <h1>
                    <i class="gi gi-user"></i><small>User Management<br></small>
                </h1>
            </div>
        </div>
        <ul class="breadcrumb breadcrumb-top">
            <li><a href="{{ Route('home') }}"></a>Home</li>
            <li><a href="{{ Route('usermanagement') }}">User Management</a></li>
            <li><a href="{{ Route('manageusers') }}">All Users</a></li>
        </ul>
        <!-- END Content Header -->


        <!-- Page Content -->
        <div class="form-group">
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
        </div>
        <div class="form-group">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search Customer Data" />
        </div>
        <div class="block">
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


                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#search').on('keyup', function() {
                    $.ajax({
                        url: "{{ route('livesearch') }}",
                        method: 'GET',
                        data: {
                            query: $(this).val()
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $('tbody').html(data.table_data);
                        }
                    })
                });
            })

        </script>

    </div>
@endsection
