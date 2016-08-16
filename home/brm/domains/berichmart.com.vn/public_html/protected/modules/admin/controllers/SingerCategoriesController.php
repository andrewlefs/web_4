<?php

class SingerCategoriesController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = SingerCategory::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = SingerCategory::model()->listCats('parent_id is null','------'); 
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $SingerCategory = new SingerCategory(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($SingerCategory);
        if(isset($_POST['SingerCategory'])){ //pr($_POST); die;            
            $data = $_POST['SingerCategory'];
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $SingerCategory->attributes = $data;      
            if($SingerCategory->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $listcat = SingerCategory::model()->findAll('parent_id is null');
        $listcat = CHtml::listData($listcat, 'id', 'name');
        $this->render("add",array('SingerCategory'=>$SingerCategory,'listcat'=>$listcat));
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $SingerCategory = SingerCategory::model()->findByPk($id);
        $this->performAjaxValidation($SingerCategory);
        if(isset($_POST['SingerCategory'])){ //pr($_POST); die;
            $data = $_POST['SingerCategory'];
            $data['modified']=date('Y-m-d'); //pr($data); die;            
            $SingerCategory->attributes = $data;
            if($SingerCategory->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $listcat = SingerCategory::model()->findAll('parent_id is null');
        $listcat = CHtml::listData($listcat, 'id', 'name');
        $this->render("edit", array('SingerCategory'=>$SingerCategory,'listcat'=>$listcat));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         SingerCategory::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $SingerCategory = SingerCategory::model()->findByPk($id);
        $SingerCategory->status = ($SingerCategory->status==0)?1:0;
        $SingerCategory->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $SingerCategory = SingerCategory::model()->findByPk($id); 
        $this->render("view", array ('SingerCategory'=>$SingerCategory));
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
