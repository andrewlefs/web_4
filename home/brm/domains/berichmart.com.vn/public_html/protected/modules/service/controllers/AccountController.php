<?php
class AccountController extends Controller
{
    public $layout='account';
    public $member;
    
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
        
    public function actionIndex(){
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
        if($member->title==0)
            $this->redirect('account/registerCard');
        else
            $this->redirect('account/infoAccount');
    }
    
    // doi mat khau tai khoan
    public function actionChangePassword(){
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
        $this->performAjaxValidation($member);        
        if(isset($_POST['Member'])){
            $data=$_POST['Member'];
            $data['password'] = addCode($data['newpass'], 3);
            $member->attributes=$data; 
            if($member->save())
                $this->redirect(array('/member/default/rose/'.$member->id));
        }
        $this->render('changepassword',  array('member'=>$member));
    }
    
    //check pass
    public function actionCheckPass(){
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
        $pass = $_POST['pass'];
        if($member->password ==  addCode($pass, 3))
            echo 'yes';
        else
            echo 'no';
    }

    //doi mat khau the
    public function actionChangePasswordCard(){
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
        $this->render('changepasswordcard');
    }
    
    // quen mat khau the
    public function actionForgetPass(){
        $this->render('forget_pass');
    }

    // danh sach tai khoan
    public function actionListAccount() {
        $this->render('list_account');
    }
    
    // thong tin tai khoan
    public function actionInfoAccount(){
        $this->render('info_account');
    }
    
    // chi tiet giao dich
    public function actionDetailTransaction(){
        $this->render('detai_transaction');
    }
    
    //thong tin the
    public function actionInfoCard(){
        $this->render('info_card');
    }
    
    //dang ky dich vu
    public function actionRegisterService(){
        $this->render('register_service');
    }
    
    // thay doi phone
    public function actionChangeMobile(){
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
        $this->render('change_mobile',array('member'=>$member));
    }
    
    // lap lenh chuyen khoan
    public function actionTransfer(){
        $this->render('transfer');
    }
    
    // dang ky the thanh toan dien tu
    public function actionRegisterCard(){
        $this->render('register_card');
    }
    
    // nang cap thanh vien
    public function actionUpdateTVCT()
    {     
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
        $this->render('update_tvct',array('member'=>$member));
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
            return checkLoginMember($this);
        }
}
?>
