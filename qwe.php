<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<form id="target" action="">
    <input type="text" value="Hello there" name="text">
    <input type="text" value="Hello there" name="text2">
    <input type="submit" value="Go">
</form>
<div id="other">
    Trigger the handler
</div>
<script src="js/jquery-2.2.4.min.js"></script>
<script>
    $( "#target" ).on("submit", function( event ) {
        var sen = $( this ).serialize();
        alert(sen);
        $.ajax({
            url : "http://prolite.zzz.com.ua/qwe.php"
            ,type: "GET"
            ,data: sen
            ,success: function(d){
                alert(d);
            }
        })
    });
</script>
</body>
</html>