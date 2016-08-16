<html>
    <head> 
        <meta charset="utf-8">
        <script src="../js/jquery-1.6.js"></script>
        <style>
            #boxweb{
            width:100%;
            height: 100%;
            }
            #tabs { width: 100%; height: 30px; line-height: 30px;}
            #tabs ul{ width: 100%;}
            #tabs li{float: left; padding: 3px 25px; list-style-type: none; margin-right: 10px; background-color:darkgrey}
            .tab{display: none;}
            .get{display: block;}
            .formtab{ width: 100%; clear: both; padding-top: 20px; padding-left: 20px;}
            input[type='text']{width: 1100px; height: 30px;}
            textArea{ width: 1188px; height: 50px;}
            .result{width: 1188px; height: 600px}
            .active{color: red;}
        </style>
    </head>
    <body>
        <div id="boxweb">
            <div id="tabs">
                <ul>
                    <li class="get"><a class="active" href="#">Lấy dữ liêu</a></li>
                    <li class="add"><a href="#">Thêm</a></li>
                    <li class="edit"><a href="#">Sửa</a></li>
                    <li class="delete"><a href="#">Xóa</a></li>
                </ul>
            </div> 
            <div class="formtab">
                <div class="tab get">
                    <h2>Lay du lieu</h2>
                    <form>
                        <table>
                            <tr>
                                <td>URL : </td>
                                <td><input id="urlget" type="text"></td>
                            </tr>
                            <tr>
                                <td>Xử lý (Get) : </td>
                                <td><input id="submitget" type="button" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="result">
                        <h2>Ket qua : check firebug hoac fiddler xem ket qua json tra ve</h2>
                    </div>
                </div>
                <div class="tab add">
                    <h2>Them</h2>
                    <form>
                        <table>
                            <tr>
                                <td>URL : </td>
                                <td><input id="urladd" type="text"></td>
                            </tr>
                            <tr>
                                <td>Data(json) : </td>
                                <td><textarea id="dataadd"></textarea></td>
                            </tr>
                            <tr>
                                <td>Xử lý (Post) : </td>
                                <td><input id="submitadd" type="button" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="result">
                        <h2>Ket qua : </h2>
                        <textarea class="result" id="resultadd"></textarea>
                    </div>
                </div>
                <div class="tab edit">
                    <h2>Sua</h2>
                    <form>
                        <table>
                            <tr>
                                <td>URL : </td>
                                <td><input id="urledit" type="text"></td>
                            </tr>
                            <tr>
                                <td>Data(json) : </td>
                                <td><textarea id="dataedit"></textarea></td>
                            </tr>
                            <tr>
                                <td>Xử lý (Post) : </td>
                                <td><input id="submitedit" type="button" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="result">
                        <h2>Ket qua : </h2>
                        <textarea class="result" id="resultedit"></textarea>
                    </div>
                </div>
                <div class="tab delete">
                    <h2>Xoa</h2>
                    <form>
                        <table>
                            <tr>
                                <td>URL : </td>
                                <td><input id="urldelete" type="text"></td>
                            </tr>
                            <tr>
                                <td>Xử lý (Get) : </td>
                                <td><input id="submitdelete" type="button" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="result">
                        <h2>Ket qua : </h2>
                        <textarea class="result" id="resultdelete"></textarea>
                    </div>
                </div>                
            </div>
        </div>
        <script>
            $(function(){
                $('#tabs li').click(function(){
                    $('.active').removeClass('active');
                    $(this).find('a').addClass('active');
                    $('.tab').hide();
                    $('.'+$(this).attr('class')).show();
                })
                
            $('#submitget').click(function(){
                    if($('#urlget').val()!='')
                        $.get($('#urlget').val(),{},function(data){
                           // data = $.parseJSON(data); url tra ve json nen khong can ep kieu sang json
                            
                        });
                });
                
                $('#submitadd').click(function(){
                    if($('#urladd').val()!='')
                        $.post('<?php echo 'http://'.$_SERVER['SERVER_NAME'].getURL().'service/test/test';?>',{'url':$('#urladd').val(),'data':$.parseJSON($('#dataadd').val())},function(data){
                           if(data==true)
                               $('#resultadd').val('Them thanh cong');
                           else
                                $('#resultadd').val(''+data); //Them that bai : 
                        });
                });
                
                $('#submitedit').click(function(){
                    if($('#urledit').val()!='')
                        $.post('<?php echo 'http://'.$_SERVER['SERVER_NAME'].getURL().'service/test/test';?>',{'url':$('#urledit').val(),'data':$.parseJSON($('#dataedit').val())},function(data){
                           if(data==true)
                               $('#resultedit').val('Sua thanh cong');
                           else
                                $('#resultedit').val('Sua that bai : '+data);
                        });
                });
                
                $('#submitdelete').click(function(){
                    if($('#urldelete').val()!='')
                        $.get($('#urldelete').val(),{},function(data){
                           if(data==true)
                               $('#resultdelete').val('Xoa thanh cong');
                           else
                                $('#resultdelete').val('Xoa that bai : '+data);
                        });
                });                
            });
        </script>
    </body>
</html>
