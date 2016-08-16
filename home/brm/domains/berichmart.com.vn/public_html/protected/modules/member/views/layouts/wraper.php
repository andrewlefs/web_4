<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo Yii::app()->controller->module->registerCss('style.css');
//echo Yii::app()->controller->module->registerCss('dock.css');
echo Yii::app()->controller->module->registerCss('jquery.treeview.css');
?>
<!--[if IE]>
<style>.left-cat .category-detail{border:solid 1px #ccc;}</style>
<![endif]-->
<?php echo Yii::app()->controller->module->registerJs('jquery-1.6.js')?>
<?php echo Yii::app()->controller->module->registerJs('common-member-page.js')?>
<script src="<?php echo getURL().'js/tinybox.js';?>"></script>
<script type="text/javascript" src="<?php echo getURL();?>tiny/tiny_mce/tiny_mce.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo getURL().'css/box_tiny.css';?>"></link>
<link rel="stylesheet" href="<?php echo getURL().'tiny/tiny_mce/css/content_1.css';?>"/>
<style>
    .box-right{
        max-height:none !important;
    }
    #frame_upload{
        display: none;
    }
</style>
<!--TreeView-->
<script type="text/javascript">
	function initTrees() {
		$("#black").treeview({
			url: "source.php"
		})

		$("#mixed").treeview({
			url: "source.php",
			// add some additional, dynamic data and request with POST
			ajax: {
				data: {
					"additional": function() {
						return "yeah: " + new Date;
					}
				},
				type: "post"
			}
		});
	}
	$(document).ready(function(){
		initTrees();
		$("#refresh").click(function() {
			$("#black").empty();
			$("#mixed").empty();
			initTrees();
		});
	});
	</script>
<!--TreeView end-->

<title>::BeRichMart::</title>
<?php echo Yii::app()->controller->module->registerJs('jquery.treeview.js')?>
<?php echo Yii::app()->controller->module->registerJs('jquery.treeview.async.js')?>
<!-- header right-->
<?php echo Yii::app()->controller->module->registerJs('interface.js')?>
<?php 
    echo Yii::app()->controller->module->registerCss('skin.css');
    echo Yii::app()->controller->module->registerCss('skin-km.css');
    echo Yii::app()->controller->module->registerCss('skin-slide-logo.css');
?>
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
</head>
<body>
<div id="wrap" class="member-page-size">
  <?php
  $this->renderPartial('/layouts/menutop');
  $this->renderPartial('/layouts/header');
  ?> 
  <?php echo $content;?>
  <?php
  $this->renderPartial('/layouts/footer');
  ?>
</div>
<iframe id ="frame_upload" src="<?php echo getURL();?>admin/upload/popup"></iframe>
   <!--dock menu JS options -->
    <script type="text/javascript">

            $(document).ready(
                    function()
                    {
                            $('#dock2').Fisheye(
                                    {
                                            maxWidth: 44,
                                            items: 'a',
                                            itemsText: 'span',
                                            container: '.dock-container2',
                                            itemWidth: 175,
                                            proximity: 80,
                                            alignment : 'left',
                                            valign: 'bottom',
                                            halign : 'center'
                                    }
                            )
                    }
            );

    </script>
</body>
</html>
