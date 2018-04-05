$(function() {
    $("#good").click(function(e){
        e.preventDefault();
        $('#alignment').attr('value', 'good');
        $('#player').submit();
    });

    $("#bad").click(function(e){
        e.preventDefault();
        $('#alignment').attr('value', 'bad');
        $('#player').submit();
    });
});