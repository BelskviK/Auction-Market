<script>
    $(document).ready(function(){
        //post method CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //deletes bids
        $(document).on('click', '.delete_bidLog',function(e){
            e.preventDefault();
            let bid_id = $(this).data('id');
            // Validation for deleting
            if(confirm('Are U Sure in deleting this Lot ??')){

                $.ajax({  
                    url: "{{ route('bid.delete') }}",
                    type: 'POST',
                    data:{bid_id:bid_id},
                    success:function(res){
                        if(res.status=='success'){
                            $('.ajax-table').load(location.href+' .ajax-table');
                            
                            //Bid deleted successfully label
                            Command: toastr["error"]("Lot Deleted!")
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
                            //undo delete bid
                            $('.btn-undo').click(function() {
                                // console.log('Undo button clicked');
                                // console.log('Lot ID:', lot_id);
                                $.ajax({
                                    url: '/lots/' + lot_id + '/undo-delete',
                                    method: 'POST',
                                    success: function() {
                                        // Reload the page or refresh the record display
                                        $('.ajax-table').load(location.href+' .ajax-table');
                                    },
                                });
                            });
                        }
                    },
                });
            }
        })


    })
</script>
