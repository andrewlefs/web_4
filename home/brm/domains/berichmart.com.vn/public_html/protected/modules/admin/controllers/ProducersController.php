<?php

class ProducersController extends Controller{
    public $layout = 'default';
        
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = Producer::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Producer::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
     public function actionView($id=null) {
        checkLogin($this);
        $producer = Producer::model()->findByPk($id); 
        $this->render("view", array ('producer'=>$producer));
    }
    public function actionAdd(){  
        checkLogin($this);
        $producer = new Producer(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($producer);
        if(isset($_POST['Producer'])){ //pr($_POST); die;            
           $data = $_POST['Producer'];
            $producer->attributes = $data;
            //$cat->attributes->['parent_id'] = $_POST['Product']['parent_id'];
            //$cat->attributes['meta_key'] = $_POST['Product']['meta_key'];
            //$cat->attributes['meta_des'] = $_POST['Product']['meta_des'];           
            if($producer->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $listgroup = GroupProduct::model()->findAll();
        $listgroup = CHtml::listData($listgroup, 'id', 'name');
        $this->render("add",array('producer'=>$producer,'listgroup'=>$listgroup));
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $producer = Producer::model()->findByPk($id); 
        $this->performAjaxValidation($producer);
        if(isset($_POST['Producer'])){ //pr($_POST); die;
            $data = $_POST['Producer'];
            
            $producer->attributes = $data;
            if($producer->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }  
       
       $listgroup = GroupProduct::model()->findAll();
        $listgroup = CHtml::listData($listgroup, 'id', 'name');
        $this->render("add",array('producer'=>$producer,'listgroup'=>$listgroup));
    }
    public function actionDelete($id=null){
         checkLogin($this);
         Producer::model()->findByPk($id)->delete();
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
