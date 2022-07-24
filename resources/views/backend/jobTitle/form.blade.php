<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Job Title :', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control','placeholder'=>'Enter the job title' ] : ['class' => 'form-control','placeholder'=>'Enter the Job Title' ]) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
