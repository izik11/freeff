<?
header("Content-Type: text/html; Charset=utf-8");
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"/></script>


    <script type="text/javascript">

                    function ajax(url,params,div){
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: params,
                            success: function(msg){
                                $('#'+div).html(msg);
                                if(div == 'login_div')
                                    refresh_vip();
                            }
                         });                        
                    }

    
        $(document).ready(function() {
            image = $('<img />').attr('src', 'http://passflyer.cz.cc/load.gif');
            $('[name=url]').focus();
        });

        function post(){
            $('#result').html(image);
            fileflyer_url = $("[name=url]").val();
            params = "url="+fileflyer_url;
            url = "http://passflyer.cz.cc/fileflyer2.class.php";
            div = "result";
            $.ajax({
                type: "POST",
                url: url,
                data: params,
                success: function(msg){
                    $('#'+div).html(msg);
		alert(msg);
                }
             });
        }
    </script>
    <p>הכניסו קישור להורדה מ fileflyer ונפתח לכם אותו עם סיסמא</p>
    <form action="javascript:post();" method="post">
        <label for="url">כתובת</label><br>
        <input name="url" maxlength="100" size="60" type="text"><br><br>

        <input value="פתח קישור" name="submit" type="submit"><br><br>
    </form>
<div id="result" style=""></div>

<!--
<form action="http://passflyer.cz.cc/fileflyer2.class.php" method=post>
<input name="url" maxlength="100" size="60" type="text"><br>
        <input value="פתח קישור" name="submit" type="submit"><br><br>
</form>-->