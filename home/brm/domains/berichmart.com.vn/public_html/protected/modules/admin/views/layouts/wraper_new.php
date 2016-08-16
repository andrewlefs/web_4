<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo getURL(); ?>css/style_new_admin.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo getURL(); ?>css/admin.style.css" />
<script type="text/javascript" src="<?php echo getURL() ; ?>js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="<?php echo  getURL(); ?>js/jquery.validate.js"></script>
<script src="<?php echo getURL().'js/tinybox.js';?>"></script>
<script type="text/javascript" src="<?php echo getURL();?>tiny/tiny_mce/tiny_mce.js"></script>
<!--[if IE 6]>
<link href="./css/style.ie6.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./js/DD_belatedPNG_0.0.8a.js"></script>
<script>DD_belatedPNG.fix('.png_bg');</script>
<![endif]-->
<script type="text/javascript" src="<?php echo getURL(); ?>js/admin.function.js"></script>
<title>ADMIN CONTROL CPANEL</title>
<script>
    var userFileId='';
    function closeIframe(){
        $('#frame_upload').hide();
    }
    function showIframe(id){
        $('#frame_upload').attr('src',$('#frame_upload').attr('src'));
        $('#frame_upload').show(); 
        userFileId = id;
    }
    function getImageFromIrame(urlImage,thumImage){
        $('#'+userFileId).val(urlImage);
    }
</script>
<script>
$(function(){
    var maxheight=0;
    $('.ad_main_box ul li').each(function(){
        if($(this).height()>maxheight)
            maxheight = $(this).height();
    });
    $('.ad_main_box ul li').height(maxheight);
});
</script>
</head>

<body>
    <div id="ad_wraper">
    	<?php echo $content;?>
    </div>
    <iframe id ="frame_upload" src="<?php echo getURL();?>admin/upload/popup"></iframe>
</body>
</html>
