<?php

class VideoCategoriesController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = VideoCategory::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = VideoCategory::model()->listCats('parent_id is null','------'); 
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $VideoCategory = new VideoCategory(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($VideoCategory);
        if(isset($_POST['VideoCategory'])){ //pr($_POST); die;            
            $data = $_POST['VideoCategory'];
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $VideoCategory->attributes = $data;      
            if($VideoCategory->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $listcat = VideoCategory::model()->findAll('parent_id is null');
        $listcat = CHtml::listData($listcat, 'id', 'name');
        $this->render("add",array('VideoCategory'=>$VideoCategory,'listcat'=>$listcat));
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $VideoCategory = VideoCategory::model()->findByPk($id);
        $this->performAjaxValidation($VideoCategory);
        if(isset($_POST['VideoCategory'])){ //pr($_POST); die;
            $data = $_POST['VideoCategory'];
            $data['modified']=date('Y-m-d'); //pr($data); die;            
            $VideoCategory->attributes = $data;
            if($VideoCategory->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $listcat = VideoCategory::model()->findAll('parent_id is null');
        $listcat = CHtml::listData($listcat, 'id', 'name');
        $this->render("edit", array('VideoCategory'=>$VideoCategory,'listcat'=>$listcat));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         VideoCategory::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $VideoCategory = VideoCategory::model()->findByPk($id);
        $VideoCategory->status = ($VideoCategory->status==0)?1:0;
        $VideoCategory->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $VideoCategory = VideoCategory::model()->findByPk($id); 
        $this->render("view", array ('VideoCategory'=>$VideoCategory));
    }

    
    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='frm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
   
}
?>
