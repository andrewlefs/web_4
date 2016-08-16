<?php
class AjaxController extends CController{
    public function actionGetAlbumCategories(){
        $id = $_POST['id']; 
        $list = AlbumCategory::model()->findAll('parent_id="'.$id.'"');
        $album_category = CHtml::listData($list, 'id', 'name'); 
        $model = Yii::app()->session['model'];
        $this->renderPartial('get_album_categories',array('model'=>$model,'album_category'=>$album_category));
    }
    
    public function actionGetVideoCategories(){
        $id = $_POST['id']; 
        $list = VideoCategory::model()->findAll('parent_id="'.$id.'"');
        $videocategory = CHtml::listData($list, 'id', 'name'); 
        $model = Yii::app()->session['model'];
        $this->renderPartial('get_video_categories',array('model'=>$model,'videocategory'=>$videocategory));
    }
    
    public function actionGetSingerCategories(){
        $id = $_POST['id']; 
        $list = VideoCategory::model()->findAll('parent_id="'.$id.'"');
        $singercategory = CHtml::listData($list, 'id', 'name'); 
        $model = Yii::app()->session['model'];
        $this->renderPartial('get_singer_categories',array('model'=>$model,'singercategory'=>$singercategory));
    }
    
    public function actionGetSingerlist(){
        $place = $_POST['place']; 
        $list = Singer::model()->findAll('place="'.$place.'"');
        $singer_list = CHtml::listData($list, 'id', 'name'); 
        $model = Yii::app()->session['model'];
        $this->renderPartial('get_singer_list',array('model'=>$model,'singer_list'=>$singer_list));
    }   
   
}
?>
