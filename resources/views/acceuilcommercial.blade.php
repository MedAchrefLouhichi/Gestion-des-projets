<!doctype html>
<html lang="en">
<div class=first>

    <head>
        <title>Silver Digital</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSS only -->
        <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css') }}"
            rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
            crossorigin="anonymous">
        <link href="{{ asset('https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap') }}"
            rel="stylesheet">




        <!-- MAIN CSS -->
        <link rel="stylesheet" href="{{ asset('/css/index/styleacceuil.css') }}">

    </head>

    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


        <div class="site-wrap" id="home-section">

            <div class="site-mobile-menu site-navbar-target">
                <div class="site-mobile-menu-header">
                    <div class="site-mobile-menu-close mt-3">
                        <span class="icon-close2 js-menu-toggle"></span>
                    </div>
                </div>
                <div class="site-mobile-menu-body"></div>
            </div>



            <header class="site-navbar site-navbar-target" role="banner">

                <div class="container">
                    <div class="row align-items-center position-relative">

                        <div class="col-3 ">
                            <div class="site-logo">
                                <img src="{{ asset('/images/silverlogo.png') }}" alt="" width="200" height="150">
                            </div>
                        </div>

                        <div class="col-9  text-right">


                            <span class="d-inline-block d-lg-none"><a href="#"
                                    class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span
                                        class="icon-menu h3 text-white"></span></a></span>



                        </div>


                    </div>
                </div>

            </header>

            <div class="ftco-blocks-cover-1">
                <div class="site-section-cover overlay" data-stellar-background-ratio="0.5">
                    <div class="container">
                        <div class="row align-items-center justify-content-center text-center">
                            <div class="col-md-7">
                                <p>
                                <h1>Votre Passion.<br>Notre Vision.</h1>
                                </p>
                                @if (Auth::user()->role === 2)
                                    <p><a href="{{ route('projectmanage') }}" class="btn btn-primary">Check your
                                            Work</a>
                                    </p>
                                @endif
                                @if (Auth::user()->role === 4)
                                    <p><a href="{{ route('persotask', ['id' => Auth::user()->id]) }}"
                                            class="btn btn-primary">Check your Work</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
</div>

</body>
<style>
    body {
        overflow-x: hidden;
        background-image: url({{ asset('/images/ll.png') }});
    }

</style>

</html>
