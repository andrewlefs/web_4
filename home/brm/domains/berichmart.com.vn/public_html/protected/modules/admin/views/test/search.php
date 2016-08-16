<div class="top-main"><p>Tìm kiếm thông minh</p></div><!--.top-main--> 

<div class="middle-main">
<form method="post" id="frm">
    Ten san pham 
    <?php
    $this->widget("CAutoComplete",array(
                    'name'=>'txtName',// set tên và id cho textbox được autocolum
                    'url'=>getURL().'test/getName',//đường dẫn tới action lấy list name
                    'minChars'=>1, // gõ 1 ký tự thì bắt đầu get list name
                    'max'=>10, //hiển thị 10 san pham
                    'delay'=>500, // thời gian chờ lấy list là 500 milisec
                   /* 'methodChain'=>
                    '.result(function(event,item){
                        $("#txtId").val(item[1]);
                    })',*/
//fill name vào trong autocomplete thì sẵn tiện lấy luôn id set vào text box txtId
        )
    );
?>
<?php
   /* $pro = new Product();
    $dataProvider = $pro->search();
    $this->widget("zii.widgets.grid.CGridView",array('dataProvider'=>$dataProvider)); */
   //đơn giàn show cái list user ra màn hình
?>
    <input type="button" id="submit-form" value="tim kiem">
    <div id="result" style="float: left;"></div>
</form>
</div><!--.middle-main-->

<div class="bottom-main"></div><!--.middle-main-->
<script>
    $(function(){
        $('#submit-form').click(function(){
            $.post('<?php echo getURL();?>test/ajaxSearch', {'txtName':$('#txtName').val()}, function(data){
                $('#result').html(data);
            });
        });
    });
</script>