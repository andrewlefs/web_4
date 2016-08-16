<?php $this->beginContent('/layouts/wraper_new'); ?>
    	<!-- header -->
    	<div id="ad_header">
        	<div class="ad_topheader1"></div>
        	<div class="ad_topheader2">
            	<ul>
                    <li><a href="<?php echo getURL();?>admin/users/index">Hệ thống</a></li>
                    <li><a href="<?php echo getURL();?>admin/admin/index">Danh muc</a></li>
                    <li class="menuactive"><a href="<?php echo getURL();?>admin/adminMembers/index">Chức năng</a></li>                    
                    <li><a href="<?php echo getURL();?>admin/reportRose/index">Báo cáo</a></li>
                </ul>
                <div class="member-logout">
                    <?php $session = getSession();?>
                    <span>Xin chào : </span> <span style="color: red; margin-right: 5px;"><?=$session['user']['name'] ?></span>|<span><a href="<?php echo getURL();?>admin/login/logout" style="color: blue;"> Thoát</a></span>    
                </div>
            </div>
            <?php $this->renderPartial('/layouts/header_account');?>
        </div>
        <!-- header -->
        <!-- main content -->
        <div id="ad_maincontent">
            <?php echo $content;?>
        </div>
        <!-- end main content -->
<?php $this->endContent(); ?>
