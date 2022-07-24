@extends('layout.backendlayout')

@section('body')
    <div class="container">
        <div class="row">
            {{--@include('backend.sidebar')--}}

            <div class="col-12">
                <div class="card">
                    <div class="card-header">Create New Employee</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
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
            </div>
        </div>
    </div>
@endsection
