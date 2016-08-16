<?php

class ProductOptionsController extends Controller{
    public $layout = 'default';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = ProductOption::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = ProductOption::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $listgroup = GroupProduct::model()->findAll();
        $listgroup = CHtml::listData($listgroup, 'id', 'name');
        $this->render("index",array('data'=>$data,'pages'=>$pages,'listgroup'=>$listgroup)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $field = new ProductOption(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($field);
        if(isset($_POST['ProductOption'])){ //pr($_POST); die;            
            $data = $_POST['ProductOption'];
            if($data['type']=='select')
                $data['value']= serialize(explode('#', $data['value']));
            $field->attributes = $data;      
            if($field->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }        
        $listgroup = GroupProduct::model()->findAll();
        $listgroup = CHtml::listData($listgroup, 'id', 'name');
        $this->render("add",array('field'=>$field,'listgroup'=>$listgroup));//...
    }
    public function actionEdit($id = null){ 
        checkLogin($this);
        $field = ProductOption::model()->findByPk($id); 
        $field->value=  unserialize($field->value);
        if(is_array($field->value))
        $field->value= implode('#', $field->value); 
        $this->performAjaxValidation($field);
        if(isset($_POST['ProductOption'])){ //pr($_POST); die;
            $data = $_POST['ProductOption'];
            $data['value']= serialize(explode('#', $data['value']));
            $field->attributes = $data;
            if($field->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        } 
        $listgroup = GroupProduct::model()->findAll();
        $listgroup = CHtml::listData($listgroup, 'id', 'name');
        $this->render("edit", array('field'=>$field,'listgroup'=>$listgroup));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         ProductOption::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $field = ProductOption::model()->findByPk($id);
        $field->status = ($field->status==0)?1:0;
        $field->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $field = ProductOption::model()->findByPk($id); 
        $this->render("view", array ('field'=>$field));
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
            $condition .='group_product_id='.$id;
        }       
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $criteria->condition = $condition;
        $count = ProductOption::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = ProductOption::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $listgroup = GroupProduct::model()->findAll();
        $listgroup = CHtml::listData($listgroup, 'id', 'name');
        $this->render("search",array('data'=>$data,'pages'=>$pages,'listgroup'=>$listgroup,'field_id'=>$id)); // gui du lieu ra view
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
