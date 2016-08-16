<script>
    $(function(){    
      $('#name_p').removeClass('ac_input').addClass('text-search');
      var w_left  = 210;
      $("#nav .search input.text-search").css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);
      $('#name_p').css("width",$(".wrap-content").width() - w_left -10 - $(".button-home").width()-5 - 50 -180-10);    
});
  </script>
<div id="nav">
    <div class="wrap-content">
      <div class="nav-left"></div>
      <div class="nav-center">
        <div class="main-cat">
          <div class="title"><a href="">Tất cả danh mục</a></div>
          <!--Menu Left-->
          <div class="left-cat cat-full" >
            <ul class="lv1">
              <?php $catlist = Category::model()->findAll('parent_id = 252 order by t.order asc');
               foreach($catlist as $cat){
              ?>
              <li class="lv1" ><a  href="<?php echo getURL().'cat'.'-'.$cat->id.'/'.$cat->alias;?>" class="lv1"><?php echo $cat->name;?>
                <div class="arrow-selected"></div>
                </a>
                
                <div class="category-detail" >
                <?php $listcat2 = Category::model()->findAll(array('condition'=>'parent_id = '.$cat->id,'order'=>'t.order asc'));
                    foreach($listcat2 as $list2){?>
                  <div class="menu-item" style="padding-top:0;">
                    <div class="root">
                        <a href="<?php echo getURL().'cat'.'-'.$list2->id.'/'.$list2->alias;?>"><?php echo $list2->name;?></a>
                    </div>
                    <div class="sub">
                        <?php $listcat3 = Category::model()->findAll(array('condition'=>'parent_id = '.$list2->id,'order'=>'t.order asc'));
                        foreach($listcat3 as $list3){?>
                        <a href="<?php echo getURL().'cat'.'-'.$list3->id.'/'.$list3->alias;?>"><?php echo $list3->name;?></a> 
                        <?php }?>
                    </div>
                    <!-- .sub -->
                    <div class="kun-clear-fix"></div>
                    <!-- .kun-clear-fix --> 
                  </div>
                  <?php } ?>
                  <!-- .menu-item -->                 
                  
                </div><!--Category detail-->
              </li>
              <?php } ?>
            </ul>
          </div>
          
          <!--Menu Left End--> 
        </div><!--Main cat-->
        <div class="search">
         <div class="l"></div>
         <form method="post" id="searchname" action="<?php echo getURL().'home/products/searchname/';?>" style="float:left;">           
          <div class="c">
           <!-- <input type="text" name="name_p" class="text-search" /> -->
              
            <?php
                $this->widget("CAutoComplete",array(
                                'name'=>'name_p',// set tên và id cho textbox được autocolum
                                'url'=>getURL().'home/products/getName',//đường dẫn tới action lấy list name
                                'minChars'=>1, // gõ 1 ký tự thì bắt đầu get list name
                                'max'=>10, //hiển thị 10 san pham
                                'delay'=>500, // thời gian chờ lấy list là 500 milisec
                                'inputClass'=>'text-search',
                            /* 'methodChain'=>
                                '.result(function(event,item){
                                    $("#txtId").val(item[1]);
                                })',*/
            //fill name vào trong autocomplete thì sẵn tiện lấy luôn id set vào text box txtId
                    )
                );
            ?>         
            <div class="cat-search">
            	<input type="text" name="" class="search-id" value="Toàn bộ mặt hàng" readonly="readonly"/>
                <input type="text" name="cat_id" class="search-id-hidden" style="display:none;"/>
                <div class="clear"></div>
            	<ul>
                    <li><a href="">Toàn bộ mặt hàng</a></li>
                    <?php 
                    $listcatsearch = Category::model()->findAll('parent_id = 252');
                    foreach($listcatsearch as $cat){
                    ?>
                        <li><a href="<?php echo $cat->id;?>"><?php echo $cat->name;?> </a></li>
                    <?php }?>
                </ul>
            </div>
          </div>
             <div class="r"><a href="" onclick="searchname.submit(); return false;"></a></div>
          </form>
        </div><!--Search-->
        <div class="button-home">
          <div class="button">
            <div class="button-left"></div>
            <a href="<?php echo getURL().'gio-hang';?>" class="cart"><img src="<?php echo Yii::app()->controller->module->registerImage('cart-icon.png');?>" alt="" />
                <span>
                    Giỏ hàng (
                    <?php 
                    $session = getSession();  
                    if(isset($session['shopingcart']))
                        echo count($session['shopingcart']);
                    else
                        echo '0';
                    ?>
                    )
                </span>
            </a>
            <div class="button-right"></div>
          </div>
          <div class="button">
            <div class="button-left"></div>
            <?php if(empty(Yii::app()->session['member'])){?>
            <a href="<?php echo getURL().'dang-ky';?>">Đăng ký</a><span style="background:url(<?php echo Yii::app()->controller->module->registerImage('line-space1.png');?>) right center no-repeat; width:1px; height:25px; display:block; float:left; margin-left:-1px;"></span><a href="<?php echo getURL().'dang-nhap';?>">Đăng nhập</a>
            <?php } else{?>
            <a href ="">Hello : <?php echo Yii::app()->session['member']['name'];?></a><span style="background:url(<?php echo Yii::app()->controller->module->registerImage('line-space1.png');?>) right center no-repeat; width:1px; height:25px; display:block; float:left; margin-left:-1px;"></span><a href="<?php echo getURL().'dang-xuat';?>">Đăng xuất</a>
            <?php }?>
            <div class="button-right"></div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="nav-bottom">
          <div class="location">
              <?php if(!isset($this->cat)){?>
              <a href="<?php echo getURL();?>"><img src="<?php echo Yii::app()->controller->module->registerImage('home-icon.jpg');?>" alt=""  />&nbsp;Trang chủ</a>
              <?php } else{                  
                     $catparentlist = Category::model()->getParentListId($this->cat->id); ?>
               <ul>
                            <li style="margin-right:0px;"> <a href=""><img src="<?php echo Yii::app()->controller->module->registerImage('home-icon.jpg');?>" alt=""  /></a> </li>
                  <?php
                  if(strtolower(Yii::app()->controller->id) != 'adnews'){
                     for($i= count($catparentlist)-1;$i>=0;$i--){
                        $cat = Category::model()->findByPk($catparentlist[$i]);
                        $listcat = Category::model()->findAll('parent_id='.$catparentlist[$i].' order by t.order asc');
                        if(!empty($listcat)){ ?>                     
                            <li class="root"> <a href="<?php echo getURL().'cat'.'-'.$cat->id.'/'.$cat->alias;?>" class="cat-name"><?php echo $cat->name;?>&nbsp;<img src="<?php echo Yii::app()->controller->module->registerImage('icon_arrow_down.gif');?>" alt="" /></a>
                                <div class="sub-category" style="display:none;"> 
                                    <?php  foreach ($listcat as $subcat){?>
                                    <a href="<?php echo getURL().'cat'.'-'.$subcat->id.'/'.$subcat->alias;?>"><?php echo $subcat->name;?></a> 
                                    <?php }?>
                                </div>
                            </li>                        
                     <?php } else {?>
                            <li><a href=""><?php echo $this->cat->name;?></a></li>
                    <?php }}} else {?>
                            <?php
                            for($i= count($catparentlist)-1;$i>=0;$i--){
                            $cat = Category::model()->findByPk($catparentlist[$i]);
                            $listcat = Category::model()->findAll('parent_id='.$catparentlist[$i].' order by t.order asc');
                            if(!empty($listcat)){ ?>                     
                                <li class="root"> <a href="<?php echo getURL().'rao-vat-cat'.'-'.$cat->id.'/'.$cat->alias;?>" class="cat-name"><?php echo $cat->name;?>&nbsp;<img src="<?php echo Yii::app()->controller->module->registerImage('icon_arrow_down.gif');?>" alt="" /></a>
                                    <div class="sub-category" style="display:none;"> 
                                        <?php  foreach ($listcat as $subcat){?>
                                        <a href="<?php echo getURL().'rao-vat-cat'.'-'.$subcat->id.'/'.$subcat->alias;?>"><?php echo $subcat->name;?></a> 
                                        <?php }?>
                                    </div>
                                </li>                        
                        <?php } else {?>
                                <li><a href=""><?php echo $this->cat->name;?></a></li>
                    <?php }}}?>
                </ul>
                <?php } ?>
          </div>
          <div class="total-member">Tổng số thành viên:<span class="red">541655</span></div><span style="background:url(<?php echo Yii::app()->controller->module->registerImage('line-space1.png');?>) 13px 2px no-repeat; width:28px; height:25px; display:block; float:right; margin-left:-1px;"></span><div class="hotline">HOTLINE: <span class="red">0988 454 606</span></div>
        </div>
        <!--nav bottom--> 
      </div>
      <!--nav center-->
      <div class="nav-right"></div>
    </div>
    <!--Wrap-content--> 
  </div>
  <!--Nav--> 