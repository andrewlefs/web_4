<?php $this->beginContent('/layouts/wraper_new'); ?>
    	<!-- header -->
    	<div id="ad_header">
        	<div class="ad_topheader1"></div>
        	<div class="ad_topheader2">
            	<ul>
                    <li><a href="<?php echo getURL();?>admin/admin/index">Danh muc</a></li>
                    <li><a href="<?php echo getURL();?>admin/adminMembers/index">Chức năng</a></li>
                    <?php if(Yii::app()->session['user']['data_user']->power==2){?>
                    <li class="menuactive"><a href="<?php echo getURL();?>admin/reportRose/index">Báo cáo</a></li>
                     <?php }?>
                </ul>
                <div class="member-logout">
                    <?php $session = getSession();?>
                    <span>Xin chào : </span> <span style="color: red; margin-right: 5px;"><?=$session['user']['name'] ?></span>|<span><a href="<?php echo getURL();?>admin/login/logout" style="color: blue;"> Thoát</a></span>    
                </div>
            </div>
            <?php $this->renderPartial('/layouts/header_report');?>
        </div>
        <!-- header -->       
        <?php echo $content;?>
<?php $this->endContent(); ?>