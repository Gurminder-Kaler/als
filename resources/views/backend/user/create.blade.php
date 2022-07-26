@extends('layout.backendlayout')

@section('body')
<div class="card">
    <div class="card-header"><a href="{{ url('/admin/user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a> <h3>Create New Employee</h3></div>
    <div class="card-body">
        <br /> 
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open([
            'method' => 'POST',
            'url' => ['/admin/user/store'],
            'class' => 'form-horizontal'
        ]) !!}

        @include ('backend.user.form', ['formMode' => 'create'])

        {!! Form::close() !!}

    </div>
</div> 
@endsection
