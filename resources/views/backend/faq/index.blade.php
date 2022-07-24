@extends('layout.backendlayout')

@section('body')

<div class="page-title">
    <h3 class="breadcrumb-header">FAQ List &nbsp; <a href="{{ url('/admin/faq/create') }}" class="btn btn-primary btn-sm btn-dark" title="Add New">
        <i class="fa fa-plus" aria-hidden="true"></i> Add New FAQ
    </a> &nbsp; <a href="{{ url('/admin/faqcategory/create') }}" class="btn btn-primary btn-sm btn-dark" title="Add New">
        <i class="fa fa-plus" aria-hidden="true"></i> Add New FAQ Category
    </a>&nbsp; <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">View FAQ Category List</button> </h3>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Faq Categories &nbsp; <a href="{{ url('/admin/faqcategory/create') }}" class="btn btn-primary btn-sm btn-dark" title="Add New Faq Category"><i class="fa fa-plus"></i></a></h4>
      </div>
      <div class="modal-body">
        @foreach($faqcategory as $f)
        <p>{{$f->title}}</p>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Faq Title</th>
                        <th>Faq Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faq as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->faqcategory ? $item->faqcategory->title : 'No FAQ Category' }}</td>
                        <td>
                            <a href="{{ url('/admin/faq/edit/' . $item->id . '') }}" title="Edit "><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/admin/faq/delete', $item->id],
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
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
