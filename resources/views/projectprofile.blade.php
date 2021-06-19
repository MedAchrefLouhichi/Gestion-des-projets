@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-4">

            <div class="block">

                <div class="block-title">
                    <h2><i class="fa fa-user-o"></i> <strong>Client</strong> Info</h2>
                </div>

                <div class="block-section text-center">
                    <a href="javascript:void(0)">
                        <img style="height:200px; width:200px" src="{{ asset('photos/' . $client->image) }}" alt="avatar"
                            class="img-circle">
                    </a>
                    <h3>
                        <a href="{{ Route('profile', ['id' => $client->id]) }}">
                            <strong>{{ $client->name }}</strong><br></a>
                    </h3>
                </div>
                <table class="table table-borderless table-striped table-vcenter">
                    <tbody>
                        <tr>
                            <td class="text-right" style="width: 50%;"><strong>Username</strong></td>
                            <td>{{ $client->username }}</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Birthdate</strong></td>
                            <td>{{ $client->daten }}</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Registration</strong></td>
                            <td>{{ $client->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Phone</strong></td>
                            <td>{{ $client->phone }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
        <div class="col-lg-8">

            <div class="block">

                <div class="block-title">
                    @if (Auth::user()->role == 2 || Auth::user()->role == 1)
                        <div class="block-options pull-right">
                            <a href="{{ route('taskadd', ['id' => $project->id]) }}" class="gi gi-plus"> </a>
                        </div>
                    @endif
                    <h2><i class="fa fa-tasks"></i> <strong>Tasks</strong></h2>
                </div>

                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $avancement }}"
                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $avancement }}%;">{{ $avancement }} %
                    </div>
                </div>
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <th class="text-center" style="width: 70px;">ID</th>
                        <th>Task Name</th>
                        <th class="hidden-xs">Statut</th>
                        <th class="hidden-xs text-left">Added</th>
                        <th class="text-left hidden-xs">Deadline</th>
                        <th class="text-center">Action</th>
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
                        @foreach ($tasks as $tache)

                            <tr>
                                <td class="text-center" style="width: 100px;"><a
                                        href="{{ route('profiletask', ['id' => $tache->id]) }}"><strong>PID
                                            {{ $tache->id }}</strong></a></td>
                                <td class="hidden-xs" style="width: 15%;"><a
                                        href="{{ route('profiletask', ['id' => $tache->id]) }}">{{ $tache->name }}</a>
                                </td>
                                @if ($tache->statut == true)
                                    <td><span class="label label-success">Completed</span></td>
                                @endif
                                @if ($tache->statut == false)
                                    <td><span class="label label-danger">Processing</span></td>
                                @endif
                                <td class="hidden-xs">{{ $tache->datedeb }}</td>
                                <td class="hidden-xs text-center">{{ $tache->datefin }}</td>
                                <td class="text-center" style="width: 70px;">
                                    <div class="btn-group btn-group-xs">
                                        <a href="{{ route('profiletask', ['id' => $tache->id]) }}" data-toggle="tooltip"
                                            title="" class="btn btn-default" data-original-title="View"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="{{ route('deletetask', ['id' => $tache->id]) }}" data-toggle="tooltip"
                                            title="" class="btn btn-xs btn-danger" data-original-title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this project ?')"><i
                                                class="fa fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="block">

                <div class="block-title">
                    <h2><i class="fa fa-user"></i> <strong>Commercial Agent</strong> Info</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="block">


                            <h4><a href="{{ Route('profile', ['id' => $commercial->id]) }}"><strong>{{ $commercial->name }}</strong>
                                </a>
                            </h4>
                            <address>
                                {{ $commercial->adress }} <br>
                                <i class="fa fa-phone"></i> {{ $commercial->phone }}<br>
                                <i class="fa fa-envelope-o"></i> <a
                                    href="{{ route('composemsg', ['id' => $commercial->id]) }}">{{ $commercial->email }}</a>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block row">



            <div class="col-lg-12">
                <div class="block-title ">
                    <h2><i class="fa fa-file-archive-o"></i> <strong>Project</strong> Info</h2>
                </div>



                <div class="row">

                    <div class="col-lg-12">

                        <div class="block">

                            <h4><strong>Project Title : <a href="">{{ $project->titre }}</strong>
                                </a>
                            </h4>
                            <address>
                                <strong>Description : {{ $project->descrtiption }} <br></strong>
                                <i class="fa fa-hourglass-start"></i> {{ $project->datedeb }}
                                <i class="fa fa-hourglass-end"></i> {{ $project->datefin }}
                            </address>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
