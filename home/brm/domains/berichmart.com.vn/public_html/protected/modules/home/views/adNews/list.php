 <?php 
        $this->renderPartial('/layouts/box_category_list',array('list'=>$list));
        $this->renderPartial('/adNews/box_list_news',array('adnews'=>$adnews,'pages'=>$pages,'countnews'=>$countnews,'cities'=>$cities));
?>   