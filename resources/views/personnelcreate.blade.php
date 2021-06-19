@extends('layout')
@section('content')


    <!--Content Header Begin -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-user"></i><strong>Creat a new</strong> Personnel <br>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Home</li>

        <li><a href="{{ route('usermanagement') }}">User Management</a></li>
    </ul>
    <div id="pagecontent" style="min-height: 680px;">
        <div class="bloc">

            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <div class="col-md-20">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
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
                                <form action="{{ route('persoadd') }}" method="post" enctype="multipart/form-data"
                                    class="form-horizontal form-bordered">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Username</label>
                                        <div class="col-md-9">
                                            <input type="text" name="username" class="form-control" value="">
                                            <span class="text-danger">@error('username') {{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control" value="">
                                            <span class="text-danger">@error('name') {{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control" value="">
                                            <span class="text-danger">@error('email') {{ $message }}
                                                @enderror</span>
                                            <span class="help-block">Please enter your email</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Phone</label>
                                        <div class="col-md-9">
                                            <input type="text" name="phone" class="form-control" value="">
                                            <span class="text-danger">@error('phone') {{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Adress</label>
                                        <div class="col-md-9">
                                            <input type="text" name="adress" class="form-control" value="">
                                            <span class="text-danger">@error('adress') {{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="birthday">Date
                                            of birth</label>
                                        <div class="col-md-9">
                                            <input type="date" id="birthday" name="birthday" value="{{ now() }}"
                                                min="1900-01-01" max="2021-01-01" />
                                            <span class="text-danger">@error('daten') {{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Job</label>
                                        <div class="col-md-9">
                                            <input type="text" name="job" class="form-control" value="">
                                            <span class="text-danger">@error('job') {{ $message }}
                                                @enderror</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="image"> Your
                                            Picture</label>
                                        <div class="col-md-9">
                                            <input type="file" id='image' name="image">
                                        </div>
                                    </div>

                                    <div class="col-md-10 col-md-offset-5">
                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                class="fa fa-angle-right"></i>
                                            Save</button>
                                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-repeat"></i>
                                            Cancel</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>


@endsection
