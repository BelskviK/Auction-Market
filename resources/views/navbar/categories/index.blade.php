@extends('layouts.app')
@section('content')


<aside class="sidebar">
    <form action="/search" method="get" class="mb-4">



        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Type to search...">
        </div>




        <div class="form-group category-form-refresh">

            <div class="checkboxes-for-lot-categories">
            <label for="price-range"><div class="text-center mt-2"style="color: white;overflow-y: auto;">By Lots</div></label>
            <ul class="list-group">
            <div>
                @forelse($categories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $category->name }}
                        <span class="badge bg-secondary" id="active-category-counter">
                            {{ $category->lots_count }}
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @if($category->lots->isNotEmpty())
                            <ul>
                                @foreach($category->lots as $lot)
                                    <ul class="text-center">{{ $lot->name }}</ul>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @empty
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Categories
                        <span class="badge bg-secondary" id="active-category-counter">
                            0
                        </span>
                    </li>
                @endforelse
            </div>




            </ul>
        </div>




        
    </form>
</aside>







<div class='container'>

    <div class='row'>
        <div class="col-md-2">   </div>
        <div class="col-md-8">   
            <h2 class='text-center mt-4'>
                Categories For Lots
            </h2>
                <hr>
            <!-- Button trigger modal -->
            <span class=" float-start mb-3 ">
                <button type="button" class="btn btn btn-outline-success openmodal" >
                    <i class="las la-plus"></i>Add Categories 
                </button>
            </span>
            <span class="float-end mb-3">
            </span>
            
            
            <table class="table ajax-table table-hover" id="categoryTable">
                <thead class="table">
                    <tr class="col">
                        <th class="col-md-5">Category</th>
                        <th class="col-md-5">id</th>
                        <th class="col-md-2"></th>
                    </tr>
                </thead>
                <tbody >
                    @forelse ($categories as $category)
                        <tr class="col scrollbar">
                            <td class="col-md-5">{{$category->name}}</td>
                            <td class="col-md-5">{{$category->id}}</td>
                            <td class="col-md-2">
                                <a
                                    href="" 
                                    class="btn btn-outline-warning update_category_form" 
                                    data-id="{{ $category->id }}"
                                    data-name="{{ $category->name }}"
                                    ><i class="las la-edit"></i>
                                </a>
                                <a 
                                    href="" 
                                    class="btn btn-outline-danger delete_category"
                                    data-id="{{ $category->id }}"
                                    >
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <div class="alert alert-warning text-center" role="alert">
                                    No data entered, Please add some
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
                        
            {!! $categories->links('pagination::bootstrap-5') !!}

            <hr>
            
        </div>


    </div>
</div>


<!-- modals for adding and editing -->
@include('navbar.categories.modal.add')
@include('navbar.categories.modal.edit')



<!-- scripts -->
@include('navbar.categories.script')


@endsection







