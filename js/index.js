$(document).ready( function() {

    //$("button.button").on("click", function(){
    //    $(this).next().slideToggle(100);
    //});

    $(" form button ").on('click', function(){
        var data = $(this).parents('form').serialize();
        $.post(
            "login.php",
            data,
            onAjaxSuccess
        );
        function onAjaxSuccess(data){
            $.evalJSON(data);
            if( data['authed'] == true ){
                alert(data);
            }else {
                alert("Введены не правильные данные");
            }
        }
    });


});