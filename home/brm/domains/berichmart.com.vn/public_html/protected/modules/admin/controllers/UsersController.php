<?php
class UsersController extends Controller{
    public $layout = 'default_system';
    
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien
        $criteria->order="id desc";
        $count = User::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = User::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
     public function actionView($id=null) {
        checkLogin($this);
        $user = User::model()->findByPk($id); 
        $this->render("view", array ('user'=>$user));
    }
    public function actionAdd(){  
        checkLogin($this);
        $user = new User(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($user);
        if(isset($_POST['User'])){ //pr($_POST); die;            
            $data = $_POST['User'];
            $data['status']=1;
            $data['power']= empty($data['power'])?1:$data['power'];
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $data['password']=  md5($data['password']);
            $user->attributes = $data;
            if($user->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
            else { pr($user->errors); die;}
        }
        $this->render("add",array('user'=>$user));
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $user = User::model()->findByPk($id); 
        $this->performAjaxValidation($user); 
        if(isset($_POST['User'])){ //pr($_POST); die;
            $data = $_POST['User']; 
            $data['password']=  md5($data['password']);
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $data['power']= empty($data['power'])?1:$data['power']; 
            $user->attributes = $data;
            if($user->save())// chi luu khi cac truong du lieu khong null deu co gia trị
                $this->redirect(array('index'));            
        } 
        $this->render("edit", array('user'=>$user));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         User::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $user = User::model()->findByPk($id);
        $user->status = ($user->status==0)?1:0;
        $user->save();
        $this->redirect(array('index'));
    }
    
    public function actionPhanQuyen(){
        $users = User::model()->findAll();        
        $usersList = CHtml::listData($users,'id','fullname');
        if(isset($_POST['data'])){ 
            $data=$_POST['data'];
            $data = serialize($data);
            $checkquyen= Yii::app()->db->createCommand('select quyen from phan_quyen where user_id="'.$_POST['user_id'].'"')->queryScalar();
            $checkquyen = unserialize($checkquyen);
            if($checkquyen){
                $result=Yii::app()->db->createCommand()->update('phan_quyen', array('quyen'=>$data, 'modified'=>date('Y-m-d H:i:s')),'user_id="'.$_POST['user_id'].'"');
            }
            else{
                $result=Yii::app()->db->createCommand()->insert('phan_quyen', array('quyen'=>$data,'user_id'=>$_POST['user_id'],'created'=>date('Y-m-d H:i:s')));
            }
            if($result)
                $this->redirect(getURL().'site/message/81');
            else
                $this->redirect(getURL().'site/message/82');
        }
        $this->render('phan_quyen',array('usersList'=>$usersList));
    }
    
    public function actionChucNang(){
        $uer_id = $_POST['user_id'];
        $user =  User::model()->findByPk($uer_id);
        $phanquyen = Yii::app()->db->createCommand("select * from phan_quyen where user_id='".$uer_id."'")->queryRow();
        $this->renderPartial('chuc_nang',array('user'=>$user,'phanquyen'=>$phanquyen));
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
