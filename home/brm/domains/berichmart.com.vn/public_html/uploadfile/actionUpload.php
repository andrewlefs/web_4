<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-1.3.2.js"></script>
<style>
    body,img{
        margin: 0px;
        padding: 0px;
    }    
    #showimg{
        float: left;
        padding-bottom: 0px;
        margin-bottom: 0px;
        margin-left: 8px;
        margin-top: 8px;
    }
    p{
       margin-top: 10px;
    }
    span{
        display: block;
        float: left;
        padding: 5px;
        background-color: #60BF60;
        margin-right: 10px;
        cursor: pointer;
        font-size: 13px;
        font-family:Arial, Helvetica, sans-serif;
        margin-bottom: 0px;
    }
    span:hover{
        color: red;
        text-decoration: underline;
    }
</style>
<!--[if gte IE 6]>
<style>
    p{
       margin-top: 5px !important;
    }
    #showimg{
        margin-left: 6px !important;
    }
</style>
<![endif]-->
</head>
<body>
<?php
require_once 'resize_img.php';
$uploaddir = 'images/uploads/';
$thumdir = 'images/thums/';
$uploadfile = $uploaddir . $_FILES['userfile']['name'];
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {   
    $thumfile = $thumdir . $_FILES['userfile']['name'];
    copy($uploadfile,$thumfile);
    $image_info = getimagesize($thumfile); 
    $image = new SimpleImage();
    $image->load($thumfile); 
    if($image_info[0]>200){       
        $image->resizeToWidth(200); 
        $image->save($thumfile);
        $image_info = getimagesize($thumfile);
        $image->load($thumfile);
    }    
    if($image_info[1]>200){        
        $image->resizeToHeight(200); 
        $image->save($thumfile);
    } 
   ?> 
    <script>
        $(function(){
            $('#delete').click(function(){
                $.post("deleteFile.php",{'url':"<?php echo $uploadfile;?>",'thum':"<?php echo $thumfile;?>"},function(data){
                    if(data == 'true')
                        $('#showimg').empty();
                });
            });
            
            $('#select').click(function(){
                parent.getImage("<?php echo $uploadfile;?>","<?php echo $thumfile;?>");
            });
        });
    </script>
    <div id="showimg">
        <img src="<?php // echo $uploadfile;?>images/uploads/Desert.jpg" width="284" height="266">
        <p><span id="select">Chọn</span><span id="delete">Xóa</span></p>
    </div>
<?php
} else {
    print "Possible file upload attack!  Here's some debugging info:\n";
    print "<pre>";
    print_r($_FILES);
    print "</pre>"; 
}
?>
</body>
</html>
