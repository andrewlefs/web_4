<div class="top-main">
    <img class="tit1" src="<?php echo getURL().'images/admin/icon-48-category.png';?>">
    <p>Thiết lập điều kiện tính hoa hồng</p>
</div><!--.top-main-->
<div class="middle-main">
    <div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'frm', 'enableAjaxValidation' => true, 'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => true), ));?>
            <table width="949" border="0" cellspacing="1" cellpadding="0">
                <tr>
                    <td colspan="2" align="left" valign="top" style="text-align: left; font-weight: bold; font-size: 14px; color: red;">1. Điều kiện nhận hoa hồng </td>
                    <td colspan="2" align="left" valign="top" style="text-align: left; font-weight: bold;font-size: 14px; color: red;">2. Lệ phí nâng cấp thành viên chính thức </td>
                </tr>
                <tr>
                    <td valign="top">
                        <p><span style="font-weight: bold; line-height: 34px;">Thành viên chính thức : </span></p>
                        <p><span style="font-weight: bold; line-height: 34px;">Thành viên tích cực : </span></p> 
                        <p><span style="font-weight: bold; line-height: 34px;">Thành viên sao : </span></p>                    
                    </td> 
                    <td valign="top">
                        <p><input type="text" name="data[dieukienhoahong][tvct]" value="<?php echo isset($checkbonus['dieukienhoahong']['tvct'])?$checkbonus['dieukienhoahong']['tvct']:'';?>" class='text-input' style="width: 190px;margin-top: 5px; margin-bottom: 5px;"><span> (điểm)</span></p>
                        <p><input type="text" name="data[dieukienhoahong][tvtc]" value="<?php echo isset($checkbonus['dieukienhoahong']['tvtc'])?$checkbonus['dieukienhoahong']['tvtc']:'';?>" class='text-input' style="width: 190px;margin-top: 5px; margin-bottom: 5px;"><span> (điểm)</span></p> 
                        <p><input type="text" name="data[dieukienhoahong][tvsao]" value="<?php echo isset($checkbonus['dieukienhoahong']['tvsao'])?$checkbonus['dieukienhoahong']['tvsao']:'';?>" class='text-input' style="width: 190px;margin-top: 5px; margin-bottom: 5px;"><span> (điểm)</span></p>
                    </td>
                    <td colspan="2" valign="top">                        
                        Số tiền : <input type="text" name="data[update_tvct]" value="<?php echo isset($checkbonus['update_tvct'])?$checkbonus['update_tvct']:'';?>" class='text-input' style="width: 200px;margin-top: 5px; margin-bottom: 5px;"><span> (nghìn VNĐ)</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left" valign="top" style="text-align: left; font-weight: bold; font-size: 14px; color: red;">3. Hoa hồng tiêu dùng </td>
                    <td colspan="2" align="left" valign="top" style="text-align: left; font-weight: bold;font-size: 14px; color: red;">4. Hoa hồng phát triển hệ thống</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="font-weight: bold;">Thành viên kết nối</p>
                        <p>Tiền mặt : <input type="text" name="data[consuming][tvkn]" value="<?php echo isset($checkbonus['consuming']['tvkn'])?$checkbonus['consuming']['tvkn']:'';?>" class='text-input' style="width: 200px;margin-top: 5px;"><span> (%)</span></p>                    
                        <p style="font-weight: bold; margin-top: 5px;">Thành viên chính thức</p>
                        <p>Tiền mặt : <input type="text" name="data[consuming][tvct][money]" value="<?php echo isset($checkbonus['consuming']['tvct']['money'])?$checkbonus['consuming']['tvct']['money']:'';?>" class='text-input' style="width: 200px;margin-top: 5px; margin-bottom: 5px;"><span> (%)</span></p>
                        <p>Tiền thẻ : &nbsp;<input type="text" name="data[consuming][tvct][card]" value="<?php echo isset($checkbonus['consuming']['tvct']['card'])?$checkbonus['consuming']['tvct']['card']:'';?>" class='text-input' style="width: 200px;"><span> (%)</span></p>  
                    </td>
                    <td colspan="2" valign="top">Số tiền : <input type="text" name="data[online]" value="<?php echo isset($checkbonus['online'])?$checkbonus['online']:'';?>" class='text-input' style="width: 200px;"><span> (nghìn VNĐ)</span></td>                    
                </tr>
                <tr>
                    <td colspan="2" align="left" valign="top" style="text-align: left; font-weight: bold; font-size: 14px;color: red;">5. Hoa hồng thụ động </td>
                    <td colspan="2" align="left" valign="top" style="text-align: left; font-weight: bold;font-size: 14px;color: red;">                    
                        6. Hoa hồng hỗ trợ phát triển hệ thống
                    </td>
                </tr>
                <tr>
                    <td style="width:200px;" align="left" valign="top">Thành viên cấp 1 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level1]" value="<?php echo isset($checkbonus['buying']['level1'])?$checkbonus['buying']['level1']:'';?>" id="level1" class='text-input' style="width: 200px;"> <span> (%)</span>                     
                    </td>
                    <td style="width:150px;" align="left" valign="top">Thành viên cấp 1 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level1]" value="<?php echo isset($checkbonus['offline']['level1'])?$checkbonus['offline']['level1']:'';?>" id="level1" class='text-input' style="width: 200px;"> <span> (nghìn VNĐ)</span>                     
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 2 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level2]" value="<?php echo isset($checkbonus['buying']['level2'])?$checkbonus['buying']['level2']:'';?>" id="level2" class='text-input' style="width: 200px;">   <span> (%)</span>                     
                    </td>
                    <td align="left" valign="top">Thành viên cấp 2 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level2]" value="<?php echo isset($checkbonus['offline']['level2'])?$checkbonus['offline']['level2']:'';?>" id="level2" class='text-input' style="width: 200px;">   <span> (nghìn VNĐ)</span>                     
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 3 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level3]" value="<?php echo isset($checkbonus['buying']['level3'])?$checkbonus['buying']['level3']:'';?>" id="level3" class='text-input' style="width: 200px;">  <span> (%)</span>                      
                    </td>
                    <td align="left" valign="top">Thành viên cấp 3 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level3]" value="<?php echo isset($checkbonus['offline']['level3'])?$checkbonus['offline']['level3']:'';?>" id="level3" class='text-input' style="width: 200px;">  <span> (nghìn VNĐ)</span>                      
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 4 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level4]" value="<?php echo isset($checkbonus['buying']['level4'])?$checkbonus['buying']['level4']:'';?>" id="level4" class='text-input' style="width: 200px;">   <span> (%)</span>                     
                    </td>
                    <td align="left" valign="top">Thành viên cấp 4 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level4]" value="<?php echo isset($checkbonus['offline']['level4'])?$checkbonus['offline']['level4']:'';?>" id="level4" class='text-input' style="width: 200px;">   <span> (nghìn VNĐ)</span>                     
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 5 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level5]" value="<?php echo isset($checkbonus['buying']['level5'])?$checkbonus['buying']['level5']:'';?>" id="level5" class='text-input' style="width: 200px;">   <span> (%)</span>                     
                    </td>
                    <td align="left" valign="top">Thành viên cấp 5 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level5]" value="<?php echo isset($checkbonus['offline']['level5'])?$checkbonus['offline']['level5']:'';?>" id="level5" class='text-input' style="width: 200px;">   <span> (nghìn VNĐ)</span>                     
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 6 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level6]" value="<?php echo isset($checkbonus['buying']['level6'])?$checkbonus['buying']['level6']:'';?>" id="level6" class='text-input' style="width: 200px;">  <span> (%)</span>                      
                    </td>
                    <td align="left" valign="top">Thành viên cấp 6 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level6]" value="<?php echo isset($checkbonus['offline']['level6'])?$checkbonus['offline']['level6']:'';?>" id="level6" class='text-input' style="width: 200px;">  <span> (nghìn VNĐ)</span>                      
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 7 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level7]" value="<?php echo isset($checkbonus['buying']['level7'])?$checkbonus['buying']['level7']:'';?>" id="level7" class='text-input' style="width: 200px;">    <span> (%)</span>                    
                    </td>
                    <td align="left" valign="top">Thành viên cấp 7 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level7]" value="<?php echo isset($checkbonus['offline']['level7'])?$checkbonus['offline']['level7']:'';?>" id="level7" class='text-input' style="width: 200px;">    <span> (nghìn VNĐ)</span>                    
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 8 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level8]" value="<?php echo isset($checkbonus['buying']['level8'])?$checkbonus['buying']['level8']:'';?>" id="level8" class='text-input' style="width: 200px;">   <span> (%)</span>                     
                    </td>
                    <td align="left" valign="top">Thành viên cấp 8 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level8]" value="<?php echo isset($checkbonus['offline']['level8'])?$checkbonus['offline']['level8']:'';?>" id="level8" class='text-input' style="width: 200px;">   <span> (nghìn VNĐ)</span>                     
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 9 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level9]" value="<?php echo isset($checkbonus['buying']['level9'])?$checkbonus['buying']['level9']:'';?>" id="level9" class='text-input' style="width: 200px;">  <span> (%)</span>                      
                    </td>
                    <td align="left" valign="top">Thành viên cấp 9 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level9]" value="<?php echo isset($checkbonus['offline']['level9'])?$checkbonus['offline']['level9']:'';?>" id="level9" class='text-input' style="width: 200px;">  <span> (nghìn VNĐ)</span>                      
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 10 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level10]" value="<?php echo isset($checkbonus['buying']['level10'])?$checkbonus['buying']['level10']:'';?>" id="level10" class='text-input' style="width: 200px;"> <span> (%)</span>                       
                    </td>
                    <td align="left" valign="top">Thành viên cấp 10 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level10]" value="<?php echo isset($checkbonus['offline']['level10'])?$checkbonus['offline']['level10']:'';?>" id="level10" class='text-input' style="width: 200px;"> <span> (nghìn VNĐ)</span>                       
                    </td>
                </tr>
                    <td align="left" valign="top">Thành viên cấp 11 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level11]" value="<?php echo isset($checkbonus['buying']['level11'])?$checkbonus['buying']['level11']:'';?>" id="level11" class='text-input' style="width: 200px;"> <span> (%)</span>                       
                    </td>
                    <td align="left" valign="top">Thành viên cấp 11 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level11]" value="<?php echo isset($checkbonus['offline']['level11'])?$checkbonus['offline']['level11']:'';?>" id="level11" class='text-input' style="width: 200px;"> <span> (nghìn VNĐ)</span>                       
                    </td>
                </tr>
                    <td align="left" valign="top">Thành viên cấp 12 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level12]" value="<?php echo isset($checkbonus['buying']['level12'])?$checkbonus['buying']['level12']:'';?>" id="level12" class='text-input' style="width: 200px;"> <span> (%)</span>                       
                    </td>
                    <td align="left" valign="top">Thành viên cấp 12 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level12]" value="<?php echo isset($checkbonus['offline']['level12'])?$checkbonus['offline']['level12']:'';?>" id="level12" class='text-input' style="width: 200px;"> <span> (nghìn VNĐ)</span>                       
                    </td>
                </tr>
                    <td align="left" valign="top">Thành viên cấp 13 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level13]" value="<?php echo isset($checkbonus['buying']['level13'])?$checkbonus['buying']['level13']:'';?>" id="level13" class='text-input' style="width: 200px;"> <span> (%)</span>                       
                    </td>
                    <td align="left" valign="top">Thành viên cấp 13 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level13]" value="<?php echo isset($checkbonus['offline']['level13'])?$checkbonus['offline']['level13']:'';?>" id="level13" class='text-input' style="width: 200px;"> <span> (nghìn VNĐ)</span>                       
                    </td>
                </tr>
                    <td align="left" valign="top">Thành viên cấp 14 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level14]" value="<?php echo isset($checkbonus['buying']['level14'])?$checkbonus['buying']['level14']:'';?>" id="level14" class='text-input' style="width: 200px;"> <span> (%)</span>                       
                    </td>
                    <td align="left" valign="top">Thành viên cấp 14 : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level14]" value="<?php echo isset($checkbonus['offline']['level14'])?$checkbonus['offline']['level14']:'';?>" id="level14" class='text-input' style="width: 200px;"> <span> (nghìn VNĐ)</span>                       
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Số lượng cấp được hưởng khi thêm 1 sao : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][numberlevel]" value="<?php echo isset($checkbonus['buying']['numberlevel'])?$checkbonus['buying']['numberlevel']:'';?>" id="numberlevel" class='text-input' style="width: 200px;">                        
                    </td>
                   <td align="left" valign="top">Thành viên cấp 14+ : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[offline][level15]" value="<?php echo isset($checkbonus['offline']['level15'])?$checkbonus['offline']['level15']:'';?>" id="level15" class='text-input' style="width: 200px;">  <span> (nghìn VNĐ)</span>                      
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top">Thành viên cấp 14+ : </td>
                    <td align="left" valign="top">                    
                        <input type="text" name="data[buying][level15]" value="<?php echo isset($checkbonus['buying']['level15'])?$checkbonus['buying']['level15']:'';?>" id="level15" class='text-input' style="width: 200px;">  <span> (%)</span>                      
                    </td>
                    
                </tr>
                <tr>
                    <td align="left" valign="top">Thao tác</td>
                    <td align="left" valign="top"><label>
                        <?php echo CHtml::submitButton('Thiết lập',array('class'=>'button')); ?>
                    </label></td>
                </tr>
            </table>	

    <?php $this->endWidget(); ?>

    </div><!-- form -->  
    <!-- thong tin ca nhan -->
    <div class="info_member">
        
    </div>
    <!-- end thong tin ca nhan -->
    <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->