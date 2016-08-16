<?php

class EventsController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = Event::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Event::model()->findAll($criteria); 
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $Event = new Event();         
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($Event);
        if(isset($_POST['Event'])){ //pr($_POST); die;            
            $data = $_POST['Event'];            
            $data['image']=  getImageURL($data['image']);            
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $Event->attributes = $data;      
            if($Event->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }                
        $this->render("add",array('Event'=>$Event));
    }
    public function actionEdit($id = null){ 
        checkLogin($this);
        $Event = Event::model()->findByPk($id);
        $session = getSession();        
        $this->performAjaxValidation($Event);
        if(isset($_POST['Event'])){ 
            $data = $_POST['Event'];
            $data['image']=  getImageURL($data['image']);            
            $data['modified']=date('Y-m-d'); //pr($data); die;            
            $Event->attributes = $data;
            if($Event->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }        
        $this->render("edit", array('Event'=>$Event));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         Event::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $Event = Event::model()->findByPk($id);
        $Event->status = ($Event->status==0)?1:0;
        $Event->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $Event = Event::model()->findByPk($id); 
        $this->render("view", array ('Event'=>$Event));
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
