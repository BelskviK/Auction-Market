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
                </table>