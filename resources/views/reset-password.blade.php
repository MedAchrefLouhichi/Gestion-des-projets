<!DOCTYPE html>

<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">

    <title>Silver Digital</title>

    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="apple-touch-icon" href="img/icon57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="img/icon72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="img/icon76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="img/icon114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="img/icon120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="img/icon144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="img/icon152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="img/icon180.png" sizes="180x180">
    <!-- END Icons -->


    <link rel="stylesheet" href="{{ asset('/css/index/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index/profile.css') }}">
    <script src="{{ asset('js/vendor/modernizr.min.js') }}">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="js/vendor/modernizr.min.js"></script>
</head>

<body>
    <!-- Login Background -->
    <div id="login-background">
        <!-- For best results use an image with a resolution of 2560x400 pixels (prefer a blurred image for smaller file size) -->
        <!-- <img src="img/placeholders/headers/login_header.jpg" alt="Login Background" class="animation-pulseSlow"> -->
    </div>
    <!-- END Login Background -->

    <!-- Login Container -->
    <div id="login-container" class="animation-fadeIn">
        <!-- Login Title -->
        <div class="login-title text-center">
            <h1><i class="gi gi-flash"></i> <strong>Silver Digital</strong><br><small>reset <strong>Your</strong>
                    password</small></h1>
        </div>
        <!-- END Login Title -->

        <!-- Login Block -->
        <div class="block push-bit">
            <!-- Login Form -->

            <form action="{{ route('password.update') }}" method="post" id="form-login"
                class="form-horizontal form-bordered form-control-borderless">

                @csrf
                <input type="text" value="{{ $token }}" name="token" hidden>
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
                @if (Session::get('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon "><i class="gi gi-envelope"></i></span>
                            <input type="text" name="email" class="form-control input-lg" placeholder="Email"
                                value="{{ old('email') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="password_confirmation" class="form-control input-lg"
                                placeholder="Password">
                        </div>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-8 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Change
                            your password</button>
                    </div>
                </div>

            </form>
            <!-- END Login Form -->

        </div>
        <!-- END Login Block -->

        <!-- Footer -->
        <footer class="text-muted text-center">
            <small><span id="year-copy"></span> &copy; <a href="https://1.envato.market/x4R" target="_blank">Silver
                    Digital</a></small>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Login Container -->


    <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
    <script src="{{ asset('/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/Index/plugins.js') }}"></script>
    <script src="{{ asset('/js/Index/app.js') }}"></script>
    <script src="{{ asset('/js/Index/index.js') }}"></script>

    <!-- Load and execute javascript code used only in this page -->
    <script src="{{ asset('js/logreg/login.js') }}"></script>
    <script>
        $(function() {
            Login.init();
        });

    </script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
    integrity="sha512-3n19xznO0ubPpSwYCRRBgHh63DrV+bdZfHK52b1esvId4GsfwStQNPJFjeQos2h3JwCmZl0/LgLxSKMAI55hgw=="
    crossorigin="anonymous"></script>

</html>
