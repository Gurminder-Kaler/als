@extends('layout.backendlayout') @section('body')
<div class="card">
    <div class="card-header">
        <h3>Users' List</h3>
    </div>
    <div class="card-body">
        {{-- <a
                        href="{{ url('/admin/user/create') }}"
        class="btn btn-success btn-sm"
        title="Add New User"
        >
        <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a> --}}
        <a href="{{ url('/admin/user/create') }}" class="btn btn-success btn-sm"
            title="Add New User">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New Employee
        </a>
        <p>Anyone who donates more than $100 in a calendar year is a member and is eligible to receive the ALS magazine called Animal Lover’s News. </p>
        {{-- {!! Form::open(['method' => 'GET', 'url' => '/admin/user',
        'class' => 'form-inline my-2 my-lg-0 float-right', 'role' =>
        'search']) !!}
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search..." />
            <span class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        {!! Form::close() !!} --}} 
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Department & Job Title</th>
                        <th>Is Department Head ?</th>
                        {{--
                                    <th>Actions</th>
                                    --}}
                    </tr>
                </thead>
                <tbody>
                    @if(isset($users) && $users->count() > 0)
                        @foreach($users as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>@if($item->checkIfMember($item->id)) member @else {{ $item->role }} @endif</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if( $item->role == "employee" )

                                        {{$item->employeeDetail->department->title}}
                                         ||
                                        {{$item->employeeDetail->jobTitle->title}}

                                    @endif
                                </td>
                                <td>
                                    @if( $item->role == "employee" )
                                    {{$item->employeeDetail->is_department_head == 1 ? 'Yes' : 'No'}}
                                    @endif
                                </td>
                                {{--<td>
                                       
                                        <a
                                            href="{{ url('/admin/user/' . $item->id) }}"
                                title="View User"
                                ><button class="btn btn-info btn-sm">
                                    <i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                --}}
                                {{--
                                        <a
                                            href="{{ url('/admin/user/edit/' . $item->id . '') }}"
                                title="Edit User"
                                ><button class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                --}} {{-- {!! Form::open([ 'method' =>
                                        'DELETE', 'url' => ['/admin/user',
                                        $item->id], 'style' => 'display:inline'
                                        ]) !!} {!! Form::button('<i
                                            class="fa fa-trash-o"
                                            aria-hidden="true"
                                        ></i
                                        >', array( 'type' => 'submit', 'class'
                                        => 'btn btn-danger btn-sm', 'title' =>
                                        'Delete User', 'onclick'=>'return
                                        confirm("Confirm delete?")' )) !!} {!!
                                        Form::close() !!} 
                                    </td>--}}
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{--
                        <div class="pagination">
                            {!! $users->appends(['search' =>
                            Request::get('search')])->render() !!}
                        </div>
                        --}}
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