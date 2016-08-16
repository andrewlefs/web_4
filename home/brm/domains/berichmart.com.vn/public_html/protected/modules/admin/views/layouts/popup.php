<div class="tmask" id="" style="height: 680px; width: 1349px; opacity: 0.7; display: block;"></div>
<div class="tbox" style="position: fixed; top: 100px; left: 441px; opacity: 1; display: block;">
    <div class="tinner" id="error" style="background-image: none;">
        <div class="tcontent">
            
        </div>
    <div class="tclose"></div>
    </div>
</div>
<script>    
    function hidepopup(){
        $('.tmask').hide();
        $('.tbox').hide();
    }
    function showpopup(){
        $('.tmask').show();
        $('.tbox').show();
    }
    hidepopup();
    $(function(){
        $('.tclose').click(function(){
            hidepopup();
        })
        $('.tmask').click(function(){
            hidepopup();
        })
    });
</script>