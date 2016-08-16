<?php
Yii::import("application.library.Nested_Set");
class MembersController extends Controller
{
    public $layout = 'login';
    public $image;
    public $sale;
    /* public $dbParams = array(
                            'connectionString'=>'localhost',
                            'user'=>'root',
                            'password'=>'',
                            'table'=>'members',
                            'db'=>'berichmart_yii'
                        );*/
    
    public function actions()
        {
            return array(
            'captcha'=>array('class'=>'CCaptchaAction',
                            'backColor'=>0xFFFFFF,
                            'foreColor'=>0x000,
                            'height'=>'50',
                            'width'=>'120'
                )
            );
        }
    
   function actionLogin(){
       if(isset($_POST['m_name'])){
           $session = getSession();
           $name = $_POST['m_name'];
           $pass = $_POST['m_pass'];
           $member =  Member::model()->find('name = ? and password = ?',array($name,  addCode($pass,3)));          
           if($member && $member->status<1)
                $this->redirect(getURL().'site/message/64');
           if(!empty($member)){
               $session['member']= array('id'=>$member->id,'name'=>$name,'pass'=>$pass);               
               $this->redirect(getURL().'site/message/5');// dang nhap thanh cong
           }  
       }
       $this->render('login');
   }
   
   public function actionAutoLogin(){
       $session = getSession();
       if(isset($session['auto'])){
           $name = $session['auto']['m_name'];
           $pass = $session['auto']['m_pass'];
           $member =  Member::model()->find('name = ? and password = ?',array($name,  addCode($pass,3)));           
           if(!empty($member)){
               $session['member']= array('id'=>$member->id,'name'=>$name,'pass'=>$pass);               
               $this->redirect(getURL().'member');// dang nhap thanh cong
           }  
       }
       $this->render('login');
   }
   
   function actionLogout(){
       $session = getSession();
       unset($session['member']);
       $this->redirect(getURL());
   }
   function actionRegister(){ 
       $node = new Nested_Set(Yii::app()->db);   
       $this->layout="register";
       $member= new Member();
       //$captcha=Yii::app()->getController()->createAction("captcha");
      // $code = $captcha->verifyCode;
       $cities = City::model()->findAll("status = 1 order by stt asc");
        $arr_city = CHtml::listData($cities, 'id', 'name');
       $this->performAjaxValidation($member);       
       if(isset($_POST['Member'])){ 
           $checkMember = Member::model()->find('name=?',array($_POST['Member']['name']));
           if(empty($checkMember)){
                $data = $_POST['Member'];
                $data['status']=1;
                $data['password']=  addCode($data['password'], 3);
                $data['fullname'] = strtoupper($data['fullname']);
                $data['created']= date('Y-m-d');
                $data['modified']= date('Y-m-d');
                $data['birthday'] = $_POST['birth_year'].'-'.$_POST['birth_month'].'-'.$_POST['birth_day'];           
                $data['date_create'] = $_POST['year_create'].'-'.$_POST['month_create'].'-'.$_POST['day_create'];           
                $member->attributes=$data; // gan du lieu lan 1
                // truong avatar phai duoc khai bao trong doan comment dau model
                if($_FILES['Member']['error']['avatar']!=4){
                    $file=CUploadedFile::getInstance($member,'avatar'); // lay thong tin file upload trong model va tra ve ten file                                         
                    $member->avatar='uploadfile/avatar/'.$file;
                    $data['avatar']= $member->avatar;
                } //pr($data); die;
                $person = Member::model()->find('name="'.$data['person1'].'"');
                $person_id = $person->id;
                $allow=false;
                $error='';
                if($data['person1']!=$data['person2']){
                    $person2 = Member::model()->find('name="'.$data['person2'].'"');
                    if($person2->lft > $person->lft && $person2->rgt < $person->rgt)
                    {
                        $childsperson2 = Member::model()->findAll('parents='.$person2->id);
                        if(count($childsperson2)<3)
                            $allow=true;
                        else {
                            $allow = false;
                            $error='Nguời giới thiệu 2 đã có đủ 3 nhánh con. Vui lòng nhập lại tên người giới thiệu 2 khác!';
                        }
                        $person_id = $person2->id;
                    }
                    else
                        $error='Nguời giới thiệu 2 không nằm trong nhánh con của người giới thiệu 1. Vui lòng kiểm tra lại tên người giới thiệu 2 !';
                }else{
                    $childs=Member::model()->findAll('parents='.$person_id);
                    if(count($childs)<3)
                        $allow=true;
                    else
                        $error='Nguời giới thiệu 1 đã có đủ 3 nhánh con. Vui lòng nhập lại tên người giới thiệu 2 khác tên người giới thiệu 1!';
                }  
                if($allow==true){
                    // luu database
                    if($node->insertNode($data,$person_id )){ 
                        if($_FILES['Member']['error']['avatar']!=4)
                            $file->saveAs($member->avatar); 
                        $session = getSession();
                        $session['auto'] = array('m_name'=>$data['name'],'m_pass'=> getString($data['password'], 3));
                        $this->redirect(getURL().'site/message/4');// dang ky thanh cong
                    } 
                    /*if($member->save()){
                        if($_FILES['Member']['error']['avatar']!=4)
                            $file->saveAs($member->avatar);
                        $this->redirect(getURL());
                    }*/
                }
                else {
                    //echo '<script> alert("'.$error.'");</script>';
                    $this->render('register',array('member'=>$member,'cities'=>$arr_city,'error'=>$error));
                }
               
           //}
       }} //echo $code.':'.$_REQUEST['security_code']; die;
       $this->render('register',array('member'=>$member,'cities'=>$arr_city));
   }
   
   protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='frm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionCheckmember(){
            $name= $_POST['name'];
            if(!empty($name)){
            $member=Member::model()->find('name="'.$name.'"');
            if($member)
                echo $member->fullname;
            }
        }
        
        public function actionUpperFullName(){
            $members = Member::model()->findAll();
            foreach($members as $member){
                $member->fullname = strtoupper($member->fullname);
                $member->save();
            }
            echo 'thanh cong'; die;
        }


        public function beforeAction($action) {
            $sale=  Help::model()->find('status=1 order by id desc');
            $this->sale=$sale;
            return true;
        }
}