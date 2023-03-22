@extends('layouts.app')
@section('content')
<aside class="sidebar">
    <form action="/search" method="get" class="mb-4">



        <div class="form-group">
            <input type="text" id="sidebar-search" class="form-control" placeholder="Type to search...">
        </div>




        <div class="form-group">

            <div class="checkboxes-for-lot-categories">
                
            <label for="price-range"><div class="text-center mt-2"style="color: white;overflow-y: auto;">Select Category</div></label>
            <ul class="list-group">
            @forelse($categories as $category)
                @php
                    $lotCount = app\Models\Lot::where('category_id', $category->id)
                                                ->where('is_active', 1)
                                                ->count();
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <input class="form-check-input me-1" type="checkbox" data-id="{{ $category->id }}" 
                    {{ $lotCount > 0 ? 'checked' : '' }} value="" aria-label="...">


                    {{ $category->name }}
                    <span class="badge bg-secondary" id="active-category-counter">
                        {{$category->category_name}} {{$lotCount}}
                    </span>
                </li>
            @empty
                <li class="list-group-item d-flex justify-content-between align-items-center">  
                    No Categories To Filter
                </li>   
            @endforelse

            </ul>
        </div>




        
        <div class="form-group">
            
            <label for="price-range"><div class="text-center mt-2"style="color: white;overflow-y: auto;">Price Range</div></label>
            <div class="input-group">


                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>




                <input type="number" class="form-control" id="price_range_from" name="price_range_from" placeholder="From">
            </div>
        </div>
        <div class="form-group">
            
            <div class="input-group">


                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>



                <input type="number" class="form-control" id="price_range_to" name="price_range_to" placeholder="To">


            </div>
        </div>
        <span class=" float mb-3 ">
            <button type="button" class="btn btn btn-primary" >
                <a class="nav-link"  href="{{route('market.index')}}">
                        <span>
                                reset
                        </span>
                    </a> 
            </button>
        </span>
    </form>
</aside>


<div class="container">
    <h1 class="text-center mb-3 mt-4" >Make Your Bid</h1>
    <div class="active-lots">
        <div class="row">
            @forelse ($lots as $lot)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between">
                            <div>
                                <h3 class="card-title text-center"><b>{{ $lot->name }}</b></h3>
                                <hr>
                                
                                <div class="row justify-content-evenly">
                                    <div class="col-4">
                                        <b>Start Price:</b>
                                    </div>
                                    <div class="col-4">
                                        $&nbsp;{{ $lot->cogs }}
                                    </div>
                                </div>

                                <div class="row justify-content-evenly mt-2">
                                    <div class="col-4">
                                        <p class="card-text"><b>Category:</b>
                                    </div>
                                    <div class="col-4">
                                        {{ $lot->category ? $lot->category->name : 'No Category' }}
                                    </div>
                                </div>
                                <p class="card-text mb-1">
                                    <div class="text-center">
                                        <b>description:</b>
                                    </div>
                                    <div class="text-center">
                                        {{ $lot->description }}
                                    </div>
                                </p>
                            </div>
                            <form action="{{ route('bid.store', $lot) }}" method="POST" class="add-bid-form">
                                @csrf
                                <div class="form-group">
                                    <label for="bid_amount"><b>Bid amount:</b></label>
                                    <input type="number" class="form-control bid-amount" name="bid_amount" data-id="{{$lot->id}}" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="bidder_name"><b>Your name:</b></label>
                                    <input type="text" class="form-control bidder-name" name="bidder_name" data-id="{{$lot->id}}" required>
                                </div>
                                <button type="button" data-id="{{ $lot->id }}" class="btn btn-outline-primary text-center mt-2 place-bid">Place bid</button>
                            </form>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between">
                            
                            <p></p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between">
                            
                            <p>Sorry there is no active auction for now</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between">
                            
                            <p></p>

                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

    
<!-- scripts -->
@include('navbar.market.script')
@endsection
