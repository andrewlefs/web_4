<?php $this->beginContent('/layouts/wraper',array('layout'=>'home')); ?>
<div class="main width1000">
    <?php 
        $this->renderPartial('/layouts/sidebar_left');
        ?>
    <div class="rightmain thongtin">
        <div class="ndmain">
            <?php echo $content;?>
        </div><!--e:ndmain-->
    </div><!--e:right-main-->
</div><!--e:main-->
<div class="clean"></div>
<?php $this->endContent(); ?>