<script>
 $(document).ready(function(){
    //post method CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    //Adds Bid
    $(document).on('click', '.place-bid',function(e){
        e.preventDefault(e);

        let bid = $(this).closest('.card-body').find('.bid-amount').val();
        let name = $(this).closest('.card-body').find('.bidder-name').val();
        let lot_id = $(this).data('id');

        let form = $(this).closest('form');

        
        console.log(name);
        console.log(bid);
        console.log(lot_id);

        $.ajax({
            url: "{{ route('bid.store', ':lot_id') }}".replace(':lot_id', lot_id),

            type: 'POST',
            data:{bid_amount:bid,bidder_name:name,lot:lot_id,},
            success:function(res){
                if(res.status=='success'){

                    form[0].reset();

                    // bid added successfully label
                    Command: toastr["success"]("bid added")
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
        });
    })



    // live search
    $(document).on('keyup', function(e) {
        let search_bar = $('#sidebar-search');
        console.log(e)
        if (e.target === search_bar[0] && search_bar.is(":focus")) {
            let search_string = search_bar.val();
            $.ajax({
                url: "{{ route('market.searchActiveLot') }}",
                method: 'GET',
                data: {
                    search_string: search_string,
                    is_active: 1 // to search only active lots
                },
                success: function(res){
                    if (res.status == 'nothing_found'){
                        $('.active-lots').html(
                            '<div class="alert alert-warning text-center" role="alert">' +
                                'There is no lot on auctiion like this' +
                            '</div>'
                        );
                    }else {
                        $('.active-lots').html(res.html); // replace the .active-lot container of the search
                    }
                }
            });
        }
    });

    //filter categories
    $(document).on('click', '.form-check-input', function() {
        var selectedCategories = $('.form-check-input:checked').map(function(){
            return $(this).data('id');
        }).get();

        console.log(selectedCategories)

        $.ajax({
            type: "GET",
            url: "{{ route('market.filter') }}",
            data: {
                categories: selectedCategories
            },
            success: function(response) {
                $('.active-lots').html(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    // search by lot price range
    $(document).on('keyup', '#price_range_from, #price_range_to', function() {
        let search_price_from = $('#price_range_from').val();
        let search_price_to = $('#price_range_to').val();
        
        if (search_price_from !== '' || search_price_to !== '') {
            let data = {
                search_price_from: search_price_from,
                search_price_to: search_price_to
            };
            $.ajax({
                url: "{{ route('market.priceRange') }}",
                method: 'GET',
                data: data,
                success: function(res){
                    if (res.status == 'nothing_found'){
                        $('.active-lots').html(
                            '<div class="alert alert-warning text-center" role="alert">' +
                                'There is no lot on auctiion like this' +
                            '</div>'
                        );
                    }else {
                        $('.active-lots').html(res.html); // replace the tbody of the table with new HTML
                    }
                }
            });
        }
    });









})
</script>
