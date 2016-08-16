<?php

class GalleriesController extends Controller{
    public $layout = 'default';
        
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien
        $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
        $count = Gallery::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Gallery::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
     public function actionView($id=null) {
        checkLogin($this);
        $gallery = Gallery::model()->findByPk($id); 
        $this->render("view", array ('gallery'=>$gallery));
    }
    public function actionAdd(){    
        checkLogin($this);
        $gallery =new Gallery();//sd help trong model
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($gallery);
        if(isset($_POST['Gallery'])){ //pr($_POST); die;            
            $data = $_POST['Gallery'];
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');// pr($help->attributes); die;
            $gallery->attributes = $data;
            if($gallery->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("add",array('gallery'=>$gallery));
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $gallery = Gallery::model()->findByPk($id);  
        $this->performAjaxValidation($gallery);
        if(isset($_POST['Gallery'])){ //pr($_POST); die;
            $data = $_POST['Gallery'];
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $gallery->attributes = $data;
            if($gallery->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }     
        $this->render("edit", array('gallery'=>$gallery));
    }
    public function actionDelete($id=null){
         checkLogin($this);
         Gallery::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $gallery = Gallery::model()->findByPk($id);
        $gallery->status = ($gallery->status==0)?1:0;
        $gallery->save();
        $this->redirect(array('index'));
    }
    
    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='frm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function beforeAction($action) { 
            $checklogin = checkLogin($this);
            if($checklogin==true){
                $user_id=Yii::app()->session['user']['id'];
                $phanquyen = Yii::app()->db->createCommand("select * from phan_quyen where user_id='".$user_id."'")->queryRow();
                if(!empty($phanquyen)){
                    $pq = unserialize($phanquyen['quyen']);
                    $controller = Yii::app()->controller->id;
                    $action = Yii::app()->controller->action->id; //echo $pq[$controller][$action]; die;
                    if(isset($pq[$controller][$action])&&$pq[$controller][$action]==0)
                        $this->redirect(getURL().'site/message/83');
                    else 
                        return TRUE;
                }
                else  return FALSE;
            }
            else  return FALSE;
        }
}
?>
