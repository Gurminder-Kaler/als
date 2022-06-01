@extends('layout.frontendlayout')
@section('body')
<div class="container">
    <div class="row my-5">
        <div class="col-10 offset-1">
            <div class="panel panel-default credit-card-box ">
                <div class="panel-heading display-table my-4" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td col-12">{{$donationCause->title}}</h3> <br/>
                        <div class="display-td" >                            
                            <img style="height: 200px;width: 290px" class="img-responsive col-12 pull-right" src="{{asset('/storage/donationCause/'.$donationCause->img.'')}}">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body"> 
                    <p> 
                        {!!$donationCause->desc!!}
                    </p>
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection