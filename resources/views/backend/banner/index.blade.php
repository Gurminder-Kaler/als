@extends('layout.backendlayout')

@section('body')
<div class="card mb-3">
    <div class="card-header">
        <h3>Banners' List</h3>
    </div>
    <div class="card-body">
        {{-- <a href="{{ url('/admin/banner/create') }}" class="mb-2 mr-2
        btn-hover-shine btn btn-sm btn-shadow btn-primary add_new_buton" title="Add New User">
        <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a> 

        <br />
        <br />--}}
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><img src="{{ asset('/storage/banner/'.$item->img.'') }}"
                                    style="height: 60px;width: 80px"></td>
                            <td>
                                {{-- <a href="{{ url('/banner/' . $item->id) }}"
                                title="View User"><button class="mb-2 mr-2 btn btn-shadow-info btn-info"><i
                                        class="pe-7s-look" aria-hidden="true"></i></button></a> --}}
                                <a href="{{ url('/admin/banner/edit/' . $item->id . '') }}"
                                    title="Edit Banner"><button
                                        class="mb-2 mr-2 btn btn-sm btn-shadow-info btn-warning"><i class="fa fa-edit"
                                            aria-hidden="true"></i></button></a>
                                {{-- {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/admin/banner', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'mb-2 mr-2 btn btn-sm btn-shadow-info btn-danger',
                                                'title' => 'Delete User',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!} --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="pagination"> {!! $banner->appends(['search' => Request::get('search')])->render() !!} </div> --}}
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
