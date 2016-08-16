<div id="slide-bar">
				
        <div id="control-user">
            <?php 
           $session = getSession();
           if(isset($session['user']['id'])){ ?>           
            Chào <?=$session['user']['name'] ?> | <a href="<?php echo getURL();?>admin/login/logout" class="">Đăng xuất</a>
           <?php }  ?>
        </div><!--#control-user-->
        <div id="control-title">
            <a href="<?php echo getURL();?>">Trang chủ</a> | <a href="<?php echo getURL();?>admin">Admin</a>
        </div><!--#control-title-->

        <div id="left-menu">
                <ul class="main-menu">
                        <li><a href="#">Quản lý chủ đề</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/subjects/add">Thêm mới chủ đề</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/subjects/index">Danh sách chủ đề</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <li><a href="#">Quản lý nghệ sĩ</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/singers/add">Thêm mới nghệ sĩ</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/singers/index">Danh sách nghệ sĩ</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <li><a href="#">Quản lý thể loại album</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/albumCategories/add">Thêm mới thể loại album</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/albumCategories/index">Danh sách thể loại album</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <li><a href="#">Quản lý thể loại video</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/videoCategories/add">Thêm mới thể loại video</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/videoCategories/index">Danh sách thể loại video</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <li><a href="#">Quản lý thể loại nghệ sĩ</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/singerCategories/add">Thêm mới thể loại nghệ sĩ</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/singerCategories/index">Danh sách thể loại nghệ sĩ</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <li><a href="#">Quản lý album</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/albums/add">Thêm mới album</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/albums/index">Danh sách album</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <li><a href="#">Quản lý video - bài hát</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/videos/add">Thêm mới video/bài hát</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/videos/index">Danh sách video/bài hát</a><div class="cleare-fix"></div></li>    
                                <li><a href="<?php echo getURL();?>admin/videos/search">Tìm kiếm video/bài hát</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <li><a href="#">Quản lý sự kiện</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/events/add">Thêm mới sự kiện</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/events/index">Danh sách sự kiện</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <!--
                        <li><a href="#">Quản lý danh mục</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu category">                                
                                <li><a href="<?php echo getURL();?>admin/category/add">Thêm mới danh mục</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/category/index">Danh sách danh mục</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <li><a href="#">Quản lý tin tức</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu news">
                                <li><a href="<?php echo getURL();?>admin/news/add">Thêm mới tin tức</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/news/index">Danh sách tin tức</a><div class="cleare-fix"></div></li>
                        </ul>	
                        <li><a href="#">Quản lý sản phẩm</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu products productoptions groupproducts donvi" >
                                <li><a href="<?php echo getURL();?>admin/products/createForm">Thêm mới sản phẩm</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/products/index">Danh sách sản phẩm</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/productOptions/add">Thêm trường</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/productOptions/index">Danh sách trường</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/groupProducts/add">Thêm nhóm sản phẩm</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/groupProducts/index">Danh sách nhóm sản phẩm</a><div class="cleare-fix"></div></li> 
                                <li><a href="<?php echo getURL();?>admin/donVi/add">Thêm nhóm đơn vị tính</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/donVi/index">Danh sách đơn vị tính</a><div class="cleare-fix"></div></li>
                        </ul>
                        <li><a href="#">Quản lý tin rao vặt</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu adnews">
                                <li><a href="<?php echo getURL();?>admin/adNews/add">Thêm mới tin rao vặt</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/adNews/index">Danh sách tin rao vặt</a><div class="cleare-fix"></div></li>
                        </ul> 
                        <li><a href="#">Ý kiến khách hàng</a><div class="cleare-fix"></div></li>
                       <ul class="sub-menu comments">
                                <li><a href="<?php echo getURL();?>admin/comments/add">Góp ý kiến</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/comments/index">Danh sách ý kiến</a><div class="cleare-fix"></div></li>
                        </ul>
                        <li><a href="#">Thư viện ảnh</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu galleries">
                                <li><a href="<?php echo getURL();?>admin/Galleries/add">Thêm ảnh mới</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/Galleries/index">Danh sách ảnh</a><div class="cleare-fix"></div></li>
                        </ul>
                         
                        <li><a href="#">Quản lý Banner</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu banners">
                                 <li><a href="<?php echo getURL();?>admin/banners/add">Thêm mới</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/banners/index">Danh sách banner</a><div class="cleare-fix"></div></li>
                        </ul>	
                        <li><a href="#">Trợ giúp</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu helps">
                                <li><a href="<?php echo getURL();?>admin/helps/add">Thêm mới danh sách</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/helps/index">Danh sách hỗ trợ</a><div class="cleare-fix"></div></li>
                        </ul>
                        <?php if(Yii::app()->session['user']['data_user']->power==0){?>
                        <li><a href="#">Quản lý tài khoản</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu users">
                                <li><a href="<?php echo getURL();?>admin/users/add">Thêm tài khoản</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/users/index"">Danh sách tài khoản</a><div class="cleare-fix"></div></li>                                
                        </ul>
                        <?php }?>
                        <li><a href="#">Các chức năng khác</a><div class="cleare-fix"></div></li>
                        <ul class="sub-menu cities producers regulations">
                                <li><a href="<?php echo getURL();?>admin/cities/add">Thêm tỉnh/thành phố</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/cities/index"">Danh sách tỉnh/thành phố</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/Producers/add">Thêm nhà sản xuất</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/Producers/index">Danh sách nhà sản xuất</a><div class="cleare-fix"></div></li>
                                <li><a href="<?php echo getURL();?>admin/regulations/index">Sửa nội dung điều khoản </a><div class="cleare-fix"></div></li>                        
                        </ul>
                        -->
                </ul>

        </div><!--#left-menu-->

</div><!--#slide-bar-->
<script>
$(function(){
    url = '<?PHP echo Yii::app()->request->getUrl() ?>';
    $('#left-menu a[href |= "'+url+'"]').parents('.sub-menu').show();
    $('#left-menu a[href |= "'+url+'"]').css({'color':'#FF00FF'});
    $('#left-menu ul.<?php echo strtolower(Yii::app()->controller->id);?>').show();
})
</script>
				