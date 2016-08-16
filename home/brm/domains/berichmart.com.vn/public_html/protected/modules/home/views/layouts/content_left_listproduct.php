<?php
$parent_id = isset($this->cat)?$this->cat->parent_id:252;
$listid = Category::model()->getListId($parent_id);
$count=Yii::app()->db->createCommand('select count(*) as sum from products where category_id in ('.  implode(',', $listid).')')->queryRow();
$listcat = Category::model()->findAll('parent_id = '.$parent_id);
if(isset($this->cat)){
$options= ProductOption::model()->findAll('issearch=1 and group_product_id='.$this->cat->group_product_id);
$producers = Producer::model()->findAll('group_product_id='.$this->cat->group_product_id);
} else{
    $options = $producers=array();
}
?>
<div class="content-left"> 
<div class="filter-products">
    <div class="total-products">Có <span class="red"><?php echo number_format($count['sum']);?></span> sản phẩm</div>
    <div class="sub-cat">
        <?php foreach($listcat as $cat){?>
        <a href="<?php echo getURL().'catl'.'-'.$cat->id.'/'.$cat->alias.'.html';?>">
            <img src="<?php echo Yii::app()->controller->module->registerImage('listudv_arrow_current.gif')?>" alt="<?php echo $cat->name;?>" />
            <?php echo $cat->name;?>
        </a>        
        <?php } ?>
    </div>
    <div class="clear"></div>
    <div class="price-search">
        <form method="post" action="<?php echo getURL().'home/products/search/'.(isset($this->cat)?$this->cat->id:252);?>">
        <table>
                <tr>
                <td colspan="2"><div class="title">Tìm theo khoảng giá (VNĐ)</div></td>
            </tr>
                <tr>
                <td>Từ:</td>
                <td><input type="text" name="m_from" /></td>
            </tr>
            <tr>
                <td>Đến:</td>
                <td><input type="text" name="m_to" /></td>
            </tr>
                <tr>
                <td></td>
                <td><input type="submit" name="" value="Tìm sản phẩm"/></td>
            </tr>
        </table>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".filter-products .readmore").click(function(){
                                        $(this).parent().children(".info .full-info").toggle();
                                        if($(this).parent().children(".info .full-info").is(":visible")){
                                                $(this).text("Rút gọn");
                                                $(this).append('&nbsp<img src="images/icon_sort_up.gif" alt="" />');
                                        }
                                        else{
                                                $(this).text("Xem thêm");
                                                $(this).append('&nbsp<img src="images/icon_arrow_down.gif" alt="" />');
                                                }
                                        return false;
                                        });
        });
    </script>
    <div class="common-search">
        <ul>   
            <?php if(!empty($producers)) { ?>
            <li>
                <div class="title">Hãng sản xuất</div>
                <div class="info">
                    <ul>
                        <?php for($i=0;$i<count($producers)&&$i<=4;$i++){?>
                        <li><a href="<?php echo getURL().'home/products/searchParams'.createQuery('','',array('nsx'=>$producers[$i]->id,'obj'=>$this));?>"><?php echo $producers[$i]->name;?> <span class="orange">(<?php echo Yii::app()->db->createCommand('select count(*) from products where producer_id='.$producers[$i]->id)->queryScalar();?>)</span></a></li>
                        <?php }?>
                    </ul>
                    <?php if(count($producers)>5){?>
                    <ul class="full-info" style="display:none;">
                        <?php for($i=5;$i<count($producers);$i++){?>
                        <li><a href="<?php echo getURL().'home/products/searchParams'.createQuery('','',array('nsx'=>$producers[$i]->id,'obj'=>$this));?>"><?php echo $producers[$i]->name;?> <span class="orange">(<?php echo Yii::app()->db->createCommand('select count(*) from products where producer_id='.$producers[$i]->id)->queryScalar();?>)</span></a></li>
                        <?php }?>
                    </ul>
                    <a href="" class="readmore">Xem thêm&nbsp;<img src="images/icon_arrow_down.gif" alt="" /></a>
                    <?php } ?>
                </div>

            </li>
            <?php } ?>
            <?php foreach($options as $option){ ?>
            <li id="option<?php echo $option->id;?>">
                <div class="title">
                    <?php if($option->type=='checkbox'){
                            echo '<a href="'.getURL().'home/products/searchParams'.createQuery($option->id,'Có',array('obj'=>$this)).'">'.$option->name.'</a>';
                    } else{
                            echo $option->name; 
                    }
                    ?>
                </div>
                <div class="info">
                    <ul>
                        <?php 
                        $values = unserialize($option->value); // pr($values);
                        if($option->type=='select'){                            
                            for($i=0;$i<count($values)&&$i<=4;$i++){ ?>
                                <li id="suboption<?php echo $i;?>"><a href="<?php echo getURL().'home/products/searchParams'.createQuery($option->id,$i,array('obj'=>$this));?>"><?php echo $values[$i];?> <span class="orange">(<?php // echo Yii::app()->db->createCommand('select count(*) from products where producer_id='.$producers[$i]->id)->queryScalar();?>)</span></a></li>
                        <?php   }}?>
                    </ul>
                    <?php if(count($values)>5){?>
                    <ul class="full-info" style="display:none;">
                        <?php    if($option->type=='select'){
                            $values = unserialize($option->value); // pr($values);
                            for($i=5;$i<count($values);$i++){ ?>
                                <li id="suboption<?php echo $i;?>"><a href="<?php echo getURL().'home/products/searchParams'.createQuery($option->id,$i,array('obj'=>$this));?>"><?php echo $values[$i];?> <span class="orange">(<?php // echo Yii::app()->db->createCommand('select count(*) from products where producer_id='.$producers[$i]->id)->queryScalar();?>)</span></a></li>
                        <?php   }} ?>
                    </ul>
                    <a href="" class="readmore">Xem thêm&nbsp;<img src="images/icon_arrow_down.gif" alt="" /></a>
                    <?php } ?>
                </div>

            </li>
            <?php }?>
        </ul>
    </div>
</div><!--Filter Products-->

</div><!--Content Left-->