<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Phân quyền thành viên</p>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
        <div class="nhanvien">
            <?php echo CHtml::listBox('nhanvien', 'id', $usersList,array('empty'=>'--- Chọn nhân viên --','size'=>25));?>            
        </div>
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
            

    <?php $this->endWidget(); ?>

    </div><!-- form -->  
    <!-- thong tin ca nhan -->
    <div class="info_member">
        
    </div>
    <!-- end thong tin ca nhan -->
    <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
<script> 
    $(function(){        
        $('#nhanvien').change(function(){
            $.post('<?php echo getURL().'admin/users/chucNang';?>', {'user_id':this.value}, function(data){
                $('#frm').html(data);
                $('#frm tr:odd > td').addClass('odd');
                $('#frm tr:even > td').addClass('even'); 
                /*var n=$('input[type=checkbox]').length;
                for(i=1;i<=n;i++){
                    $('#pq'+i).click(function(){alert('hello');});
                }*/
                $('#checkall').click(function(){
                    if(this.checked)
                        $('.check').attr('checked','checked');
                    else
                        $('.check').attr('checked','');
                });
                //$('.check').click(function(){});
                
            });
            
        });
    });
</script>