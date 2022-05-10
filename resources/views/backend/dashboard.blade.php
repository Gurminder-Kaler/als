@extends('layout.backendlayout')

@section('body')
    <div class="container">
        <div class="row">
            {{-- @include('backend.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        Your application's dashboard.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
