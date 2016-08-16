<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Trả lời câu hỏi</p>
    <a href="#" class="edit" onclick="$('#frm').submit(); return false;">
    <span ></span>
    Lưu
    </a>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">    
        <form action="" method="post" id="frm">
            <table width="949" border="0" cellspacing="1" cellpadding="0" id="table-form">
                <tr>
                    <td align="left" valign="top" style="width:150px;">Tiêu đề tin</td>
                    <td align="left" valign="top">
                        <label> 
                            <?php echo $question->title;?>
                        </label>
                    </td>
                </tr> 
                <tr>
                    <td align="left" valign="top" style="width:150px;">Nôi dung hỏi</td>
                    <td align="left" valign="top">
                        <label> 
                            <?php echo $question->content;?>
                        </label>
                    </td>
                </tr>   
                <tr>
                    <td align="left" valign="top" style="width:150px;">Nội dung trả lời</td>
                    <td align="left" valign="top">
                            <?php ckeditor($this,array('name'=>'answer','id'=>'answer','value'=>$question->answer,'style'=>'height:300px; width:770px;')) ?>
                    </td>
                </tr> 
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                        <?php echo CHtml::submitButton('Cập nhật',array('class'=>'button')); ?>
                    </label></td>
                </tr>
            </table> 
        </form>
    </div><!-- form --> 
    <div class="cleare-fix"></div>    
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->