<?php

class AdminController extends Controller{
    public $layout='default';    
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="t.view desc";
        $criteria->condition='status=1 and view > 0';
        $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
        if($count>36)
            $count=36;
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view 
}
    public function actionCompanyInfo() {
        $this->layout='default_system';
        $setting = Setting::model()->findByPk(1);       
        if(isset($_POST['Setting'])){
             $setting->attributes= $_POST['Setting'];
             $setting->save();
        }
        $this->render('company_info',array('setting'=>$setting));        
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
