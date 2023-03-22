@extends('layouts.app')
@section('content')

<aside class="sidebar">
    <form action="/search" method="get" class="mb-4">



        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Type to search...">
        </div>




        <div class="form-group lot-form-refresh">
            <div class="checkboxes-for-lot-categories">
                <label for="price-range">
                    <div class="text-center mt-2" style="color: white; overflow-y: auto;">Select Category</div>
                </label>
                <ul class="list-group">
                    @php
                        $categoryCounts = [];
                    @endphp
                    @forelse($categories as $category)
                        @php
                            $lotCount = app\Models\Lot::where('category_id', $category->id)
                                                        ->where('is_active', 1)
                                                        ->count();
                            $categoryCounts[$category->name] = $lotCount;
                        @endphp
                    @empty
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <input class="form-check-input me-1" type="checkbox">
                            Categories
                            <span class="badge bg-secondary" id="active-category-counter">
                                0
                            </span>
                        </li>
                    @endforelse
                    @php
                        arsort($categoryCounts);
                    @endphp
                    @foreach($categoryCounts as $categoryName => $lotCount)
                        @php $category = app\Models\Category::where('name', $categoryName)->first(); @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <input class="form-check-input me-1" type="checkbox" data-id="{{ $category->id }}" 
                                {{ $lotCount > 0 ? 'checked' : '' }} value="" aria-label="...">
                            {{ $categoryName }}
                            <span class="badge bg-secondary" id="active-category-counter">
                                {{ $lotCount }}
                            </span>
                        </li>
                    @endforeach
                    

                </ul>
            </div>
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
                <a class="nav-link"  href="{{route('lot.index')}}">
                        <span>
                                reset
                        </span>
                    </a> 
            </button>
        </span>
    </form>
</aside>







<div class='container'>

    <div class='row'>
        <div class="col-md-2">   </div>
        <div class="col-md-8">   
            <h2 class='text-center mt-4'>
                Lots For Market
            </h2>
            <hr>
            <!-- Button trigger modal -->
            <span class=" float-start mb-3 ">
                <button type="button" class="btn btn btn-outline-success openmodal" >
                    <i class="las la-plus"></i>Add lots 
                </button>
            </span>
            <span class="float-end mb-3">
                
            </span>
            
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
            {!! $lots->links('pagination::bootstrap-5') !!}
            <hr>
        </div>

    </div>


    <!-- modals for adding and editing -->
    @include('navbar.lots.modal.add')
    @include('navbar.lots.modal.edit')



    <!-- scripts -->
    @include('navbar.lots.script')
</div>
    

@endsection

