<?php

class NewsController extends Controller{
    public $layout = 'default';
    
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien
        $criteria->order="id desc";
        $count = News::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = News::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $treecat = Category::model()->generateTree('id=257','------');
        $this->render("index",array('data'=>$data,'pages'=>$pages,'treecat'=>$treecat)); // gui du lieu ra view
    }
     public function actionView($id=null) {
        checkLogin($this);
        $news = News::model()->findByPk($id); 
        $this->render("view", array ('news'=>$news));
    }
    public function actionAdd(){   
        checkLogin($this);
        $news = new News(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($news);
        if(isset($_POST['News'])){ //pr($_POST); die;            
            $data = $_POST['News'];
            $data['status']=1;
            $data['user_id']= Yii::app()->session['user']['id'];
            $data['alias']= char($data['title']);
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $news->attributes = $data;
            if($news->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
       $listcat = Category::model()->generateTree('id=257','-----');
        $this->render("add",array('news'=>$news,'listcat'=>$listcat));
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $news = News::model()->findByPk($id);  
        $this->performAjaxValidation($news);
        if(isset($_POST['News'])){ //pr($_POST); die;
            $data = $_POST['News'];
            $data['user_id']= Yii::app()->session['user']['id'];
            $data['alias']= char($data['title']);
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $news->attributes = $data;
            if($news->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }     
        $listcat = Category::model()->generateTree('id=257','-----');
        $this->render("edit",array('news'=>$news,'listcat'=>$listcat));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         News::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $news = News::model()->findByPk($id);
        $news->status = ($news->status==0)?1:0;
        $news->save();
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
        
        public function actionSearch(){
            checkLogin($this);
            $title = isset($_REQUEST['title'])?$_REQUEST['title']:'';
            $category_id = isset($_REQUEST['category_id'])?$_REQUEST['category_id']:'';
            $cats = Category::model()->getListId($category_id); 
            $condition='';
            if(!empty($title))
                $condition .='title like "%'.trim($title).'%"';
            if(!empty($category_id)){
                $condition .= (!empty ($condition))?' and':'';
                $condition .=' category_id in('.implode(',', $cats).')';
            }
           
            $criteria = new CDbCriteria(); // tao dieu kien 
            $criteria->order="id desc";
            $criteria->condition=$condition;
            $count = News::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=12; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = News::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $treecat = Category::model()->generateTree('id=257','------');
            $this->render("index",array('data'=>$data,'pages'=>$pages,'treecat'=>$treecat)); // gui du lieu ra view
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
