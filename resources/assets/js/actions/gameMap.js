// Setup CSRF-protection for all ajax-requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.game_map-cell').on('click', function() {
    
    let cell = $(this).data('key');
    let board_id = $(this).closest('.game_map').data('board-id');

    console.log(cell);
    console.log(board_id);

    $.ajax({
        type: "POST",
        url: '/steps',
        data: {cell: cell, board_id: board_id},
        success: function(data) {
            // $(this).html(data);

            console.log(data);
            
        },
        error: function(data) {
            console.log(data);
        }
    });


});