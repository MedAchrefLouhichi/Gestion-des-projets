@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-4">

            <div class="block">

                <div class="block-title">
                    <h2><i class="fa fa-user-o"></i> <strong>Project</strong> Info</h2>
                </div>

                <div class="block-section text-center">
                    <h3>
                        <a href="{{ Route('projectprofile', ['id' => $project->id]) }}">
                            <strong>{{ $project->titre }}</strong><br></a>
                    </h3>
                </div>
                <table class="table table-borderless table-striped table-vcenter">
                    <tbody>
                        <tr>
                            <td class="text-right" style="width: 50%;"><strong>Type</strong></td>
                            <td>
                                @if ($project->type == 3)
                                    <strong>Site Vitrine</strong>
                                @endif
                                @if ($project->type == 2)
                                    <strong>Site E-Commerce</strong>
                                @endif
                                @if ($project->type == 1)
                                    <strong>Plan Marketing</strong>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Start</strong></td>
                            <td>{{ $project->datedeb }}</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Finish</strong></td>
                            <td>{{ $project->datefin }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
        <div class="col-lg-8">

            <div class="block">

                <div class="block-title">
                    <h2><i class="fa fa-user"></i> <strong>Task</strong> Info</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="block">
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
                            @if (Auth::user()->role == 4 && $task->statut != true)
                                <div class="block-options pull-right">
                                    <a href="{{ route('statutchange', ['id' => $task->id]) }}"
                                        onclick="return confirm('Are you sure you want to change the statut of this task ?')"
                                        class="fa fa-check fa-2x text-success"> </a>
                                </div>
                            @endif
                            <h4><strong> Task name :<a href=""> {{ $task->name }}</strong>
                                </a>
                            </h4>
                            <address>
                                <strong>Statut : </strong>
                                @if ($task->statut == false)
                                    <span class="label label-danger">
                                        InProgress <br>
                                    </span>
                                @endif
                                @if ($task->statut == true)
                                    <span class="label label-success">
                                        Finishied
                                    </span> <br>
                                @endif
                                <br><i class="fa fa-phone"></i>
                                <strong>Start date : {{ $task->datedeb }} </strong>
                                <br><i class="fa fa-phone"></i>
                                <strong>Finish date : {{ $task->datefin }} </strong>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
