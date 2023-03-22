<div class="active-lots">
        <div class="row">
            @foreach ($lots as $lot)
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
                                        {{ $lot->cogs }}
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
            @endforeach
        </div>
    </div>