<div class="top-main"><p>Chi tiết nhà sản xuất</p></div><!--.top-main-->

<div class="middle-main"> <?php //pr($data['criteria']);?>
        <form id="frm" name="frm" method="post" action="">

                
                <table width="949" border="0" cellspacing="1" cellpadding="0">
                    <tr>
                        <th align="center" valign="top" scope="col" style="width:60px;"> Thuộc tính </th>
                        <th align="center" valign="top" scope="col" style="width:300px;"> Chi tiết</th>
                    </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:50px;"><a href="#">Mã</a></td>
                                <td align="center" valign="top"><?=$producer->id;?></td>
                        </tr>
                        <tr>
                                <td align="center" valign="top" scope="col" style="width:200px;"><a href="#">Tên nhà sản xuất</a></td>
                                <td align="center" valign="top"><?=$producer->name;?></td>
                        </tr>
                         <tr>
                                <td align="center" valign="top" scope="col" style="width:200px;"><a href="#">Tên danh mục</a></td>
                                <td align="center" valign="top"><?=$producer['Category']['name'];?></td>
                        </tr>
                       
                       
                        
                       
                      
                
                </table>				
                          
        </form>

        <div class="cleare-fix"></div>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->