<?php

class SubjectsController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="position desc";
        $count = Subject::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Subject::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $subject = new Subject(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($subject);
        if(isset($_POST['Subject'])){ //pr($_POST); die;            
            $data = $_POST['Subject'];
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $subject->attributes = $data;      
            if($subject->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("add",array('subject'=>$subject));//...
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $subject = Subject::model()->findByPk($id);
        $this->performAjaxValidation($subject);
        if(isset($_POST['Subject'])){ //pr($_POST); die;
            $data = $_POST['Subject'];
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $subject->attributes = $data;
            if($subject->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("edit", array('subject'=>$subject));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         Subject::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $subject = Subject::model()->findByPk($id);
        $subject->status = ($subject->status==0)?1:0;
        $subject->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $subject = Subject::model()->findByPk($id); 
        $this->render("view", array ('subject'=>$subject));
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
