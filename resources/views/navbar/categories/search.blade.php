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