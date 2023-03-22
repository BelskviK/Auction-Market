@extends('layouts.app')
@section('content')
<aside class="sidebar">
    <form action="/search" method="get" class="mb-4">



        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Comming soon ...">
        </div>




        <div class="form-group">

            <div class="checkboxes-for-lot-categories">
            <label for="price-range"><div class="text-center mt-2"style="color: white;overflow-y: auto;">Top Bids</div></label>
            <ul class="list-group">
                

                    <li class="list-group-item d-flex justify-content-between align-items-center">


                        ...


                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">


                        ...


                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">


                        ...


                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">


                        ...


                    </li>


            </ul>
        </div>




        
    </form>
</aside>






<div class='container'>

        <div class='row'>
            <div class="col-md-2">   </div>
            <div class="col-md-8">
                <h2 class='text-center mt-4'>
                    Bids On Lots
                </h2>
                <hr>
                <table class="table ajax-table table-hover">
                    <thead class="table">
                        <tr class="col">
                            <th scope="col">#</th>
                            <th scope="col">Lot</th>
                            <th scope="col">Start Price</th>
                            <th scope="col">Bid Amount</th>
                            <th scope="col">Bidder Name</th>
                            <th scope="col">Time</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bids as $bid)
                        <tr class="col">
                            <th scope="row">{{ $bid->id }}</th>
                            <td>{{ $bid->lot->name ?? 'Lot Deleted' }}</td>
                            <td>{{ $bid->lot->cogs ?? ' ' }}</td>
                            <td>{{ $bid->bid_amount }}</td>
                            <td>{{ $bid->bidder_name }}</td>
                            <td>{{ $bid->created_at }}</td>
                            <td>
                                <a 
                                    href="" 
                                    class="btn btn-outline-danger delete_bidLog"
                                    data-id="{{ $bid->id }}"
                                    >
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-warning text-center" role="alert">
                                    No data entered, Please add some
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table><hr>
            </div>
        </div>
    </div>

        <!-- scripts -->
        @include('navbar.bids.script')


@endsection

