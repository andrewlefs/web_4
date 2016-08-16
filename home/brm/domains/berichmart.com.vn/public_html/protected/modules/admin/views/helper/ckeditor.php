<?php
    require_once(getURl().'js/ckeditor/ckeditor.php') ; //tao class ckeditor
    require_once (getURl().'js/ckeditor/ckfinder/ckfinder.php') ;
        $ckeditor = new CKEditor( ) ;
        $ckeditor->basePath    = 'getURl().js/ckeditor/' ;
        CKFinder::SetupCKEditor( $ckeditor, 'getURl().js/ckeditor/ckfinder/' ) ; 
        $ckeditor->replace(isset($option['id'])?$option['id']:'ckeditor');
    ?> 
<textarea  <?php foreach($option as $key=>$value){if ($key !='value') echo $key.'="'.$value.'"';}?>>
	<?php echo $option['value'];?>
</textarea>