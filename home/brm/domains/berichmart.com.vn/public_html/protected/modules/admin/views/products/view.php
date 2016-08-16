<div class="top-main"><p>Chi tiết sản phẩm</p></div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <th align="center" valign="top" scope="col" style="width:60px;"> Thuộc tính </th>
                        <th align="center" valign="top" scope="col" style="width:300px;"> Chi tiết</th>
                    </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Mã</a></td>
                                <td align="center" valign="top"><?=$product->id;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Tên sản phẩm</a></td>
                                <td align="center" valign="top"><?=$product->title;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#"> danh mục </a></td>
                                <td align="center" valign="top"><?=$product['Category']['name'];?></td>
                        </tr>
                       
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#"> Nhà sản xuất </a></td>
                                <td align="center" valign="top"><?=$product['Producer']['name'];?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Mã sp</a></td>
                                <td align="center" valign="top"><?=$product->code;?></td>
                        </tr>
                       
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Giá</a></td>
                                  <td align="center" valign="top"><?=$product->price_sell;?></td>
                        </tr>
                        
                        <tr>
                                <td align="center" valign="top" scope="col"><a href ="#">Ảnh</a></td>
                                <td align="center" valign="top"><img src="<?=  getURL().$product->image;?>" style="width:40px;"></td>
                        </tr>
                          <tr>
                                <td align="center" valign="top" scope="col"><a href="#">bí danh</a></td>
                                  <td align="center" valign="top"><?=$product->alias;?></td>
                        </tr>
                           <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Từ khóa SEO</a></td>
                                  <td align="center" valign="top"><?=$product->meta_key;?></td>
                        </tr>
                          <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Nội dung tóm tắt SEO</a></td>
                                  <td align="center" valign="top"><?=$product->meta_des;?></td>
                        </tr>
                       
                           <tr>
                                <td align="center" valign="top" scope="col"><a href="#">tóm tắt </a></td>
                                  <td align="center" valign="top"><?=$product->introduction;?></td>
                        </tr>
                       
                           <tr>
                                <td align="center" valign="top" scope="col"><a href="#"> Nội dung </a></td>
                                  <td align="center" valign="top"><?=$product->content;?></td>
                        </tr>
                       
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày tạo</a></td>
                                 <td align="center" valign="top"><?=$product->created;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày sửa</a></td>
                                 <td align="center" valign="top"><?=$product->modified;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></td>
                                 <td align="center" valign="top"><?=($product->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></td>
                                
                        </tr>
                      
                
                </table>				
                          
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->