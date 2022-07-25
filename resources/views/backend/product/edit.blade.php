@extends('layout.backendlayout')

@section('body')
    <div class="container"> 
        <div class="card">
            <div class="card-header"><h3>Edit Product</h3></div>
            <div class="card-body">
                <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::model($product, [
                    'method' => 'POST',
                    'url' => ['/admin/product/update', $product->id],
                    'class' => 'form-horizontal',
                    'enctype'=>'multipart/form-data',
                    'novalidate'
                ]) !!}

                @include ('backend.product.form', ['formMode' => 'edit'])

                {!! Form::close() !!}

            </div>
        </div>     
    </div>
@endsection
