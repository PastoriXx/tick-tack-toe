// Setup CSRF-protection for all ajax-requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.game_map-cell').on('click', function() {
    
    let x = $(this).data('x');
    let y = $(this).data('y');

    let board = $(this).closest('.game_map');
    let board_id = board.data('board-id');

    $.ajax({
        type: "POST",
        url: '/steps',
        data: {
            cell: {x: x, y: y}, 
            board_id: board_id
        },
        success: function(data) {

            if (data['redirect']) {
                window.location.replace(data['redirect']);
            }

            if (data['messages']) {
                let alertContainer = $('.js-alert-container');
            
                alertContainer.find('p').html(data['messages']);
                alertContainer.removeClass('hidden');
            } else {
                $('.js-alert-container').addClass('hidden');
            }


            $.each(data['game_map'], function(x, row) {
                $.each(row, function(y, value) {
                    if (value > 0) {
                        value = value == 1 ? 'X' : 'O';
                        board.find('[data-x="' + x + '"][data-y="' + y + '"]').html(value); 
                    }
                });
            });

            console.log(data);            
        },
        error: function(data) {
            console.log(data['error']);
        }
    });
});