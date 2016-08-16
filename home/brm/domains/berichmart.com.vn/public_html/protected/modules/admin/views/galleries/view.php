<div class="top-main"><p>Chi tiết thư viện ảnh</p></div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <th align="center" valign="top" scope="col" style="width:60px;"> Thuộc tính </th>
                        <th align="center" valign="top" scope="col" style="width:300px;"> Chi tiết</th>
                    </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></td>
                                <td align="center" valign="top"><?=$gallery->id;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:200px;"><a href="#">Tên thư viện ảnh</a></td>
                                <td align="center" valign="top"><?=$gallery->name;?></td>
                        </tr>
                       
                       
                        
                        <tr>
                                <td align="center" valign="top" scope="col"><a href ="#">Ảnh</a></td>
                                <td align="center" valign="top"><img src="<?=  getURL().$gallery->images;?>" style="width:40px;"></td>
                        </tr>
                       
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày tạo</a></td>
                                 <td align="center" valign="top"><?=$gallery->created;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày sửa</a></td>
                                 <td align="center" valign="top"><?=$gallery->modified;?></td>
                        </tr>
                        
                          <tr>
                                <td align="center" valign="top" scope="col"><a href="#">link</a></td>
                                 <td align="center" valign="top"><?=$gallery->link;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></td>
                                 <td align="center" valign="top"><?=($gallery->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></td>
                                
                        </tr>
                      
                
                </table>				
                          
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->