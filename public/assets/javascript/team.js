$(function() {
    $('.yes').click(function (e) {
        let counter = $('#counter').text();
        counter = parseInt(counter);
        if (counter === 6) {
            alert('Votre équipe est déjà complète.');

        } else {
            if ($(this).hasClass('active')) {
                alert('déjà select');
            } else {
                let counter = $('#counter').text();
                counter = parseInt(counter) + 1;
                $('#counter').html(counter);
            }
        }
    });

    $('.no').click(function () {
        if ($(this).hasClass('active')) {
            alert('déjà select');
        } else {
            let counter = $('#counter').text();
            counter = parseInt(counter) - 1;
            $('#counter').html(counter);
        }
    });

    $('#submit').click(function (e) {
        e.preventDefault();
        let counter = $('#counter').text();
        counter = parseInt(counter);
        if (counter < 6) {
            alert('Il te manque des joueurs.');
        } else {
            $('#team').submit();
        }
    });
});