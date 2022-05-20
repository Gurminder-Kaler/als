<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Cause Title :', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control','placeholder'=>'Changes to itinerary' ] : ['class' => 'form-control','placeholder'=>'PRECIOUS JEWELS RING' ]) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('desc') ? 'has-error' : ''}}">
    {!! Form::label('desc', 'Description :', ['class' => 'control-label']) !!} <br>
    {!! Form::textarea('desc', null, ('required' == 'required') ? ['class' => 'form-control' ] : ['class' => 'form-control']) !!}
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('amount') ? 'has-error' : ''}}">
    {!! Form::label('amount', 'Amount :', ['class' => 'control-label']) !!} <br>
    {!! Form::number('amount', null, ('required' == 'required') ? ['class' => 'form-control' ] : ['class' => 'form-control']) !!}
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Duration :', ['class' => 'control-label']) !!} <br>
    {!! Form::number('duration', null, ('required' == 'required') ? ['class' => 'form-control' ] : ['class' => 'form-control']) !!}
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('img') ? 'has-error' : ''}}">
    {!! Form::label('img', 'Image :', ['class' => 'control-label']) !!} <br>
    <input type="file" name="img" class="form-control">
    {!! $errors->first('img', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
