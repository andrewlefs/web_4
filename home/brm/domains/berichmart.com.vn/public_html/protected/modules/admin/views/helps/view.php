<div class="top-main"><p>Chi tiết trợ giúp</p></div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <th align="center" valign="top" scope="col" style="width:60px;"> Thuộc tính </th>
                        <th align="center" valign="top" scope="col" style="width:300px;"> Chi tiết</th>
                    </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">Mã</a></td>
                                <td align="center" valign="top"><?=$help->id;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">email</a></td>
                                <td align="center" valign="top"><?=$help->email;?></td>
                        </tr>
                       
                       <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">yahoo</a></td>
                                <td align="center" valign="top"><?=$help->yahoo;?></td>
                        </tr>
                        
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#"></a>Số điện thoại di động</td>
                                <td align="center" valign="top"><?=$help->hotline;?></td>
                        </tr>
                        
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">skype</a></td>
                                <td align="center" valign="top"><?=$help->skype;?></td>
                        </tr>
                       
                         <tr>
                                <td align="center" valign="top" scope="col" ><a href="#">số đt bàn</a></td>
                                <td align="center" valign="top"><?=$help->sdt;?></td>
                        </tr>
                       
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày tạo</a></td>
                                 <td align="center" valign="top"><?=$help->created;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col"><a href="#">Ngày sửa</a></td>
                                 <td align="center" valign="top"><?=$help->modified;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:100px;"><a href="#">Trạng thái</a></td>
                                 <td align="center" valign="top"><?=($help->status==0)?'Chưa kích hoạt':'Đã kích hoạt';?></td>
                                
                        </tr>
                      
                
                </table>				
                          
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->