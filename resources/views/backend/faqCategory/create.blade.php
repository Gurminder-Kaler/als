@extends('layout.backendlayout')

@section('body')
        <div class="page-title">
        <h3 class="breadcrumb-header">Create New FAQ Category</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <a href="{{ url('/admin/faqcategory') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::open(['url' => '/admin/faqcategory/store/', 'class' => 'form-horizontal col-md-7','enctype'=>'multipart/form-data']) !!}

            @include ('backend.faqcategory.form', ['formMode' => 'create'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection
