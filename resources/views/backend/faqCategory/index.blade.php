@extends('layout.backendlayout')

@section('body')

        <div class="page-title">
            <h3 class="breadcrumb-header">FAQ Category List &nbsp; <a href="{{ url('/admin/faqcategory/create') }}" class="btn btn-primary btn-sm btn-dark" title="Add New">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a> </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                   
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Faq Category Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($faqcategory as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a href="{{ url('/admin/faqcategory/edit/' . $item->id . '') }}" title="Edit "><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/admin/faqcategory/delete', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Remove', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Category',
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
