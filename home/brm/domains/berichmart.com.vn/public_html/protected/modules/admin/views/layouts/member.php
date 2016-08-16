<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo getURL(); ?>css/admin.style.css" />
<script type="text/javascript" src="<?php echo getURL() ; ?>js/jquery-1.5.2.min.js"></script>
<!--[if IE 6]>
<link href="./css/style.ie6.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="./js/DD_belatedPNG_0.0.8a.js"></script>
<script>DD_belatedPNG.fix('.png_bg');</script>
<![endif]-->
<script type="text/javascript" src="<?php echo getURL(); ?>js/admin.function.js"></script>
<title>ADMIN CONTROL CPANEL</title>
</head>
<body>

	<div id="wrapper">
	
		<div id="header"></div><!-- #header -->
                <div id="main-body">
		
		<?php require_once 'sidebar_member.php';?>
                    <div id="main-content">        
                    <?php echo $content;?>				
                    </div><!--#main-content-->
		</div><!--#main-body-->
	</div><!--#wrapper-->        
     
</body>
</html>
