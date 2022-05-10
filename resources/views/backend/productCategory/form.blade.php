<div class="form-group{{ $errors->has('title') ? ' has-error' : ''}}">
    {!! Form::label('title', 'Title: ', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div> 
<div class="form-group{{ $errors->has('img') ? ' has-error' : ''}}">
{!! Form::label('img', 'Category Image: ', ['class' => 'my-5 control-label']) !!} <br><br>
@if($formMode !== 'edit')
 <input type="file" accept="image/*" required name="img">
@else
<img  src="{{asset('/storage/productcategory/'.$productCategory->img.'')}}" alt="" style="height: 150px;width: 200px">
    <input type="file" name="img">
@endif
</div>

<div class="form-group pt-4">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
