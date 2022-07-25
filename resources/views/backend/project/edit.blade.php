@extends('layout.backendlayout') 
@section('body')

<div class="container">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ url('/admin/project') }}" title="Back"
                    ><button class="btn btn-danger btn-sm">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </button></a
                >
                <h3>Edit Project</h3> </div>
                <div class="card-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif {!! Form::model($project, [ 'method' => 'POST', 'url' =>
                    ['/admin/project/update', $project->id], 'class' =>
                    'form-horizontal', 'enctype'=>'multipart/form-data',
                    'files'=>true ]) !!} @include ('backend.project.form',
                    ['formMode' => 'edit']) {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
