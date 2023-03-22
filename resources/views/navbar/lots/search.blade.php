<table class="table ajax-table table-hover active-lots" id="lotTable">
    <thead class="table">
        <tr class="col">
            <th class="col-md-1">Placed</th>
            <th class="col-md-3">Lot</th>
            <th class="col-md-3">Start Bid</th>
            <th class="col-md-3">Category</th>
            <th class="col-md-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($lots as $lot)
            <tr class="col">
                <td class="col-md-1">
                    <?php echo ($lot->is_active == 1) ? '
                    <span style="display: inline-block; border: 1px solid green; padding: 5px; color: green; text-align: center; border-radius: 5px; width: 38px; height: 38px;">✔</span>

                    ' : '
                    <span style="display: inline-block; border: 1px solid red; padding: 5px; color: red; text-align: center; border-radius: 5px; width: 38px; height: 38px;">✘</span>


                    '; ?>
                </td>
                <td class="col col-md-3">{{$lot->name}}</td>
                <td class="col-md-3">$&nbsp;{{$lot->cogs}}</td>
                <td class="col-md-3">
                    @if ($lot->category)
                        {{ $lot->category->name }}
                    @else
                    
                    @endif
                </td>


                <td class="col-md-2">
                    <a
                        href="" 
                        class="btn btn-outline-warning update_lot_form" 
                        data-id="{{ $lot->id }}"
                        data-name="{{ $lot->name }}"
                        data-cogs="{{ $lot->cogs }}"
                        data-description="{{ $lot->description }}"
                        data-is_active="{{ $lot->is_active }}"
                        data-category="{{ $lot->category ? $lot->category->id : 'No category' }}"

                        ><i class="las la-edit"></i>
                    </a>
                    <a 
                        href="" 
                        class="btn btn-outline-danger delete_lot"
                        data-id="{{ $lot->id }}"
                        >
                        <i class="las la-trash"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    <div class="alert alert-warning text-center" role="alert">
                        No data entered, Please add some
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>