<?php
Yii::import("application.library.Nested_Set");
class MembersController extends Controller{
    public $layout = "default";
    public $dbParams = array(
                            'localhost'=>'localhost',
                            'user'=>'root',
                            'password'=>'',
                            'table'=>'members',
                            'db'=>'berichmart_yii'
                        );
    
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
        
    // list danh sach thanh vien
    public function actionIndex(){
        checkLogin($this); 
        $model = new Nested_Set(Yii::app()->db);
        $data = $model->listItem(0,'all',0); 
 	$orderArr = $model->orderGroup($data);
        $this->render('index',array('data'=>$data,'orderarr'=>$orderArr,'model'=>$model));
    }    
    
    // nap tien
    public function actionUpdateMoney(){ 
        if(isset($_POST['account'])&& !empty($_POST['account'])&& !empty($_POST['money'])){
            $account = trim($_POST['account']);
            $account = str_replace(' ', '', $account);
            $money= trim($_POST['money']);
            $money=str_replace(',', '', $money);
            $captcha=Yii::app()->controller->createAction("captcha");
            $code = $captcha->verifyCode;
            if($code==trim($_POST['captcha'])){
                 $card = CardAccount::model()->find('numberaccount='.$account);
                 $card->money += $money;
                 if($card->save()){
                     Yii::app()->db->createCommand()->insert('update_money', array('numberaccount'=>$account,'money'=>$money,'status'=>1,'created'=>date('Y-m-d H:i:s')));
                     $this->redirect (getURL ().'site/message/53');
                 }
            }
        }
        $this->render('update_money');
    }
    
    // rut tien
    public function actionGetMoney(){ 
        if(isset($_POST['account'])&& !empty($_POST['account'])&& !empty($_POST['money'])){
            $account = trim($_POST['account']);
            $account = str_replace(' ', '', $account);
            $money= trim($_POST['money']);
            $money=str_replace(',', '', $money);
            $captcha=Yii::app()->controller->createAction("captcha");
            $code = $captcha->verifyCode;
            if($code==trim($_POST['captcha'])){
                 $card = CardAccount::model()->find('numberaccount='.$account);
                 if($card->money>=$money){
                    $card->money -= $money;
                    if($card->save()){
                        Yii::app()->db->createCommand()->insert('update_money', array('numberaccount'=>$account,'money'=>$money,'status'=>0,'created'=>date('Y-m-d H:i:s')));
                        $this->redirect (getURL ().'site/message/54');
                    }
                 } else {
                     $this->redirect (getURL ().'site/message/55');
                 }
            }
        }
        $this->render('get_money');
    }
    public function actionEdit($id=null){
        checkLogin($this);
        $model = new Nested_Set(Yii::app()->db);
        $member = $model->getNodeInfo($id);
        $data = $model->listItem(0,'all');
        if(isset($_POST['Member'])){ //pr($_POST); die;            
            $name = $_POST['Member']['name'];
            $parent = $_POST['Member']['parents'];
            $model->updateNode(array('name'=>$name,'modified'=>date('Y-m-d')),$_POST['Member']['id'], $parent); // mac dinh insert right
            $this->redirect(array('index'));
        }
        $this->render('edit',array('model'=>$member,'data'=>$data));
        
    }
    
    public function actionHistory(){
        checkLogin($this);
        if(isset($_POST['member_id'])){
            $quey = 'member_id = '.$_POST['member_id'];
            if(!empty($_POST['month']))
               $quey .= " and month(created) = ".$_POST['month'];
            if(!empty($_POST['year']))
               $quey .= " and year(created) = ".$_POST['year'];
            if(!empty($_POST['level']))
               $quey .= " and submember_level = ".$_POST['level'];
            $model = new Nested_Set(Yii::app()->db);
            $member = $model->getNodeInfo($_POST['member_id']); 
            $data = MemberBonus::model()->findAll($quey);
            $this->render('history',array('data'=>$data,'member'=>$member));
        }
        else {
            $this->render('history');
        }
    }
    

    // check thanh vien moi hay cu , thanh vien moi la thanh vien co so ngay lam <30 ngay    
    protected function checkNewMember($id){
        $model = new Nested_Set(Yii::app()->db);
        $member = $model->getNodeInfo($id); 
        if($member){
            $created = strtotime($member['created']);
            $current =mktime(0,0,0,date('m'),date('d'),date('Y'));
            $created= mktime(0,0,0,date('m',$created),date('d',$created),date('Y',$created));
            $day = ($current- $created)/(3600*24); 
            if($day <=30)
                return 'new';
            else
                return 'old';
            }
            else  return 'unknown';
    }
     // check ngay cuoi thang
     function _check($m, $y){
        switch($m){
            case 1:case 3:case 5:case 7:case 8:case 10:case 12: 
                return 31;break;
            case 4:case 6:case 9:case 11:case 12:
                return 30;break;
            case 2: return ($y % 4 == 0) ? 29 : 28;break;  
            }
    }
    public function actionDelete($id){
        $model = new Nested_Set(Yii::app()->db);
        //$model->updateNode(array('member_id'=>1), $id, 1);
        $model->removeNode($id,'node');
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
