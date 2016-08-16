<?php

class ProductsController extends Controller{
    public $layout = 'default';
        
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $treecat = Category::model()->generateTree('id=252','------');
        $this->render("index",array('data'=>$data,'pages'=>$pages,'treecat'=>$treecat)); // gui du lieu ra view
    }
     public function actionView($id=null) { 
        checkLogin($this);
        $product = Product::model()->findByPk($id);
        $this->render("view", array ('product'=>$product));
    }
    public function actionAdd(){  
        checkLogin($this);
        $product = new Product();
        $field='';
        if(isset($_GET['cat'])){
            $product->category_id = $_GET['cat'];      
            $product->group_product_id = $_GET['group'];
            $field = ProductOption::model()->findAll('group_product_id = '.$_GET['group']);
            $field = CHtml::listData($field, 'id', 'name'); // danh sach nhóm san pham
        } 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($product);
        if(isset($_POST['Product'])){ //pr($_POST); die;            
            $data = $_POST['Product'];
            $data['alias'] =  char($_POST['Product']['title']);
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $data['bonus']=$data['price_sell'] - $data['price_buy'] - $data['shipping'];
            $phiton = ($data['bog']+$data['km']+$data['hhh'])*$data['bonus']/100;
            $data['bonus'] = ($data['bonus']-$phiton)/1000;
            if(isset($_POST['fields']))
                $data['fields']=  serialize($_POST['fields']);
            $product->attributes = $data;                    
            if($product->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }        
        $listcat = Category::model()->generateTree('id=252','--');
        $listpro = Producer ::model()->findAll('group_product_id = '.$_GET['group']);
        $arrmember = CHtml::listData($listpro,'id','name'); 
        $fieldall = Yii::app()->db->createCommand('select * from  product_options')->queryAll();
        $fieldall = convertArray($fieldall);
        $donvitinh = DonVi::model()->findAll('status=1');        
        $donvitinh = CHtml::listData($donvitinh, 'id', 'name'); 
        $this->render("add",array('product'=>$product,'listcat'=>$listcat,'arrmember'=>$arrmember,'field'=>$field,'fieldall'=>$fieldall,'donvitinh'=>$donvitinh));
        
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $product = Product::model()->findByPk($id);
        if(isset($_GET['cat'])){
            $product->category_id = $_GET['cat']; 
        } 
        $this->performAjaxValidation($product);
        if(isset($_POST['Product'])){ //pr($_POST); die;
            $data = $_POST['Product'];
            $data['alias'] = char($_POST['Product']['title']);
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $data['bonus']=$data['price_sell'] - $data['price_buy'] - $data['shipping'];
            $phiton = ($data['bog']+$data['km']+$data['hhh'])*$data['bonus']/100;
            $data['bonus'] = ($data['bonus']-$phiton)/1000;
            if(isset($_POST['fields']))
                $data['fields']=  serialize($_POST['fields']);
            $product->group_product_id = $_GET['group'];
            $product->attributes = $data;
            if($product->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }  
        $listcat = Category::model()->generateTree('id=252','--');
        $listpro = Producer ::model()->findAll('group_product_id = '.$_GET['group']);
        $arrmember = CHtml::listData($listpro, 'id', 'name');
        if(isset($_GET['group'])&& !empty($_GET['group'])){
            $group = $_GET['group'];
        }
        else
            $group=$product->group_product_id;
        $fieldall = Yii::app()->db->createCommand('select * from  product_options where group_product_id='.$group)->queryAll();
        $fieldall = convertArray($fieldall);
       // $fieldsource=  unserialize($product->fields);
        //$fieldsource = pasteArray($fieldall, $fieldsource);
        $donvitinh = DonVi::model()->findAll('status=1');        
        $donvitinh = CHtml::listData($donvitinh, 'id', 'name'); 
        $this->render("edit", array('product'=>$product,'listcat'=>$listcat,'arrmember'=>$arrmember,'fieldall'=>$fieldall,'donvitinh'=>$donvitinh));
       
    }
    
    public function actionDelete($id=null){
         checkLogin($this);
         Product::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $cat = Product::model()->findByPk($id);
        $cat->status = ($cat->status==0)?1:0;
        $cat->save();
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
       
        public function actionCreateForm(){
            if(isset($_GET['product'])){
                $product= Product::model()->findByPk($_GET['product']);
            }
            else
                $product="";
            if(isset($_POST['category_id'])){
                if(!empty($product))
                    $this->redirect(array('products/edit/'.$_GET['product'].'?cat='.$_POST['category_id'].'&&group='.$_POST['group_product_id']));
                else
                    $this->redirect(array('add?cat='.$_POST['category_id'].'&&group='.$_POST['group_product_id']));
            }
            $listcat = Category::model()->generateTree('id=252','---'); // danh muc san pham 
            $listgroup = GroupProduct::model()->findAll();
            $listgroup = CHtml::listData($listgroup, 'id', 'name'); // danh sach nhóm san pham            
            // pr($listgroup); die;
            $this->render('createform',array('listcat'=>$listcat,'listgroup'=>$listgroup,'product'=>$product));
        } 
        
        //ajax lay nhom san pham
        public function actionGetGroup(){
            $cat = $_POST['cat'];
            $category = Category::model()->findByPk($cat);
            echo $category->group_product_id;
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
            $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=12; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $treecat = Category::model()->generateTree('id=252','------');
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
