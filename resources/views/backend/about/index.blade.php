@extends('layout.backendlayout')

@section('body')
    <div class="card">
        <div class="card-header"><h3>Edit About Data</h3></div>
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
@endsection
