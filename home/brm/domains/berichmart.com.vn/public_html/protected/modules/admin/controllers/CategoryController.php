<?php

class CategoryController extends Controller{
    public $layout = 'default';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = Category::model()->count($criteria)-7; // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        //$data = Category::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
         $treecat = Category::model()->generateTree('parent_id is null','------');
         $data = Category::model()->listCats('parent_id is null','------');          
        $this->render("index",array('data'=>$data,'pages'=>$pages,'treecat'=>$treecat)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $cat = new Category(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($cat);
        if(isset($_POST['Category'])){ //pr($_POST); die;            
            $data = $_POST['Category'];
            $data['status']=1;
            $data['alias'] = char($_POST['Category']['name']);
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $cat->attributes = $data;
            //$cat->attributes->['parent_id'] = $_POST['Category']['parent_id'];
            //$cat->attributes['meta_key'] = $_POST['Category']['meta_key'];
            //$cat->attributes['meta_des'] = $_POST['Category']['meta_des'];           
            if($cat->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }        
        $listcat = $cat->generateTree('parent_id is null','------');//để làm danh mục(mag 1chieu)
        $listgroup = GroupProduct::model()->findAll();
        $listgroup = CHtml::listData($listgroup, 'id', 'name'); // danh sach nhóm san pham  
        $this->render("add",array('cat'=>$cat,'listcat'=>$listcat,'listgroup'=>$listgroup));//...
    }
    public function actionEdit($id = null){ 
        checkLogin($this);
        $cat = Category::model()->findByPk($id); 
        $this->performAjaxValidation($cat);
        if(isset($_POST['Category'])){ //pr($_POST); die;
            $data = $_POST['Category'];
            $data['alias'] = char($_POST['Category']['name']);
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $cat->attributes = $data;
            if($cat->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }  
        $listcat = $cat->generateTree('parent_id is null','------');
        $listgroup = GroupProduct::model()->findAll();
        $listgroup = CHtml::listData($listgroup, 'id', 'name'); // danh sach nhóm san pham  
        $this->render("edit", array('cat'=>$cat,'listcat'=>$listcat,'listgroup'=>$listgroup));
    }
    public function actionDelete($id=null){
        checkLogin($this);
        // khong cho xoa mot so danh muc
        $notDeleteCategory = array(407=>407,408=>408,252=>252,257=>257,367=>367,374=>374,377=>377,395=>395,400=>400);
        if(isset($notDeleteCategory[$id]))
            $this->redirect(array('/site/message/76'));
         Category::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $cat = Category::model()->findByPk($id);
        $cat->status = ($cat->status==0)?1:0;
        $cat->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $cat = Category::model()->findByPk($id); 
        $this->render("view", array ('cat'=>$cat));
    }

    
    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='frm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    Public function actionSearch($id=null){
        checkLogin($this);
        $condition='';
        if(!empty($id)){
            $condition .='parent_id='.$id;
        }       
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $criteria->condition = $condition;
        $count = Category::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Category::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $treecat = Category::model()->generateTree('parent_id is null','--');
        $this->render("search",array('data'=>$data,'pages'=>$pages,'treecat'=>$treecat,'cat_id'=>$id)); // gui du lieu ra view
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
