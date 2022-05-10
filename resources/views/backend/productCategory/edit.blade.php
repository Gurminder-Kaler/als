@extends('layout.backendlayout')

@section('body')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit Category</div>
            <div class="card-body">
                <a href="{{ url('/admin/productCategory') }}" title="Back">
                    <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::model($productCategory, [
                    'method' => 'POST',
                    'url' => ['/admin/productCategory/update', $productCategory->id],
                    'class' => 'form-horizontal',
                    'enctype'=>'multipart/form-data'
                ]) !!}

                @include ('backend.productCategory.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div>
           
    </div>
@endsection
