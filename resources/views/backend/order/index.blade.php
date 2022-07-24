@extends('layout.backendlayout')

@section('body')
<div class="card mb-3">
    <div class="card-header">
        <h3>Orders' List</h3>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        {{-- <th>Order Id</th> --}}
                        <th>Product X qty</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $item)
                        <tr>
                            {{-- {{dd($item) }} --}}
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td> {{ $item->order_id }}</td> --}}
                            <td>
                                @php
                                    // dd($item);
                                    $productIds = explode(',',$item->product_ids);
                                    $i=0;
                                    $quantities = explode(',',$item->quantities);
                                    // dd($quantities);
                                @endphp
                                @foreach($productIds as $prod)
                                    @php
                                        $productDetail = \App\Models\Product::find($prod);
                                        // dd($quantities);
                                    @endphp
                                    <a href="{{ url('/product/'.$productDetail->slug.'') }}"
                                        target="_blank">
                                        {{ $productDetail->title }}
                                    </a> X
                                    {{isset($quantities[$i])
                              ? $quantities[$i] 
                              : ''}}
                                    @php
                                        $i++;
                                    @endphp
                                    <br>
                                @endforeach
                            </td>
                            <td>$ {{ $item->total_cost }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td>{{ $item->user->name }} <b>|</b> {{ $item->user->email }}</td>
                            <td>
                                <select name="status" class="orderStatus form-control" item_id="{{ $item->id }}">
                                    <option value="placed" @if($item->status=="placed") selected @endif>Placed
                                    </option>
                                    <option value="delivered" @if($item->status=="delivered") selected
                    @endif>Delivered</option>
                    <option value="ontheway" @if($item->status=="ontheway") selected @endif>On the
                        Way</option>
                    </select>
                    </td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td>
                        {{$item->updated_at}}
                    </td>
                    {{-- <td>
                               <a href="{{ url('admin/order/detail/' . $item->id) }}"
                    title="View User"><button class="mb-2 mr-2 btn btn-shadow-info btn-info"><i class="pe-7s-look"
                            aria-hidden="true"></i></button></a> --}}
                    {{-- <a href="{{ url('/admin/order/' . $item->id . '/edit') }}"
                    title="Edit User"><button class="mb-2 mr-2 btn btn-shadow-info btn-warning"><i class="pe-7s-edit"
                            aria-hidden="true"></i></button></a>
                    {!! Form::open([
                    'method' => 'DELETE',
                    'url' => ['/admin/order', $item->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::button('<i class="pe-7s-trash" aria-hidden="true"></i>', array(
                    'type' => 'submit',
                    'class' => 'mb-2 mr-2 btn btn-shadow-info btn-danger',
                    'title' => 'Delete User',
                    'onclick'=>'return confirm("Confirm delete?")'
                    )) !!}
                    {!! Form::close() !!}
                    </td>--}}
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
    $('.orderStatus').on('change', function (e) {
        var id = $(this).attr('item_id');
        var value = $(this).val();
        // e.preventDefault();
        $.ajax({
            type: "POST",
            url: "/admin/order/changeOrderStatus",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                value: value
            },
            success: function (res) {
                if (res.success) {
                    // window.location.href="/";
                    alert('Order Status Changed');
                } else {
                    alert('Something Went Wrong');
                }
            }

        });
    });

</script>
@endsection
