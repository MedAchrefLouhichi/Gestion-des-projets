@extends('layout')
@section('content')

    <div class="row text-center">
        <div class="col-sm-6 col-lg-3">
            <a href=" {{ route('ajouterproject') }}" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-success">
                    <h4 class="widget-content-light"><strong>Number of</strong> Project</h4>
                </div>
                <div class="widget-extra-full"><span class="h2 text-success animation-expandOpen">
                        {{ $nbr }}</span></div>
            </a>
        </div>

        <div class="col-sm-6 col-lg-3">
            <a href="javascript:void(0)" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-danger">
                    <h4 class="widget-content-light"><strong>In Progress</strong></h4>
                </div>
                <div class="widget-extra-full"><span class="h2 text-danger animation-expandOpen">{{ $nbri }}</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="javascript:void(0)" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-dark">
                    <h4 class="widget-content-light"><strong>Clients</strong></h4>
                </div>
                <div class="widget-extra-full"><span
                        class="h2 themed-color-dark animation-expandOpen">{{ $nbrcl }}</span></div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="javascript:void(0)" class="widget widget-hover-effect2">
                <div class="widget-extra themed-background-dark">
                    <h4 class="widget-content-light"><strong>Personnel</strong> </h4>
                </div>
                <div class="widget-extra-full"><span
                        class="h2 themed-color-dark animation-expandOpen">{{ $nbreperso }}</span></div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <!-- Latest Orders Block -->
            <div class="block">
                <!-- Latest Orders Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="page_ecom_orders.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip"
                            title="Show All"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip"
                            title="Settings"><i class="fa fa-cog"></i></a>
                    </div>
                    <h2> Projects</h2>
                </div>
                <!-- END Latest Orders Title -->

                <!-- Latest Orders Content -->
                <table class="table table-borderless table-striped table-vcenter table-bordered">
                    <tbody>
                        @foreach ($projet as $item)
                            <tr>
                                <td class="text-center" style="width: 100px;"><a href="javascript:void(0)"><strong>PID :
                                            {{ $item->id }}</strong></a></td>
                                <td class="hidden-xs"><a
                                        href="{{ route('projectprofile', ['id' => $item->id]) }}">{{ $item->titre }}</a>
                                </td>
                                <td class="hidden-xs">{{ $item->datedeb }}</td>
                                @if ($item->avance == false)
                                    <td class="text-right"><span class="label label-danger">InProgress</span></td>
                                @endif
                                @if ($item->avance == true)
                                    <td class="text-right"><span class="label label-success">Finished</span></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- END Latest Orders Content -->
            </div>

            <!-- END Latest Orders Block -->
        </div>
        <div class="col-lg-6">
            <!-- Top Products Block -->
            <div class="block">
                <!-- Top Products Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <a href="page_ecom_products.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip"
                            title="Show All"><i class="fa fa-eye"></i></a>
                        <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip"
                            title="Settings"><i class="fa fa-cog"></i></a>
                    </div>
                    <h2><strong>Top</strong> Tasks</h2>
                </div>
                <!-- END Top Products Title -->

                <!-- Top Products Content -->
                <table class="table table-borderless table-striped table-vcenter table-bordered">
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="text-center" style="width: 300px;"><a href=""><strong>PID
                                            :{{ $task->id }}</strong></a>
                                </td>
                                <td><a href="{{ route('profiletask', ['id' => $task->id]) }}">{{ $task->name }}</a>
                                </td>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- END Top Products Content -->
            </div>
            <!-- END Top Products Block -->
        </div>
    @endsection
