@extends('layout')
@section('content')

    <!--Content Header Begin -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-user"></i><strong>Profile</strong> {{ $user->name }}<br>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Home</li>

        <li><a href="{{ Route('home') }}">User Profile</a></li>
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
                                                class="rounded-circle" width="200" height="200">
                                            <div class="mt-3">
                                                @csrf
                                                <h4>{{ $user->name }}</h4>
                                                <p class="text-secondary mb-1">{{ $user->username }}</p>
                                                <p class="text-muted font-size-sm">{{ $user->adress }}</p>
                                                @if (Auth::user()->role === 1 || Auth::user()->id === $user->id)
                                                    <a href="{{ route('delete', ['id' => $user->id]) }}"
                                                        class="btn btn-danger" type="submit">Delete </a>

                                                @endif
                                                @if (Auth::user()->id === $user->id || Auth::user()->role === 1)
                                                    <a href="{{ route('update', ['id' => $user->id]) }}"
                                                        class="btn btn-info" type="submit">Update </a>
                                                @endif
                                                @if (Auth::user()->id !== $user->id && $user->role != 3)
                                                    <button class="btn btn-success">Message</button>
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
                                            @csrf
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
                                            <div class="col-sm-3">
                                                <h6 class="mb-2">Full Name</h6>
                                            </div>
                                            <div class="col-sm-7 text-secondary">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone Number</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ '+216 ' . $user->phone }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                {{ $user->adress }}
                                            </div>
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
