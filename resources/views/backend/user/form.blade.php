<div class="row">
    <div
        class="{{ $errors->has('name') ? ' has-error col-6' : 'col-6' }}">
        {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div
        class="{{ $errors->has('salary') ? ' has-error col-6' : 'col-6' }}">
        {!! Form::label('salary', 'Salary in CAD per annum: ', ['class' => 'control-label']) !!}
        {!! Form::number('salary', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('salary', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<br />
<div
    class="{{ $errors->has('gender') ? 'row has-error' : ' row' }}">
    {!! Form::label('gender', 'Select Gender: ', ['class' => 'col-6 control-label']) !!}

    <div class="col-6">
        <select class="form-control" required name="gender">
            <option value="male">male</option>
            <option value="female">female</option>
            <option value="other">other</option>
        </select>
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<br />
<div class="row">
    <div
        class="{{ $errors->has('email') ? ' has-error col-6' : ' col-6' }}">
        {!! Form::label('email', 'Email: ', ['class' => 'mt-3 control-label']) !!}
        <br />
        {!! Form::email('email', null, ['class' => 'form-control', 'required' =>
        'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
    <div
        class="{{ $errors->has('password') ? 'col-6 has-error' : ' col-6' }}">
        {!! Form::label('password', 'Password: ', ['class' => 'mt-3 control-label']) !!}
        <br />
        @php
            $arr = ['class' => 'form-control']; 
            $passwordOptions = array_merge($arr, ['required' => 'required']); 
        @endphp
        {!! Form::password('password', $passwordOptions) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<br />
<div
    class="{{ $errors->has('job_title_id') ? 'row has-error' : ' row' }}">
    {!! Form::label('job_title_id', 'Select job title: ', ['class' => 'col-6 control-label']) !!}

    <div class="col-6">
        <select class="form-control" required name="job_title_id" id="job_title_id">
            <option value="0" selected disabled> No job title selected</option>
            @if(isset($jobTitles) && $jobTitles->count() > 0)
                @foreach($jobTitles as $d)
                    <option value="{{ $d->id }}">{{ $d->title }}</option>
                @endforeach
            @endif
        </select>
        {!! $errors->first('job_title_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<br />
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
<div
    class="{{ $errors->has('is_head') ? ' has-error row' : ' row' }}">
    {!! Form::label('is_head', 'Is Head of the Department: ', ['class' => 'col-6 control-label']) !!}
    <input type="checkbox" class="form-control col-1" name="is_head" />
</div>
<br />
<div
    class="{{ $errors->has('project_id') ? 'row has-error' : ' row' }}">
    {!! Form::label('project_id', 'Select Project: ', ['class' => 'col-6 control-label']) !!}

    <div class="col-6">
        <span id="project_id">
            <p> Select the department first inorder to select the project.</p>
        </span>
        {!! $errors->first('project_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<br />
<div class="">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' =>
    'btn btn-primary']) !!}
</div>

@section('afterScript')
<script>
$('#department_id').on('change', function () {
    let department_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "/admin/project/getAllProjectsViaDepartmentId/" + department_id,
        async: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            // alert(msg);
            if (result.success == true) {
                $('#project_id').html(result.html);
            } else {
                $('#project_id').html('<p>Something went wrong</p>');
            }
        }
    });
});
</script>
@endsection
