<div class="top-main"><p>Chi tiết tin tức</p></div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <th align="center" valign="top" scope="col" style="width:60px;"> Thuộc tính </th>
                        <th align="center" valign="top" scope="col" style="width:300px;"> Chi tiết</th>
                    </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Mã</a></td>
                                <td align="center" valign="top"><?=$news->id;?></td>
                        </tr>
                        
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Mã ng đăng tin</a></td>
                                <td align="center" valign="top"><?=$news->user_id;?></td>
                        </tr>
                        
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Tên sản phẩm</a></td>
                                <td align="center" valign="top"><?=$news->title;?></td>
                        </tr>
                           <tr>
                                <td align="center" valign="top" scope="col"><a href="#">tóm tắt</a></td>
                                  <td align="center" valign="top"><?=$news->introduction;?></td>
                        </tr>
                        
                           <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Nội dung</a></td>
                                  <td align="center" valign="top"><?=$news->content;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col"><a href ="#">Ảnh</a></td>
                                <td align="center" valign="top"><img src="<?=  getURL().$news->image;?>" style="width:40px;"></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Danh mục cha</a></td>
                                  <td align="center" valign="top"><?=$news['Category']['name'];?></td>
                        </tr>
                        
                          <tr>
                                <td align="center" valign="top" scope="col"><a href="#">view</a></td>
                                  <td align="center" valign="top"><?=$news->view;?></td>
                        </tr>
                          <tr>
                                <td align="center" valign="top" scope="col"><a href="#">bí danh</a></td>
                                  <td align="center" valign="top"><?=$news->alias;?></td>
                        </tr>
                          <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Từ khóa SEO</a></td>
                                  <td align="center" valign="top"><?=$news->meta_key;?></td>
                        </tr>
                          <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Nội dung tóm tắt SEO</a></td>
                                  <td align="center" valign="top"><?=$news->meta_des;?></td>
                        </tr>                         
                       
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày tạo</a></td>
                                 <td align="center" valign="top"><?=$news->created;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày sửa</a></td>
                                 <td align="center" valign="top"><?=$news->modified;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></td>
                                 <td align="center" valign="top"><?=($news->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></td>
                                
                        </tr>
                        
                            
                      
                
                </table>				
                          
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->