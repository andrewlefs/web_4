<?php

class LoginController extends Controller{
    public $layout='login';
    
    public function actions()
        {
            return array(
            'captcha'=>array('class'=>'CCaptchaAction',
                            'backColor'=>0xFFFFFF,
                            'foreColor'=>0x000,
                            'height'=>'32',
                            'width'=>'100'
                )
            );
        }
        
    public function actionIndex(){    
        $this->redirect(array('login'));
    }
    
    public function actionlogin(){   // pr($_SESSION); die;    
        if(isset($_POST['username'])){
            $name = $_POST['username'];
            $pass = $_POST['password']; 
            $user = User::model()->find('name=? and password = ?',array($name,md5($pass))) ;
            if(!empty($user)){
                $session = getSession();  
                // yii ko khoi tao duoc $session['user']['id']=, phai tao mang 2 chieu thong qua mang 1 chieu
                $session['user']=array('id'=>$user->id,'name'=>$user->name,'data_user'=>$user);
                $this->redirect(array('admin/index'));
            }
            else { 
                $this->redirect(array('login'));
            }
        
        }
        $this->render('login');
     
    }
    
    public function actionlogin2(){   // pr($_SESSION); die;    
        if(isset($_POST['username'])){
            $name = $_POST['username'];
            $pass = $_POST['password']; 
            $user = User::model()->find('name=? and password = ?',array($name,md5($pass))) ;
            if(!empty($user)){
                $session = getSession();  
                // yii ko khoi tao duoc $session['user']['id']=, phai tao mang 2 chieu thong qua mang 1 chieu
                $session['user']=array('id'=>$user->id,'name'=>$user->name,'data_user'=>$user);
                $this->redirect(array('adminMembers/index'));
            }
            else { 
                $this->redirect(array('login2'));
            }
        
        }
        $this->render('login');
     
    }
    
    public function actionlostPassword(){
        $this->render('lostpassword');
    }
    public function actionLogout(){
        $session = getSession();
        $session->clear();
        unset($session['user']);
        $this->redirect(array('login'));
        $this->render('');
    }
    
    public function actionLogout2(){
        $session = getSession();
        $session->clear();
        unset($session['user']);
        $this->redirect(array('login2'));
        $this->render('');
    }
    
}
?>
