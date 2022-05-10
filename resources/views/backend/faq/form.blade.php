<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'FAQ Title :', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control','placeholder'=>'Changes to itinerary' ] : ['class' => 'form-control','placeholder'=>'PRECIOUS JEWELS RING' ]) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Faq Details :', ['class' => 'control-label']) !!} <br>
    {!! Form::textarea('content', null, ('required' == 'required') ? ['class' => 'form-control','id'=>'description1' ] : ['class' => 'form-control','id'=>'description1']) !!}
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>

@if($formMode==='create')
<div class="form-group{{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Faq Category :', ['class' => 'control-label']) !!} <br>
    <select name="category_id" class="selectpicker">
        @foreach($faqcategory as $fc)
        <option value="{{$fc->id}}">{{$fc->title}}</option>
        @endforeach
    </select>

</div>
@else
<div class="form-group{{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Faq Category :', ['class' => 'control-label']) !!} <br>
    <select name="category_id" class="selectpicker">
        @foreach($faqcategory as $fc)
        <option @if($fc->id == $faq->category_id) selected @endif value="{{$fc->id}}">{{$fc->title}}</option>
        @endforeach
    </select>

</div>
@endif


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
