$(document).ready( function() {

    function set_cookie ( name, value, exp_y, exp_m, exp_d, path, domain, secure )
    {
        var cookie_string = name + "=" + escape ( value );

        if ( exp_y )
        {
            var expires = new Date ( exp_y, exp_m, exp_d );
            cookie_string += "; expires=" + expires.toGMTString();
        }

        if ( path )
            cookie_string += "; path=" + escape ( path );

        if ( domain )
            cookie_string += "; domain=" + escape ( domain );

        if ( secure )
            cookie_string += "; secure";

        document.cookie = cookie_string;
    }

    $('form').submit(function(e) {
        var $form = $(this);
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize()
        }).done(function($data) {

            $data = $.parseJSON($data);
            $data.forEach(function($item, $num, $data){
                var name = $item['name']
                    ,value = $item['value']
                    ,exp_y = $item['exp_y']
                    ,exp_m = $item['exp_m']
                    ,exp_d = $item['exp_d']
                    ,path = $item['path']
                    ,domain = $item['domain']
                set_cookie(name, value, exp_y, exp_m, exp_d, path, domain, "");
            });


        }).fail(function() {
            console.log('fail');
        });
        //отмена действия по умолчанию для кнопки submit
        e.preventDefault();
    });

});
