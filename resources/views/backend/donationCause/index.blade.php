@extends('layout.backendlayout')

@section('body')

        <div class="page-title">
            <h3 class="breadcrumb-header">Donation Cause List &nbsp; <a href="{{ url('/admin/donationCause/create') }}" class="btn btn-primary btn-sm btn-dark" title="Add New"> <i class="fa fa-plus"></i> Add New</a> </h3>
        </div>
 
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                   
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cause Title</th>
                                <th>Cause Description</th>
                                <th>Cause Amount</th>
                                <th>Cause Duration</th>
                                <th>Cause Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($donationCauses))
                        @foreach($donationCauses as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->desc }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->duration }}</td>
                                <td>{{ $item->img }}</td>
                                
                                <td>
                                    <a href="{{ url('/admin/donationCause/edit/' . $item->id . '') }}" title="Edit "><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/admin/donationCause/delete', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Remove', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Country',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        @else

                        @endif  
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
        </div>
</div>

@endsection
