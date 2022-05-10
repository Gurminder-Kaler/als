@extends('layout.backendlayout')

@section('body')
<div class="container">
    <div class="card mb-3">
        <div class="card-header"><h3>Donations' List</h3></div>
        <div class="card-body">
            {{-- <a href="{{ url('/admin/donation/create') }}" class="mb-2 mr-2 btn-hover-shine btn btn-sm btn-shadow btn-primary add_new_buton" title="Add New User">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>  --}}

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category/Brand</th>
                            <th>Cost/Discount</th>
                            <th>Image</th>
                            <th>Best Seller Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($donations) && $donations->count() > 0)
                        @foreach($donations as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->category ? $item->category->title : '-' }}</td>
                                {{-- <td>{{fetch_category($item->category_id)->title}} / {{ fetch_brand($item->brand_id)->title}}</td> --}}
                                <td>$ {{$item->price}}/ {{$item->discount}} %</td>
                                <td><img src="{{asset('/storage/donation/'.$item->img.'')}}" style="height: 60px;width: 80px"></td>
                                <td><input type="checkbox" class="bestSellerStatus" value="{{$item->id}}" @if($item->best_seller==1) checked @endif></td>
                                <td>
                                    {{-- <a href="{{ url('/donation/' . $item->id) }}" title="View User"><button class="mb-2 mr-2 btn btn-shadow-info btn-info"><i class="pe-7s-look" aria-hidden="true"></i></button></a> --}}
                                    <a href="{{ url('/admin/donation/edit/' . $item->id . '') }}" title="Edit User"><button class="mb-2 mr-2 btn btn-shadow-info btn-sm btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/admin/donation', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn-sm mb-2 mr-2 btn btn-shadow-info btn-danger',
                                                'title' => 'Delete User',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else 
                    <tr>
                        <td></td>  
                        <td></td>  
                        <td></td>  
                        <td><h2>No donations in db</h2> </td>
                        <td></td>  
                        <td></td>  
                        <td></td>  
                    </tr>
                    @endif
                    </tbody>
                </table>
                <div class="pagination"> {!! $donations->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('afterScript')
<script>
     var table = $('#table').DataTable({
        'responsive': true
    });
     $('.bestSellerStatus').on('click',function(e){
        var id = $(this).val();
         $.ajax({
                type: "POST",
                url: "/admin/bestSellerStatus",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                },
                success: function (res) {
                    if(res.success){
                        $('#search_filter').html(res.data);
                    }
                }
            });

     });
</script>
@endsection
