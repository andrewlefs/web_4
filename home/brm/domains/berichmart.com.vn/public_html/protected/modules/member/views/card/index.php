<style type="text/css">
    *{margin: 0;padding: 0;}
    #i-warp{width: 100%;margin: auto;padding: 0;}
    #header12{width: 100%;height: 86px;background: #99ccff;}
    #header12 .htitle{padding: 10px 0; font-size: 20px;text-transform: uppercase;box-shadow: 1px 2px 2px -1px;}  
    #content12{border:5px dotted #99ccff;height: 450px;margin-top: 10px;} 
    label{width:200px;text-align:right;}
    .menuHome ul li{ float:left;padding:5px 25px}
    
    
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 <script type="text/javascript">
	function loadprice(){
	   var id= $('.provider').val();
	      if(id==''){
			$('#price').hide()
	      }else{
			$('#price').show()
	      }
            var dataString = 'id='+ id;
            $.ajax
            ({
                type: "POST",
                url: "<?php echo getURL().'member/ajax/getPrice';?>",
                data: dataString,
                cache: false,
                success: function(html)
                {  
                     $(".price").html(html);
                } 
            });
	}
	function autoload(){
	   var id= $('#category').val();
	  
	      if(id==''){
			$('#provider').hide()
            $('#price').hide()       
	      }else{
			$('#provider').show()
	      }
            var dataString = 'id='+ id;
            $.ajax
            ({
                type: "POST",
                url: "<?php echo getURL().'member/ajax/getProvider';?>",
                data: dataString,
                cache: false,
                success: function(html)
                { 
                     $(".provider").html(html);
                } 
            });
	}
    $(document).ready(function()
    {  
		autoload();
				 
        $("#category").change(function()
        {
          autoload();			  	  
        });
		
		$(".provider").change(function()
        {
           loadprice();	 
        });
    });
 </script>
 <script type="text/javascript">
     $(function(){
        $("#PostForm").submit(function(e){  
           e.preventDefault(); 
            $.post("<?php echo getURL().'member/ajax/getProcessForm';?>", $("#PostForm").serialize(),
            function(data){
               $(".process_result").html(data);
            });    
        });
 
});
</script>
<div class="rightmain">
<div class="bang">
    <div class="tenbang b1"><a class="list" href="#"><h3 style="float: left;">Nạp thẻ</h3></a></div>        
    <div id="i-warp">
            <div id="header12">
                <div align="center" class="htitle"><strong>Hệ thống giao dịch</strong></div>
                                    <div class="menuHome">
                    <ul>
                        <li><a href="<?php echo getURL().'member/card/index';?>">Nạp thẻ</a></li>
                        <li><a href="<?php echo getURL().'member/card/download';?>">Tải thẻ</a></li>
                    </ul>
                </div>
            </div> 
            <div id="content12">
                            <form name="PostForm" id="PostForm">		
                                    <table  cellpadding="5" cellspacing="5" style="margin-top: 20px;">
                    <tbody>
                        <tr >
                            <td valign="top" style="padding-bottom:20px;">Chọn dịch loại dịch vụ: </td>
                            <td valign="top">
                                <select id="category" name="category">
                                    <option value="" selected="selected">Chọn danh mục</option>
                                    <?php  

                                            foreach($cats as $r){  
                                                echo '<option value='.$r['id'].'>'.$r['name'].'</option>';
                                            }
                                        ?>
                                    </select>  
                            </td>								
                            <td id="provider" valign="top"> 
                                    Chọn nhà cung cấp: 
                                    <select name="provider" class="provider">

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td id="price" valign="top" colspan="3"> 
                                <div style="height:99px">
                                        <label>Chọn mệnh giá: </label>
                                            <select name="price" class="price">

                                        </select>
                                        <label>Số điện thoại cần nạp thẻ:</label> <input type="text" value="" name="mobile" id="mobile">
                                    <span style="margin-left: 45px;"> <input type="submit" value="Mua thẻ" /> </span>
                                </div>
                            </td>

                        </tr>

                    </tbody>
                    </table>
                    </form>

                    <br/>
                    <div class="process_result"></div>
            </div>               
    </div>
</div><!--e:bang-->
</div>