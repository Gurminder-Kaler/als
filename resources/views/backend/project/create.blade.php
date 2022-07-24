@extends('layout.backendlayout')

@section('body')
    <div class="container">
        <div class="row">
            {{--@include('backend.sidebar')--}}

            <div class="col-12">
                <div class="card">
                    <div class="card-header">Create New Project</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/project') }}" title="Back"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/admin/project/store', 'class' => 'form-horizontal','enctype'=>'multipart/form-data']) !!}

                        @include ('backend.project.form', ['formMode' => 'create'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
