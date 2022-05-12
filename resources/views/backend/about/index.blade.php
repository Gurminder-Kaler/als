@extends('layout.backendlayout')

@section('body')

    <div class="container">
        <div class="row">

        <div class="page-title">
            <h3 class="breadcrumb-header">Edit About &nbsp;</h3>
        </div>
            <div class="col-md-12">
                <div class="card">
                     <div class="card-header">Edit About Data</div>
                    <div class="card-body">
                        

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($about, [
                            'method' => 'POSST',
                            'url' => ['/admin/about/update'],
                            'class' => 'form-horizontal',
                            'enctype'=>'multipart/form-data',
                            'files'=>true
                        ]) !!}

                        @include ('backend.about.form', ['formMode' => 'edit'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
