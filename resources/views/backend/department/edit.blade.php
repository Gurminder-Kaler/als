@extends('layout.backendlayout') 
@section('body')

<div class="container">
    <div class="row">
        {{--@include('backend.sidebar')--}}
        <div class="page-title">
            <h3 class="breadcrumb-header">
                Edit Department 
                <a
                    href="{{ url('/admin/department/create') }}"
                    class="btn btn-primary btn-sm btn-dark"
                    title="Add New"
                >
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                </a>
                <a href="{{ url('/admin/department') }}" title="Back"
                    ><button class="btn btn-danger btn-sm">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                    </button></a
                >
                 {{--
                <span class="pull-right">
                    {!! Form::open([ 'method' => 'DELETE', 'url' =>
                    ['/admin/department/delete', $department->id], 'style' =>
                    'display:inline' ]) !!} {!! Form::button('<i
                        class="fa fa-trash-o"
                        aria-hidden="true"
                    ></i
                    >', array( 'type' => 'submit', 'class' => 'btn btn-danger
                    btn-sm', 'title' => 'Delete', 'onclick'=>'return
                    confirm("Confirm delete?")' )) !!} {!! Form::close()
                    !!}</span
                >
                --}}
            </h3>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Department</div>
                <div class="card-body">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif {!! Form::model($department, [ 'method' => 'POST', 'url' =>
                    ['/admin/department/update', $department->id], 'class' =>
                    'form-horizontal', 'enctype'=>'multipart/form-data',
                    'files'=>true ]) !!} @include ('backend.department.form',
                    ['formMode' => 'edit']) {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
