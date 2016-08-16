<div class="top-main"><p>Chi tiết admin</p></div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <th align="center" valign="top" scope="col" style="width:60px;"> Thuộc tính </th>
                        <th align="center" valign="top" scope="col" style="width:300px;"> Chi tiết</th>
                    </tr>
                    
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Mã</a></td>
                                <td align="center" valign="top"><?=$user->id;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Mật khẩu</a></td>
                                <td align="center" valign="top"><?=$user->password;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Tên</a></td>
                                <td align="center" valign="top"><?=$user->name;?></td>
                        </tr>
                       
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">power</a></td>
                                  <td align="center" valign="top"><?=$user->power;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">email</a></td>
                                <td align="center" valign="top"><?=$user->email;?></td>
                        </tr>
                        
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Số đt</a></td>
                                <td align="center" valign="top"><?=$user->phone;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Ngày sinh</a></td>
                                <td align="center" valign="top"><?=$user->birth_date;?></td>
                        </tr>
                        
                          <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Giới tính</a></td>
                                <td align="center" valign="top"><?=$user->sex;?></td>
                        </tr>
                        
                        <tr>
                                <td align="center" valign="top" scope="col"><a href ="#">Ảnh</a></td>
                                <td align="center" valign="top"><img src="<?=  getURL().$user->images;?>" style="width:40px;"></td>
                        </tr>
                       
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày tạo</a></td>
                                 <td align="center" valign="top"><?=$user->created;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày sửa</a></td>
                                 <td align="center" valign="top"><?=$user->modified;?></td>
                        </tr>
                          <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">active_key</a></td>
                                <td align="center" valign="top"><?=$user->active_key;?></td>
                        </tr>
                        
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></td>
                                 <td align="center" valign="top"><?=($user->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></td>
                                
                        </tr>
                      
                
                </table>				
                          
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->