$(function() {
    $('.yes').click(function(e){
        if ($(this).hasClass('active')) {
            alert('actif');
        }
    });
});