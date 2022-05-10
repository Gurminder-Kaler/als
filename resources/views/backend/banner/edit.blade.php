@extends('layout.backendlayout')

@section('body')
<div class="container">
    <div class="card">
        <div class="card-header">Edit banner</div>
        <div class="card-body">
            <a href="{{ url('/admin/banner') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::model($banner, [
                'method' => 'POST',
                'url' => ['/admin/banner/update', $banner->id],
                'class' => 'form-horizontal',
                'enctype'=>'multipart/form-data'
            ]) !!}

            @include ('backend.banner.form', ['formMode' => 'edit'])

            {!! Form::close() !!}

        </div>
    </div> 
</div>
@endsection
