@extends('layout.frontendlayout')
@section('body')
<div class="container">
    <div class="row my-5">
        <div class="col-10 offset-1">
            <div class="panel panel-default credit-card-box ">
                <div class="panel-heading display-table my-4" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Privacy Policy</h3>
                        <div class="display-td" >                            
                            {{-- <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png"> --}}
                        </div>
                    </div>                    
                </div>
                <div class="panel-body"> 
                    <p> 
                        {!!$siteSetting->privacy_policy!!}
                    </p>
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection
@section('head')
<style type="text/css">
    .panel-title {
    display: inline;
    font-weight: bold;
    }
    .display-table {
        display: table;
    }
    .display-tr {
        display: table-row;
    }
    .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 61%;
    }
    .hide {
        display: none;
    }
</style>
@endsection