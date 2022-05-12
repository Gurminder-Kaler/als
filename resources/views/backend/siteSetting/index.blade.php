@extends('layout.backendlayout')

@section('body')
    <div class="container"> 
        <div class="card">
            <div class="card-header"><h3>Edit Site Settings</h3></div>
            <div class="card-body"> 
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::model($siteSetting, [
                    'method' => 'post',
                    'url' => ['/admin/site-setting/update'],
                    'class' => 'form-horizontal',
                    'enctype'=>'multipart/form-data'
                ]) !!}

                @include ('backend.siteSetting.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div> 
    </div>
@endsection
