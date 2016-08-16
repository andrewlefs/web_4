<div class="top-main"><p>Chi tiết danh mục</p></div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <th align="center" valign="top" scope="col" style="width:60px;"> Thuộc tính </th>
                        <th align="center" valign="top" scope="col" style="width:300px;"> Chi tiết</th>
                    </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></td>
                                <td align="center" valign="top"><?=$cat->id;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:200px;"><a href="#">Tên danh mục</a></td>
                                <td align="center" valign="top"><?=$cat->name;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Danh mục cha</a></td>
                                    <td align="center" valign="top"><?=$cat['Parent']['name'];?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Loại danh mục </a></td>
                                 <td align="center" valign="top"><?=$cat->type;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Thứ tự SX</a></td>
                                  <td align="center" valign="top"><?=$cat->order;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Từ khóa SEO</a></tdh>
                                  <td align="center" valign="top"><?=$cat->meta_key;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Nội dung tóm tắt SEO</a></td>
                                 <td align="center" valign="top"><?=$cat->meta_des;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày tạo</a></td>
                                 <td align="center" valign="top"><?=$cat->created;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày sửa</a></td>
                                 <td align="center" valign="top"><?=$cat->modified;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></td>
                                 <td align="center" valign="top"><?=($cat->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></td>
                                
                        </tr>
                      
                
                </table>				
                          
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->