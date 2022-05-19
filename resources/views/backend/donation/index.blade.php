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
                            <th>#</th>
                            <th>Amount Donated</th>
                            <th>Transaction Id</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($donations) && $donations->count() > 0)
                        @foreach($donations as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->amount}}</td>
                                <td>{{$d->transaction_id}}</td>
                                <td>{{$d->created_at}}</td>
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
