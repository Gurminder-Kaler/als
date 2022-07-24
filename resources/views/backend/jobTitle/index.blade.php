@extends('layout.backendlayout')

@section('body') 
    <div class="card">
        <div class="card-header">
            <h3 class="breadcrumb-header">Job Title List </h3> &nbsp; <a href="{{ url('/admin/jobTitle/create') }}" class="btn btn-primary btn-sm btn-dark" title="Add New">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">              
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Job Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($jobTitles as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <a href="{{ url('/admin/jobTitle/edit/' . $item->id . '') }}" title="Edit "><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                {!! Form::open([
                                    'method' => 'POST',
                                    'url' => ['/admin/jobTitle/delete', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Remove', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Job Title',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('afterScript')
<script>
    var table = $('#table').DataTable({
        'responsive': true
    });

</script>
@endsection