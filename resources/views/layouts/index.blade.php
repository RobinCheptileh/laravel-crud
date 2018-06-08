@extends('layouts.app')

@section('title', 'Projects')

@section('stylesheets')
    @parent

    <style type="text/css">
        .container-fluid {
            padding: 0 !important;
        }

        .card {
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand" href="{{ route('projects.index') }}">Projects</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link {{ $selected == 'all' ? 'active' : '' }}"
                   href="{{ route('projects.index', array('filter'=>'all')) }}">
                    <i class="material-icons">filter_list</i> All
                </a>
                <a class="nav-item nav-link {{ $selected == 'ongoing' ? 'active' : '' }}"
                   href="{{ route('projects.index', array('filter'=>'ongoing')) }}">
                    Ongoing
                </a>
                <a class="nav-item nav-link {{ $selected == 'pending' ? 'active' : '' }}"
                   href="{{ route('projects.index', array('filter'=>'pending')) }}">
                    Pending
                </a>
                <a class="nav-item nav-link {{ $selected == 'done' ? 'active' : '' }}"
                   href="{{ route('projects.index', array('filter'=>'done')) }}">
                    Done
                </a>
                <a class="nav-item nav-link active" href="{{ route('projects.create') }}">
                    <i class="material-icons">playlist_add</i> Add Project
                </a>
            </div>
        </div>
    </nav>

    <div id="projects" class="container">
        @forelse($projects as $project)
            <div class="card col col-md-6 offset-md-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $project->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ date('l jS F, Y'), strtotime($project->updated_at) }}</h6>
                    <p class="card-subtitle text-muted">
                        <span class="badge badge-pill badge-{{array('PENDING'=>'info','ONGOING'=>'primary','DONE'=>'success')[$project->status]}}">{{ strtolower($project->status) }}</span>&nbsp;
                        <small>Project is {{ $project->active ? 'active' : 'deactivated' }}</small>
                    </p>
                    <br>
                    <p class="card-text">{{ $project->description }}</p>
                    <form action="{{ route('projects.destroy', array('id'=>$project->id)) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete"/>
                        <a href="{{ route('projects.edit', array('id' => $project->id)) }}" class="card-link">Edit</a>
                        <a class="card-link">
                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                        </a>
                    </form>
                </div>
            </div>
        @empty
            <h3 class="text-center">There are no projects yet.</h3>
        @endforelse
    </div>
@endsection