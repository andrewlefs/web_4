<div class="top-main"><p>Chi tiết ý kiến khách hành</p></div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <th align="center" valign="top" scope="col" style="width:60px;"> Thuộc tính </th>
                        <th align="center" valign="top" scope="col" style="width:300px;"> Chi tiết</th>
                    </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></td>
                                <td align="center" valign="top"><?=$comment->id;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:200px;"><a href="#">Tên</a></td>
                                <td align="center" valign="top"><?=$comment->name;?></td>
                        </tr>
                       
                        <tr>
                                <td align="center" valign="top" scope="col"><a href="#">nội dung</a></td>
                                  <td align="center" valign="top"><?=$comment->content;?></td>
                        </tr>
                        
                       <tr>
                                <td align="center" valign="top" scope="col"><a href="#">email</a></td>
                                  <td align="center" valign="top"><?=$comment->email;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Mã thư mục sp</a></td>
                                  <td align="center" valign="top"><?=$comment->product_id;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Mã thư mục tin tức</a></td>
                                  <td align="center" valign="top"><?=$comment->new_id;?></td>
                        </tr>
                       
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày tạo</a></td>
                                 <td align="center" valign="top"><?=$comment->created;?></td>
                        </tr>
                        
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></td>
                                 <td align="center" valign="top"><?=($comment->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></td>
                                
                        </tr>
                      
                
                </table>				
                          
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->