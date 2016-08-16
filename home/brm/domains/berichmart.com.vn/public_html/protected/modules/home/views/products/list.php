 <?php 
        $this->renderPartial('/layouts/box_category_list',array('list'=>$list));
        $this->renderPartial('/layouts/slide_logo_list');
        $this->renderPartial('/layouts/box_common_list_products',array('products'=>$products,'pages'=>$pages));
?>   