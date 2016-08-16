<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style>
    *{
        margin: 0px;
        padding: 0px;
    }
    body{
        text-align: center;
    }
    form {
        margin-top: 30px;
        margin-left: auto;
        margin-right: auto;
        width: 420px;
    } 
    iframe{
        display: block;
        height: 320px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 30px;
        width: 300px;
    }
</style>
    <body>
        <script>
            function getImage(url,thum){
                parent.getImage(url,thum);
            }
        </script>
        <form enctype="multipart/form-data" action="<?php echo getURL();?>admin/upload/uploadData" method="post" target="actionupload" >
            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
            Send this file: <input name="userfile" type="file" />
            <input type="submit" value="Send File" />
        </form> 
        <iframe  name ="actionupload"></iframe>
    </body>
</html>