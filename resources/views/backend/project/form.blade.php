<div class="row">
    <div class="col-md-12">
        <div
            class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            {!! Form::label('title', 'Title: ', ['class' => 'control-label'])
            !!} {!! Form::text('title', null, ['class' => 'form-control',
            'required' => 'required']) !!} {!! $errors->first('title', '
            <p class="help-block">:message</p>
            ') !!}
        </div>
    </div>
    <div class="col-md-12">
        <div
            class="form-group{{ $errors->has('desc') ? ' has-error' : '' }} mt-2">
            {!! Form::label('desc', 'Description: ', ['class' => 'control-label']) !!}
            {!! Form::textarea('desc', null, ['class' => 'form-control', 'required' =>
            'required']) !!} {!! $errors->first('desc', '
            <p class="help-block">:message</p>
            ') !!}
        </div>
    </div>
</div>
<br />
<div
    class="{{ $errors->has('department_id') ? 'row has-error' : ' row' }}">
    {!! Form::label('department_id', 'Select Department: ', ['class' => 'col-6 control-label']) !!}

    <div class="col-6">
        <select class="form-control" required name="department_id" id="department_id">
            <option value="0" selected disabled> No department selected</option>
            @if(isset($departments) && $departments->count() > 0)
                @foreach($departments as $d)
                    <option value="{{ $d->id }}">{{ $d->title }}</option>
                @endforeach
            @endif
        </select>
        {!! $errors->first('department_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<br />

@if($formMode!=="edit")
    <div class="row pt-4">
        <div class="col s6 m6 l6">
            <div class="row section">
                <div class="col s12 m12 l12">
                    FEATURED IMAGE: (Recommended Size Approx: 700px X 700px)
                </div>

                <div class="col s12 m12 l12">
                    <input required accept="image/*" type="file" name="img" />
                </div>
            </div>
        </div>
        <div class="col s6 m6 l6">
            <div class="row section">
                <div class="col s12 m12 l12">
                    MULTIPLE IMAGE(s): (Recommended Size Approx: 700px X 700px)
                    <span style="color: red">(Can be left empty)</span><br /><br />

                    <input type="file" id="input-file-disable-remove" name="images[]" multiple />
                </div>
            </div>
        </div>
    </div>
@else
    <div class="col s6 m6 l6">
        <div class="row section" style="
            border: 1px solid red;
            padding: 12px;
            margin-bottom: 5px;
            margin-top: 5px;
        ">
            <div class="col s12 m12 l12">
                FEATURED IMAGE: (Recommended Size Approx: 700px X 700px) <br />

                <img src="{{ asset('/storage/project/'.$project->img.'') }}"
                    alt="" style="height: 100px; width: 120px" />
                <input type="file" name="img" @if(!$project->img) required @endif />
            </div>
        </div>
    </div>
    <div class="col s12 m12 l12" style="border: 1px solid red; padding: 12px">
        MULTIPLE IMAGE(s): (Recommended Size Approx: 700px X 700px)
        <span style="color: red">(Can be left empty)</span><br />

        @php
        if ($project->images !="") {
            $project_img = explode(';', $project->images); 
        }
        @endphp
            @if(isset($project_img))
            @foreach($project_img as $img)
                <div class="col s3">
                    <input type="hidden" style="display: none" name="img_c[]" value="{{ $img }}" />
                    <img class="project_img{{ $img }}" style="width: 100px; height: 70px"
                        src="{{ asset('/storage/project/'.$img.'') }}"
                        alt="..." />
                    <a class="btn btn-sm btn-danger text-white" onclick="$(this).parent().remove()">Remove</a>
                </div>
            @endforeach
            @endif
            <div class="row" style="border: 1px solid pink; padding: 24px; margin: 2px">
                <div class="col-md-6">
                    <p>
                        Add More Images from here
                        <input class="pt-2" type="file" multiple name="images[]" />
                    </p>
                </div>
            </div>
    </div>
@endif


<div class="form-group pt-4">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' =>
    'btn btn-primary']) !!}
</div>
