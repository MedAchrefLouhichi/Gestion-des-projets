@extends('layout')
@section('content')

    <!--Content Header Begin -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-user"></i><strong>Create</strong> Project<br>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="{{ Route('home') }}">Home</a></li>

        <li>Create Project</li>
    </ul>
    <div class="bloc">

        <body>
            <div class="block">
                <!-- Clickable Wizard Title -->
                <div class="block-title">
                    <h2><strong>Please Complete</strong> these steps</h2>
                </div>
                <!-- END Clickable Wizard Title -->

                <!-- Clickable Wizard Content -->
                <form id="clickable-wizard" action="{{ route('projectadd') }}" method="post"
                    class="form-horizontal form-bordered ui-formwizard">
                    @csrf
                    <!-- First Step -->
                    <div id="clickable-first" class="step ui-formwizard-content" style="display: block;">
                        <!-- Step Info -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <ul class="nav nav-pills nav-justified clickable-steps">
                                    <li class="active"><a href="javascript:void(0)"
                                            data-gotostep="clickable-first"><strong>1.
                                                Get Started</strong></a></li>
                                    <li><a href="javascript:void(0)" data-gotostep="clickable-second"><strong>2.
                                                Choose a Client</strong></a></li>
                                    <li><a href="javascript:void(0)" data-gotostep="clickable-third"><strong>3.
                                                Finishing up</strong></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Step Info -->
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
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="commercial">Commercial Agent</label>
                            <div class="col-md-5">
                                <div class="col-md-9">
                                    <p class="form-control-static" id="commercial" name="commercial">
                                        <strong>{{ Auth::user()->name }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="title">Title</label>
                            <div class="col-md-5">
                                <input type="text" id="title" name="titre" class="form-control ui-wizard-content"
                                    value="{{ old('titre') }}">
                                <span class="text-danger">@error('titre') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                <label class="col-md-6 control-label">Choose the type of project</label>
                                <label class="radio-inline" for="example-inline-radio1">
                                    <input type="radio" id="example-inline-radio1" name="type" value="1"> Projet Marketing
                                </label>
                                <label class="radio-inline" for="example-inline-radio2">
                                    <input type="radio" id="example-inline-radio2" name="type" value="2"> Site
                                    E-commerce
                                </label>
                                <label class="radio-inline" for="vitrine">
                                    <input type="radio" id="vitrine" name="type" value="3"> Site
                                    Vitrine
                                </label>
                                <span class="text-danger">@error('type') {{ $message }} @enderror</span>
                            </div>
                        </div>

                    </div>
                    <!-- END First Step -->

                    <!-- Second Step -->
                    <div id="clickable-second" class="step ui-formwizard-content" style="display: none;">
                        <!-- Step Info -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <ul class="nav nav-pills nav-justified clickable-steps">
                                    <li><a href="javascript:void(0)" data-gotostep="clickable-first"><i
                                                class="fa fa-check"></i>
                                            <strong>1. Get Started</strong></a></li>
                                    <li class="active"><a href="javascript:void(0)"
                                            data-gotostep="clickable-second"><strong>2.
                                                Choose a Client</strong></a></li>
                                    <li><a href="javascript:void(0)" data-gotostep="clickable-third"><strong>3.
                                                Finishing up</strong></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Step Info -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="clientsearch">Enter client</label>
                            <div class="col-md-5">
                                <input type="text" id="clientsearch" name="client" class="form-control ui-wizard-content">
                            </div>
                            <span class="text-danger">@error('clientcheck') {{ $message }} @enderror</span>
                        </div>
                        <div class="table-responsive">
                            <table id="general-table" class="table table-vcenter table-hover table-bordered ">
                                <thead>
                                    <th><i class="fa fa-picture-o"></i></th>
                                    <th><i class="gi gi-user"></i></th>
                                    <th>Action</th>
                                </thead>
                                <tbody>

                                    @csrf

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Second Step -->

                    <!-- Third Step -->
                    <div id="clickable-third" class="step ui-formwizard-content" style="display: none;">
                        <!-- Step Info -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <ul class="nav nav-pills nav-justified clickable-steps">
                                    <li><a href="javascript:void(0)" data-gotostep="clickable-first"><i
                                                class="fa fa-check"></i>
                                            <strong>1. Getting Started</strong></a></li>
                                    <li><a href="javascript:void(0)" data-gotostep="clickable-second"><i
                                                class="fa fa-check"></i> <strong>2. Choose a client</strong></a></li>
                                    <li class="active"><a href="javascript:void(0)"
                                            data-gotostep="clickable-third"><strong>3.
                                                Finishing up</strong></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Step Info -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-8">
                                <textarea name="Description" rows="6" class="form-control ui-wizard-content"
                                    placeholder="Anything about this project ?" disabled="disabled"
                                    value="{{ old('Description') }}"></textarea>
                                <span class="text-danger">@error('Description') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Start date</label>
                            <div class="col-md-8">
                                <input type="date" name="datedeb" min="{{ now() }}" />
                                <span class="text-danger">@error('datedeb') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Finishing date</label>
                            <div class="col-md-8">
                                <input type="date" name="datefin" />
                                <span class="text-danger">@error('datefin') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                    <!-- END Third Step -->

                    <!-- Form Buttons -->
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="reset" class="btn btn-sm btn-warning ui-wizard-content ui-formwizard-button"
                                id="back4" value="Back" disabled="disabled">Previous</button>
                            <button type="submit" class="btn btn-sm btn-primary ui-wizard-content ui-formwizard-button"
                                id="next4" value="Next">Continue</button>
                        </div>
                    </div>
                    <!-- END Form Buttons -->
                </form>
                <!-- END Clickable Wizard Content -->
            </div>
        </body>
    </div>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
    <script src="{{ asset('js/projects/formsWizard.js') }}"></script>
    <script>
        $(function() {
            FormsWizard.init();
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#clientsearch').on('keyup', function() {
                $.ajax({
                    url: "{{ route('livesearcch') }}",
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
@endsection
