@extends('layout.backendlayout')

@section('body')
<div class="card mb-3">
    <div class="card-header">
        <h3>Subscribers' List</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Subscribed At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($subscriptions) && $subscriptions->count() > 0)
                        @foreach($subscriptions as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->newsletter_email }}</td> 
                                <td>{{ $d->created_at }}</td>
                                <td>{{ $d->updated_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h2>No subscribers in db</h2>
                            </td>
                            <td></td>
                            <td></td> 
                        </tr>
                    @endif
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
