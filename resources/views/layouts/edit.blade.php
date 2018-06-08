@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <div class="row">
        <div class="col col-md-4 offset-md-4 form-wrap">
            <h2 class="text-center">{{ $project->name }}</h2>

            <div class="text-center text-danger">
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <form action="{{ route('projects.update', array('id'=>$project->id)) }}" method="post" id="login-form">
                @csrf
                <input type="hidden" name="_method" value="put"/>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">explore</i>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Project Name" aria-label="Name"
                           aria-describedby="basic-addon1" name="name" value="{{ $project->name }}" required>
                </div>
                <div class="input-group mb-3">
                    <textarea class="form-control" placeholder="Description" name="description" required>{{ $project->description }}
                    </textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="col-12">Status</div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="pending-radio"
                               value="PENDING" {{ $project->status == 'PENDING' ? 'checked' : '' }}>
                        <label class="form-check-label" for="pending-radio">Pending</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="ongoing-radio"
                               value="ONGOING" {{ $project->status == 'ONGOING' ? 'checked' : '' }}>
                        <label class="form-check-label" for="ongoing-radio">Ongoing</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="done-radio"
                               value="DONE" {{ $project->status == 'DONE' ? 'checked' : '' }}>
                        <label class="form-check-label" for="done-radio">Done</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active"
                               id="active-check" {{ $project->active ? 'checked' : '' }}>
                        <label class="form-check-label" for="active-check">
                            Active?
                        </label>
                    </div>
                </div>

                <div class="input-group mb-3 text-center">
                    <button type="submit" class="btn btn-primary col-md-12">
                        <i class="material-icons">save</i> Save
                    </button>
                </div>
                <div class="input-group mb-3 text-center">
                    <a href="{{ route('projects.index') }}" class="btn col-md-12">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection