@extends('layout')
@section('content')

    <!--Content Header Begin -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-user"></i><strong>Update Profile</strong> {{ $user->name }}<br>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Home</li>

        <li><a href="{{ Route('profile', ['id' => $user->id]) }}">User Profile</a></li>
    </ul>
    <div class="bloc">

        <body>
            <div class="container">
                <div class="main-body">
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="shadow-lg">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="{{ asset('photos/' . $user->image) }}" alt="Admin"
                                                class="rounded-circle" width="200">
                                            <div class="mt-3">
                                                @csrf
                                                <h4>{{ $user->name }}</h4>
                                                <p class="text-secondary mb-1">{{ $user->username }}</p>
                                                <p class="text-muted font-size-sm">{{ $user->adress }}</p>
                                                @if ($user->role === 1)
                                                    <p class="text-muted font-size-sm">Admin</p>
                                                @endif
                                                @if ($user->role === 3)
                                                    <p class="text-muted font-size-sm">Client</p>
                                                @endif
                                                @if ($user->role === 2)
                                                    <p class="text-muted font-size-sm">Commercial Agent</p>
                                                @endif

                                                @if (Auth::user()->role === 1 || Auth::user()->id === $user->id)
                                                    <a href="{{ route('delete', ['id' => $user->id]) }}"
                                                        class="btn btn-danger" type="submit"> Delete </a>
                                                @endif
                                                @if (Auth::user()->role === 1 && ($user->role === 2 || $user->role === 4))
                                                    <form action="{{ route('adminadd', ['id' => $user->id]) }}"
                                                        method="GET">
                                                        @csrf
                                                        <td><button class="btn btn-info" type="submit">Make Admin
                                                            </button></td>
                                                    </form>
                                                @endif

                                                @if (Auth::user()->role === 1 && ($user->role === 4 || $user->role === 1))
                                                    <form action="{{ route('commadd', ['id' => $user->id]) }}"
                                                        method="GET">
                                                        @csrf
                                                        <td><button class="btn btn-success" type="submit">Make Commercial
                                                                Agent </button>
                                                        </td>
                                                    </form>

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="col-md-8">
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
                                            <form action="{{ route('updatee', ['id' => $user->id]) }}" method="post"
                                                enctype="multipart/form-data" class="form-horizontal form-bordered">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Username</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static">{{ $user->username }}</p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"
                                                        for="example-text-input">Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $user->name }}">
                                                        <span class="text-danger">@error('name') {{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"
                                                        for="example-email-input">Email</label>
                                                    <div class="col-md-9">
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ $user->email }}">
                                                        <span class="text-danger">@error('email') {{ $message }}
                                                            @enderror</span>
                                                        <span class="help-block">Please enter your email</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"
                                                        for="example-password-input">Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" name="password" class="form-control"
                                                            placeholder="Password">
                                                        <span class="text-danger">@error('password') {{ $message }}
                                                            @enderror</span>
                                                        <span class="help-block">Leave empty if you don't won't to change
                                                            password</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"
                                                        for="example-disabled-input">Phone</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ $user->phone }}">
                                                        <span class="text-danger">@error('phone') {{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label"
                                                        for="example-disabled-input">Adress</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="adress" class="form-control"
                                                            value="{{ $user->adress }}">
                                                        <span class="text-danger">@error('adress') {{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="birthday">Date
                                                        of birth</label>
                                                    <div class="col-md-9">
                                                        <input type="date" id="birthday" name="birthday"
                                                            value="{{ $user->daten }}" min="1900-01-01"
                                                            max="2021-01-01" />
                                                        <span class="text-danger">@error('daten') {{ $message }}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                @if ($user->role === 4)
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label"
                                                            for="example-email-input">Job</label>
                                                        <div class="col-md-9">
                                                            <input type="email" name="job" class="form-control"
                                                                value="{{ $user->personnel->job }}">
                                                            <span class="text-danger">@error('job') {{ $message }}
                                                                @enderror</span>
                                                        </div>
                                                    </div>

                                                @endif
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
                                                    <button type="reset" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-repeat"></i> Cancel</button>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </div>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
@endsection
