<div class="form-group{{ $errors->has('img') ? ' has-error' : ''}}">
{!! Form::label('img', 'Banner Image: ', ['class' => 'control-label']) !!}
@if($formMode != 'edit')
 <input type="file" required name="img">
@else
<img src="{{asset('/storage/banner/'.$banner->img.'')}}" alt="" style="height: 150px;width: 200px">
    <input type="file" name="img">
@endif
</div>

<div class="form-group pt-4">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-sm btn-primary']) !!}
</div>
