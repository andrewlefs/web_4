<?php

class AlbumCategoriesController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = AlbumCategory::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = AlbumCategory::model()->listCats('parent_id is null','------'); 
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $AlbumCategory = new AlbumCategory(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($AlbumCategory);
        if(isset($_POST['AlbumCategory'])){ //pr($_POST); die;            
            $data = $_POST['AlbumCategory'];
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $AlbumCategory->attributes = $data;      
            if($AlbumCategory->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $listcat = AlbumCategory::model()->findAll('parent_id is null');
        $listcat = CHtml::listData($listcat, 'id', 'name');
        $this->render("add",array('AlbumCategory'=>$AlbumCategory,'listcat'=>$listcat));
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $AlbumCategory = AlbumCategory::model()->findByPk($id);
        $this->performAjaxValidation($AlbumCategory);
        if(isset($_POST['AlbumCategory'])){ //pr($_POST); die;
            $data = $_POST['AlbumCategory'];
            $data['modified']=date('Y-m-d'); //pr($data); die;            
            $AlbumCategory->attributes = $data;
            if($AlbumCategory->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $listcat = AlbumCategory::model()->findAll('parent_id is null');
        $listcat = CHtml::listData($listcat, 'id', 'name');
        $this->render("edit", array('AlbumCategory'=>$AlbumCategory,'listcat'=>$listcat));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         AlbumCategory::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $AlbumCategory = AlbumCategory::model()->findByPk($id);
        $AlbumCategory->status = ($AlbumCategory->status==0)?1:0;
        $AlbumCategory->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $AlbumCategory = AlbumCategory::model()->findByPk($id); 
        $this->render("view", array ('AlbumCategory'=>$AlbumCategory));
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
