<?php

class SingersController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = Singer::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Singer::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $Singer = new Singer(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($Singer);
        if(isset($_POST['Singer'])){ //pr($_POST); die;            
            $data = $_POST['Singer'];
            $data['image']=  getImageURL($data['image']);
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $data['birthday']=date('Y-m-d',  strtotime($data['birthday']));
            $Singer->attributes = $data;      
            if($Singer->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("add",array('singer'=>$Singer));//...
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $Singer = Singer::model()->findByPk($id);
        $this->performAjaxValidation($Singer);
        $Singer->birthday=date('d-m-Y',  strtotime($Singer->birthday));
        if(isset($_POST['Singer'])){ //pr($_POST); die;
            $data = $_POST['Singer'];
            $data['image']=  getImageURL($data['image']);
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $data['birthday']=date('Y-m-d',  strtotime($data['birthday']));
            $Singer->attributes = $data;
            if($Singer->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("edit", array('singer'=>$Singer));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         Singer::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $Singer = Singer::model()->findByPk($id);
        $Singer->status = ($Singer->status==0)?1:0;
        $Singer->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $Singer = Singer::model()->findByPk($id); 
        $this->render("view", array ('Singer'=>$Singer));
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
