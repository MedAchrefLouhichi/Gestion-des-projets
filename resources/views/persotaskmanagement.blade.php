@extends('layout')
@section('content')

    <div class="row text-center">
        <div class="col-sm-4 col-lg-4">
            <a href="javascript:void(0)" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-danger">
                    <h4 class="widget-content-light"><strong>In Progress</strong></h4>
                </div>
                <div class="widget-extra-full"><span class="h2 text-danger animation-expandOpen">{{ $inprog }}</span>
                </div>
            </a>
        </div>
        <div class="col-sm-4 col-lg-4">
            <a href="javascript:void(0)" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-dark">
                    <h4 class="widget-content-light"><strong>Completed</strong></h4>
                </div>
                <div class="widget-extra-full"><span
                        class="h2 themed-color-dark animation-expandOpen">{{ $finish }}</span></div>
            </a>
        </div>
        <div class="col-sm-4 col-lg-4">
            <a href="javascript:void(0)" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-dark">
                    <h4 class="widget-content-light"><strong>All</strong> Tasks</h4>
                </div>
                <div class="widget-extra-full"><span
                        class="h2 themed-color-dark animation-expandOpen">{{ $sum }}</span></div>
            </a>
        </div>
    </div>
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
                    <th>Task Title</th>
                    <th class="text-left hidden-xs">Type</th>
                    <th class="hidden-xs">Statut</th>
                    <th class="hidden-xs text-center">Added</th>
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
                @foreach ($tasks as $task)
                    <tr>
                        <td class="text-center"><a href="{{ route('profiletask', ['id' => $task->id]) }}"><strong>PID
                                    {{ $task->id }}</strong></a>
                        </td>
                        <td><a href="{{ route('profiletask', ['id' => $task->id]) }}">{{ $task->name }}</a></td>
                        <td class="hidden-xs">
                            @if ($task->statut == false)
                                <span class="label label-danger">
                                    InProgress
                                </span>
                            @endif
                            @if ($task->statut == true)
                                <span class="label label-success">
                                    Finishied
                                </span>
                            @endif
                        </td>
                        <td class="hidden-xs text-center">{{ $task->datedeb }}</td>
                        <td class="hidden-xs text-center">{{ $task->datefin }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
@endsection
