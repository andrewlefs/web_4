<html>
    <head>
        <title>Admin</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="<?php echo getURL() ; ?>js/jquery-1.5.2.min.js"></script>
        <style>
            .middle-main{ margin: auto; margin-top: 30px; width: 949px;}
            #frm  table {border-collapse: collapse;}
            #frm td,#frm th { border: 1px solid #ccc; padding: 5px;}
            .yiiPager li {display: inline; border: 1px solid #ccc; padding: 3px;}
            .selected{ background-color:#DE5900;}
        </style>
    </head>
    <body> 
        <div class="middle-main"> <?php //pr($data['criteria']);?>
            <div id="control-user">
            <?php 
           $session = getSession();
           if(isset($session['user']['id'])){ ?>           
            Chào <?=$session['user']['name'] ?> | <a href="<?php echo getURL();?>admin/login/logout" class="">Đăng xuất</a>
           <?php }  ?>
        </div><!--#control-user-->
                <form id="frm" name="frm" method="post" action="">
                    <h3>Danh sách sản phẩm</h3>
                        <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                        <table width="949" border="0" cellspacing="0" cellpadding="0">                            
                                <tr>
                                        <th align="center" valign="top" scope="col" style="width:50px;"><a href="#">STT</a></th>
                                        <th align="left" valign="top" scope="col" style="width:200px;"><a href="#">Tên sản phẩm</a></th>
                                        <th align="left" valign="top" scope="col" style="width:100px;"><a href="#">Mã sản phẩm</a></th>
                                        <th align="left" valign="top" scope="col" style="width:150px;"><a href="#">Số lượng sản phẩm</a></th>
                                        <th align="center" valign="top" scope="col"><a href="#">Chú thích</a></th>
                                        <th align="center" valign="top" scope="col" style="width:80px;"><a href="#">Thao tác</a></th>
                                </tr>
                                <?php $id=0; foreach($data as $pro){
                                    $product=Product::model()->find('code="'.$pro->code.'"');
                                    ?>
                                <tr>
                                        <td align="center" valign="top"><? echo ++$id;?></td>
                                        <td align="left" valign="top"><a href="<?=getURL().'home/products/view/'.$product->id?>"><?=$product->title;?></a></td>
                                        <td align="left" valign="top"><?=$product->code;?></td>
                                        <td align="left" valign="top"><input id="pro_<?php echo $id; ?>" value="<?=$product->quantity;?>"></td>
                                        <td align="left" valign="top"><input id="note_<?php echo $id; ?>" value="" style="width:302px;"></td>
                                        <td align="center" valign="top">                                    
                                            <a title="Sửa mục này" href="#" onclick="window.location='<?=getURL().'admin/products/editSL/'.$product->id?>?sl='+ $('#pro_<?php echo $id; ?>').val()+'&&note='+$('#note_<?php echo $id; ?>').val(); return false;" ><img src="<?php echo getURL().'images/admin/pencil_1.png';?>"></a>                                    
                                        </td>
                                </tr>
                                <?php } ?>
                        </table>				
                        <center><?php $this->widget("CLinkPager",array('pages'=>$pages));?></center>
                </form>

                <div class="cleare-fix"></div>
        </div><!--.middle-main-->
</body>
</html>