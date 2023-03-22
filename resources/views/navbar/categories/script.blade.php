<!-- Script -->
<script type='text/javascript'>
    $(document).ready(function(){
        //post method CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Opens addCategory Modal
        $(document).on('click','.openmodal',function(){
            $('.errMsgContainer').empty(); // Empty the container before appending new messages
            $('#addCategoryForm')[0].reset();
            $('#addCategory').modal('show');
            
        })

        //adds Category by clicking modal submit button without refreshing page
        $(document).on('click', '.add_category',function(e){
            e.preventDefault();
            let name = $('#name').val();
            console.log(name);
            $.ajax({
                url: "{{ route('category.add') }}",
                type:'POST',
                data:{name:name},
                success:function(res){
                    if(res.status=='success'){
                        $('#addCategory').modal('hide');
                        $('.modal-backdrop').remove();
                        $('#addCategoryForm')[0].reset();
                        $('.ajax-table').load(location.href+' .ajax-table');
                        $('.category-form-refresh').load(location.href + ' .category-form-refresh');

                        // Category added successfully label
                        Command: toastr["success"]("Category added")
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                },

                error:function(err){
                    $('.errMsgContainer').html('');
                    let error = err.responseJSON;
                    if(error.status == 'error'){
                        $('.errMsgContainer').html('<span class="text-danger">'+error.message+'</span>');
                    } else {
                        $.each(error.errors,function(index, value){
                            $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                        });
                    }
                },
            });
        })

                                

        //Shows  Category in update form in modal
        $(document).on('click', '.update_category_form',function(e){
            e.preventDefault();
            
            $('.errMsgContainer').empty(); // Empty the container before appending new messages
            $('#updateCategory').modal('show');
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#up_id').val(id);
            $('#up_name').val(name);
        });

        //updates category from UpdateCategory modal by clicking submit button withot refreshing page
        $(document).on('click', '.update_category',function(e){
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();

            $.ajax({  
                url: "{{ route('category.update') }}",
                type: 'POST',
                data:{up_id:up_id,up_name:up_name},
                success:function(res){
                    if(res.status=='success'){

                        $('#updateCategoryForm')[0].reset();
                        $('.ajax-table').load(location.href+' .ajax-table');
                        $('#updateCategory').modal('hide');
                        $('.modal-backdrop').remove();
                        $('.category-form-refresh').load(location.href + ' .category-form-refresh');

                        //Category edited successfully label
                        Command: toastr["warning"]("Category edited")
                        toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                    
                },
                //controller validatior for unique category name and integer price
                error:function(err){
                    $('.errMsgContainer').html('');
                    let error = err.responseJSON;
                    $.each(error.errors,function(index, value){
                        $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                },
            });
        })


    //deletes category softly with undo button without refreshing page
    $(document).on('click', '.delete_category', function(e){
        e.preventDefault();
        let category_id = $(this).data('id');
        // Validation for deleting
        if(confirm('Are you sure you want to delete this category?')){
            $.ajax({  
                url: "{{ route('category.delete') }}",
                type: 'POST',
                data: { category_id: category_id },
                success: function(res){
                    if(res.status=='success'){
                        $('.category-form-refresh').load(location.href + ' .category-form-refresh');
                        $('.ajax-table').load(location.href + ' .ajax-table');

                        //Category deleted successfully label
                        Command: toastr["error"]("Category Deleted!" +
                        "<div>" +
                            "<button class='btn-undo' data-category-id='" + category_id + "'>" +
                                "Undo" +
                            "</button>" +
                        "</div>");

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                    }
                },
                error: function(err) {
                    console.log("Error deleting category:", err);
                }
            });
        }
    });
        

        //undo delete 
        $(document).on('click', '.btn-undo', function() {
            let category_id = $(this).data('category-id');
            console.log('Undo button clicked');
            console.log('Category ID:', category_id);
            $.ajax({
                url: '/categories/' + category_id + '/undo-delete',
                method: 'POST',
                success: function(res) {
                    if (res.status == 'success') {
                        // Reload the page or refresh the record display
                        $('.ajax-table').load(location.href + ' .ajax-table');
                    } else {
                        console.log('Error: ', res.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error: ', error);
                }
            });
        });





        // live search
        $(document).on('keyup', function(e) {
            let search_bar = $('#search');
            if (e.target === search_bar[0] && search_bar.is(":focus")) { // 13 is the Enter key code
                let search_string = search_bar.val();
                $.ajax({
                    url: "{{ route('category.search') }}",
                    method: 'GET',
                    data: {search_string: search_string},
                    success: function(res){
                        if (res.status == 'nothing_found'){
                            $('.ajax-table').html(
                                '<tbody>'+
                                '<tr>' +
                                    '<td colspan="3">' +
                                        '<div class="alert alert-warning text-center" role="alert">' +
                                            'There is no category like this' +
                                        '</div>' +
                                    '</td>' +
                                '</tr>'+
                                '</tbody>'
                            );
                        }else {
                            $('.ajax-table').html(res.html); // replace the tbody of the table with new HTML
                        }
                    }
                });
        });










    })
</script>
