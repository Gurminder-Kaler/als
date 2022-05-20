@extends('layout.backendlayout')

@section('body')
    <div class="page-title">
        <h3 class="breadcrumb-header">Edit Donation Cause </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <a href="{{ url('/admin/donationCause') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            {!! Form::model($donationCause, [
                'method' => 'POST',
                'url' => ['/admin/donationCause/update', $donationCause->id],
                'class' => 'form-horizontal col-md-12',
                'enctype'=>'multipart/form-data'
            ]) !!}

            @include ('backend.donationCause.form', ['formMode' => 'edit'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection
