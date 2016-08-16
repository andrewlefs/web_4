<?php

class CommentsController extends Controller{
    public $layout = 'default';
    
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien
        $criteria->order="id desc";
        $count = Comment::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Comment::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
      public function actionView($id=null) {
        checkLogin($this);
        $comment = Comment::model()->findByPk($id); 
        $this->render("view", array ('comment'=>$comment));
    }
    public function actionAdd(){    
        checkLogin($this);
        $comment = new Comment(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($comment);
        if(isset($_POST['Comment'])){ //pr($_POST); die;            
            $data = $_POST['Comment'];
           
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $comment->attributes = $data;
            if($comment->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("add",array('comment'=>$comment));
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $comment = Comment::model()->findByPk($id); 
        $this->performAjaxValidation($comment);
        if(isset($_POST['Comment'])){ //pr($_POST); die;
            $data = $_POST['Comment'];
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $comment->attributes = $data;
            if($comment->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }     
        $this->render("edit", array('comment'=>$comment));
    }
    public function actionDelete($id=null){
         checkLogin($this);
         Comment::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $comment = Comment::model()->findByPk($id);
        $comment->status = ($comment->status==0)?1:0;
        $comment->save();
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
