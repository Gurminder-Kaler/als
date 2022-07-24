@extends('layout.backendlayout')

@section('body')
        <div class="page-title">
        <h3 class="breadcrumb-header">Create New Job Title</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <a href="{{ url('/admin/jobTitle') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::open(['url' => '/admin/jobTitle/store/', 'class' => 'form-horizontal col-md-7','enctype'=>'multipart/form-data']) !!}

            @include ('backend.jobTitle.form', ['formMode' => 'create'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection
