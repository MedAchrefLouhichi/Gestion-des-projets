@extends('layout')
@section('content')

    <div class="row text-center">
        @if (Auth::user()->role == 2)
            <div class="col-sm-6 col-lg-3">
                <a href=" {{ route('ajouterproject') }}" class="widget widget-hover-effect2">
                    <div class="widget-extra themed-background-success">
                        <h4 class="widget-content-light"><strong>Add New</strong> Project</h4>
                    </div>
                    <div class="widget-extra-full"><span class="h2 text-success animation-expandOpen"><i
                                class="fa fa-plus"></i></span></div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                    <div class="widget-extra themed-background-danger">
                        <h4 class="widget-content-light"><strong>In Progress</strong></h4>
                    </div>
                    <div class="widget-extra-full"><span
                            class="h2 text-danger animation-expandOpen">{{ $inprog }}</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                    <div class="widget-extra themed-background-dark">
                        <h4 class="widget-content-light"><strong>Completed</strong></h4>
                    </div>
                    <div class="widget-extra-full"><span
                            class="h2 themed-color-dark animation-expandOpen">{{ $done }}</span></div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3">
                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                    <div class="widget-extra themed-background-dark">
                        <h4 class="widget-content-light"><strong>All</strong> Pojects</h4>
                    </div>
                    <div class="widget-extra-full"><span
                            class="h2 themed-color-dark animation-expandOpen">{{ $sum }}</span></div>
                </a>
            </div>
    </div>
    @endif
    @if (Auth::user()->role != 2)
        <div class="row text-center">
            <div class="col-sm-4 col-lg-4">
                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                    <div class="widget-extra themed-background-danger">
                        <h4 class="widget-content-light"><strong>In Progress</strong></h4>
                    </div>
                    <div class="widget-extra-full"><span
                            class="h2 text-danger animation-expandOpen">{{ $inprog }}</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-4">
                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                    <div class="widget-extra themed-background-dark">
                        <h4 class="widget-content-light"><strong>Completed</strong></h4>
                    </div>
                    <div class="widget-extra-full"><span
                            class="h2 themed-color-dark animation-expandOpen">{{ $done }}</span></div>
                </a>
            </div>
            <div class="col-sm-4 col-lg-4">
                <a href="javascript:void(0)" class="widget widget-hover-effect2">
                    <div class="widget-extra themed-background-dark">
                        <h4 class="widget-content-light"><strong>All</strong> Pojects</h4>
                    </div>
                    <div class="widget-extra-full"><span
                            class="h2 themed-color-dark animation-expandOpen">{{ $sum }}</span></div>
                </a>
            </div>
        </div>
    @endif
    <!-- END Quick Stats -->

    <!-- All Products Block -->
    <div class="block full">
        <!-- All Products Title -->
        <div class="block-title">
            <h2><strong>All</strong> Projects</h2>
        </div>
        <!-- END All Products Title -->

        <!-- All Products Content -->
        <table id="ecom-products" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" style="width: 70px;">ID</th>
                    <th>Project Title</th>
                    <th class="text-left hidden-xs">Type</th>
                    <th class="hidden-xs">Statut</th>
                    <th class="hidden-xs text-center">Added</th>
                    <th class="text-center">Action</th>
                </tr>
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
                @foreach ($projects as $projet)
                    <tr>
                        <td class="text-center"><a href="{{ route('projectprofile', ['id' => $projet->id]) }}"><strong>PID
                                    {{ $projet->id }}</strong></a>
                        </td>
                        <td><a href="{{ route('projectprofile', ['id' => $projet->id]) }}">{{ $projet->titre }}</a>
                        </td>
                        <td class="text-left hidden-xs">
                            @if ($projet->type == 3)
                                <strong>Site Vitrine</strong>
                            @endif
                            @if ($projet->type == 2)
                                <strong>Site E-Commerce</strong>
                            @endif
                            @if ($projet->type == 1)
                                <strong>Plan Marketing</strong>
                            @endif
                        </td>
                        <td class="hidden-xs">
                            @if ($projet->avance == false)
                                <span class="label label-danger">
                                    InProgress
                                </span>
                            @endif
                            @if ($projet->avance == true)
                                <span class="label label-success">
                                    Finishied
                                </span>
                            @endif
                        </td>
                        <td class="hidden-xs text-center">{{ $projet->datedeb }}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-xs">
                                <a href="page_ecom_product_edit.html" data-toggle="tooltip" title="Edit"
                                    class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('projectdelete', ['id' => $projet->id]) }}" data-toggle="tooltip"
                                    title="Delete" class="btn btn-xs btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this project ?')"><i
                                        class="fa fa-times"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
@endsection
