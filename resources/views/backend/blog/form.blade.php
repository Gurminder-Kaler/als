 <div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title :', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ('required' == 'required') ? ['class' => 'form-control','placeholder'=>'Title' ] : ['class' => 'form-control','placeholder'=>'Title' ]) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('desc') ? 'has-error' : ''}}">
    {!! Form::label('desc', 'Desc :', ['class' => 'control-label']) !!}
    {!! Form::textarea('desc', null, ('required' == 'required') ? ['class' => 'form-control' ] : ['class' => 'form-control' ]) !!}
    {!! $errors->first('desc', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group bmd-form-group {{ $errors->has('img') ? ' has-error' : ''}}">

    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
    <div class="fileinput-new thumbnail">
      @if($formMode === 'edit')
              @if(!empty($blog->img))
              <img src="{{ asset('storage/img/blog/'.$blog->img.'') }}" alt="...">
              @else
              <img src="{{ asset('dashboard/img/image_placeholder.jpg') }}" alt="...">
              @endif
      @else
             <img src="{{ asset('dashboard/img/image_placeholder.jpg') }}" alt="...">
      @endif
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail"></div>
    <div>
      <label>
      <span class="btn btn-rose btn-round btn-file">
        <span class="fileinput-new">Select Image</span>
        <span class="fileinput-exists">Change</span>
        <input type="file" name="img" @if($formMode==='create') required @endif/>
      </span>
    </label>
      <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
    </div>
    {{-- <h3>Recommended Size:255px X 270px</h3> --}}
    </div>
</div> 
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
