@extends('layout.backendlayout')

@section('body')
    <div class="page-title">
        <h3 class="breadcrumb-header">Edit Job Title </h3>
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

            {!! Form::model($jobTitle, [
                'method' => 'POST',
                'url' => ['/admin/jobTitle/update', $jobTitle->id],
                'class' => 'form-horizontal col-md-12',
                'enctype'=>'multipart/form-data'
            ]) !!}

            @include ('backend.jobTitle.form', ['formMode' => 'edit'])

            {!! Form::close() !!}

        </div>
</div>
@endsection
