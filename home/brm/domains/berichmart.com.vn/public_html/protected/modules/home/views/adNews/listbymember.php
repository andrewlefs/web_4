<style>
    .list-tinrao{
        padding-top:0px;
    }
</style> 
<?php  
        $this->renderPartial('/adNews/box_list_news',array('adnews'=>$adnews,'pages'=>$pages,'countnews'=>$countnews,'cities'=>$cities));
?>   