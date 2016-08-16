<?php
class MemberBuyingController extends Controller{
    public $layout = 'default';
    public function actionIndex(){        
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = MemberBuying::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = MemberBuying::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionDelete($id=null){
         checkLogin($this);
         MemberBuying::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionView($id=null) {
        checkLogin($this);
        $donhang = MemberBuying::model()->findByPk($id);
        $this->render('view',array('donhang'=>$donhang));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $obj = MemberBuying::model()->findByPk($id);
        $obj->status = ($obj->status==0)?1:0; 
        $obj->save();
        $this->redirect(array('index'));
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
