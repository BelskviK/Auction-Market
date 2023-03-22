<!-- Script -->
<script type='text/javascript'>
    $(document).ready(function(){
        //post method CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Opens addLot Modal
        $(document).on('click','.openmodal',function(){
            $('.errMsgContainer').empty(); // Empty the container before appending new messages
            $('#addLotForm')[0].reset();
            $('#addLot').modal('show');
            
        })

        //adds Lot by clicking modal submit button without refreshing page
        $(document).on('click', '.add_lot',function(e){
            e.preventDefault(e);

            let name = $('#name').val();
            let cogs = $('#cogs').val();
            let category = $('#category_select').val();
            let description = $('#description').val();

            $.ajax({
                url: "{{ route('lot.add') }}",
                type: 'POST',
                data:{name:name,cogs:cogs,category:category,description:description,},
                success:function(res){
                    if(res.status=='success'){
                        // Lot added successfully label
                        Command: toastr["success"]("Lot added")
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

                        $('#addLot').modal('hide');
                        $('.modal-backdrop').remove();
                        $('#addLotForm')[0].reset();
                        $('.ajax-table').load(location.href+' .ajax-table');
                        console.log(description);
                    }
                },
                // controler validation 
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

                                
        //show lot types in edit form
        $(document).on('click', '.update_lot_form', function(e) {
            e.preventDefault();
            
            $('#updateLotForm')[0].reset();
            $('#updateLot').modal('show');

            // Get the lot data from the button
            let id = $(this).data('id');
            let name = $(this).data('name');
            let cogs = $(this).data('cogs');
            let category = $(this).data('category');
            let is_active = $(this).data('is_active');
            let description = $(this).data('description');

            // Set the lot data in the form
            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_cogs').val(cogs);
            $('#up_description').val(description);

            // Select the correct category
            $('#category option[value="' + category + '"]').prop('selected', true);
            $('#is_active option[value="' + is_active + '"]').prop('selected', true);
        });


        // updates lot from UpdateLot modal by clicking submit button without refreshing page
        $(document).on('click', '.update_lot', function(e) {
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();
            let up_cogs = $('#up_cogs').val();
            let up_category = $('#category').val();
            let up_description = $('#up_description').val();
            let up_is_active = $('#is_active').val();

            $.ajax({
                url: "{{ route('lot.update') }}",
                type: 'POST',
                data: {
                    up_id: up_id,
                    up_name: up_name,
                    up_cogs: up_cogs,
                    up_category: up_category,
                    up_description: up_description,
                    up_is_active: up_is_active,
                },
                success: function(res) {
                    if (res.status == 'success') {

                        $('#updateLotForm')[0].reset();
                        $('.ajax-table').load(location.href + ' .ajax-table');
                        $('#updateLot').modal('hide');
                        $('.modal-backdrop').remove();
                        $('.lot-form-refresh').load(location.href + ' .lot-form-refresh');
                        //Lot edited successfully label
                        Command: toastr["warning"]("Lot edited")
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
                // controller validator for unique lot name and integer price
                error: function(err) {
                    $('.errMsgContainer').html('');
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    });
                },
            });
        })

        //deletes lot softly with undo button without refreshing page
        $(document).on('click', '.delete_lot',function(e){
            e.preventDefault();
            let lot_id = $(this).data('id');
            // Validation for deleting
            if(confirm('Are U Sure in deleting this Lot ??')){

                $.ajax({  
                    url: "{{ route('lot.delete') }}",
                    type: 'POST',
                    data:{lot_id:lot_id},
                    success:function(res){
                        if(res.status=='success'){
                            $('.ajax-table').load(location.href+' .ajax-table');
                            
                            //Lot deleted successfully label
                            Command: toastr["error"]("Lot Deleted!"+
                            "<div>"+
                                "<button class='btn-undo'>"+
                                    "Undo"+
                                "</button>"+
                            "</div>"

                            )
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
                            //undo delete 
                            $('.btn-undo').click(function() {
                                console.log('Undo button clicked');
                                console.log('Lot ID:', lot_id);
                                $.ajax({
                                    url: '/lots/' + lot_id + '/undo-delete',
                                    method: 'POST',
                                    success: function() {
                                        // Reload the page or refresh the record display
                                        $('.ajax-table').load(location.href+' .ajax-table');
                                    },
                                });
                            });
                        } else {
                            console.log('Error: ', res.message);
                        }
                    },
                });
            }
        })


        // live search
        $(document).on('keyup', function(e) {
            let search_bar = $('#search');
            if (e.target === search_bar[0] && search_bar.is(":focus")) { 
                let search_string = search_bar.val();
                $.ajax({
                    url: "{{ route('lot.search') }}",
                    method: 'GET',
                    data: {search_string: search_string},
                    success: function(res){
                        if (res.status == 'nothing_found'){
                            $('.ajax-table').html(
                                '<tbody>'+
                                '<tr>' +
                                    '<td colspan="3">' +
                                        '<div class="alert alert-warning text-center" role="alert">' +
                                            'No data entered, Please add some' +
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
            }
        });


        //filter categories
        $(document).on('click', '.form-check-input', function() {
            var selectedLots = $('.form-check-input:checked').map(function(){
                return $(this).data('id');
            }).get();

            console.log(selectedLots)

            $.ajax({
                type: "GET",
                url: "{{ route('lot.filter') }}",
                data: {
                    lots: selectedLots
                },
                success: function(response) {
                    $('.ajax-table').html(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
            
            // if no checkboxes are checked, show all lots
            if (selectedLots.length === 0) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('lot.filter') }}",
                    data: {
                        lots: ''
                    },
                    success: function(response) {
                        $('.ajax-table').html(response);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        });

         // search by lot price range
        $(document).on('keyup', '#price_range_from, #price_range_to', function() {
            let search_price_from = $('#price_range_from').val();
            let search_price_to = $('#price_range_to').val();
            let data = {
                search_price_from: search_price_from,
                search_price_to: search_price_to
            };
            $.ajax({
                url: "{{ route('lot.pricerange') }}",
                method: 'GET',
                data: data,
                success: function(res){
                    if (res.status == 'nothing_found'){
                        $('.active-lots').html(
                                '<div class="alert alert-warning text-center" role="alert">' +
                                    'There is no lot like this' +
                                '</div>'
                            );
                    }else {
                        $('.active-lots').html(res.html); // replace the tbody of the table with new HTML
                    }
                }
            });
        });





    })
</script>

