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
                url: "<?php echo getURL().'member/ajax/getProduct';?>",
                data: dataString,
                cache: false,
                success: function(html)
                {  
                     $(".product").html(html);
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
    /* $(function(){
        $("#PostForm").submit(function(e){  
           e.preventDefault(); 
            $.post("gettag.php", $("#PostForm").serialize(),
            function(data){
               $(".process_result").html(data);
            });    
        });
 
});*/
</script>
<div class="box-right box-common box-common-table nobdr" style="max-height:none;">
    <form action="<?php echo getURL().'member/card/getTag';?>" method="POST" name="PostForm" id="PostForm">		
    <table class="table-member" border="0" cellspacing="0" style="margin-top: 0px;">
        <thead>
        <tr><td colspan="5">Mua thẻ</td></tr>
    </thead>
    <tbody>
        <tr>
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
                            <select name="product" class="product">

                        </select>
                        <label>Số lượng thẻ: </label> <input type="text" value="" name="qty" id="qty">
                        <label>Mật khẩu tài khoản thẻ : </label> <input type="text" value="" name="passcard"><br>
                    <span style="width: 100%; display:block; margin-top: 30px; text-align: center;"> <input type="submit" value="Mua thẻ" /> </span>
                </div>
            </td>

        </tr>

    </tbody>
    </table>  
    </form>
</div>