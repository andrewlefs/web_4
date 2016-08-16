<?php
Yii::import("application.library.Nested_Set");
class AdminMembersController extends Controller{
    public $layout = "default_account";    
    
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
        $this->render('index');
    }   
    
    // cap lai mat khau dang nhap
    public function actionCreatePassword(){
        if(isset($_POST['data'])){
            $data=$_POST['data'];
            $data['name'] = trim($data['name']);
            $data['name'] = str_replace(' ','',$data['name']);
            $member = Member::model()->find('name='.$data['name']);
            if($data['password']==$data['re_password'] && Yii::app()->db->createCommand()->update('members', array('password'=>  addCode($data['password'],3)), 'name='.$data['name'])){
                sendMail($member->email, 'phong@gmail.com', 'Cấp lại mật khẩu đăng nhập','Mật khẩu đăng nhập mới của quý khách là : '.  $data['password']);
                $this->redirect(getURL().'site/message/14');
            }
        }
        $this->render('create_password');
    }
    
    // phong toa 1 phan so du
    public function actionBlockadeAPartOfMoney(){
        $this->render('blockade_apart_of_money');
    }
    
    // phong toa toan bo so du
    public function actionBlockadeAllMoney(){
        if(isset($_POST['data'])){
            $data=$_POST['data'];
           // pr($data); die;
            $data['numberaccount'] = trim($data['numberaccount']);
            $data['numberaccount'] = str_replace(' ', '', $data['numberaccount']);
            $member = Member::model()->find('cmnd="'.$data['cmnd'].'"');
            if($member && $member->CardAccount['numberaccount']==$data['numberaccount']){
                $status =(isset($data['blockedmoney']))? 1:0;
                $index = ($status>0)?15:16;
                if(Yii::app()->db->createCommand()->update('card_accounts', array('blockade'=>$status), 'numberaccount='.$data['numberaccount'])&&Yii::app()->db->createCommand()->insert('blockedmoney', array('numberaccount'=>$data['numberaccount'],'status'=>$status,'information'=>$data['information'],'created'=>  date('Y-m-d H:i:s'))))
                        $this->redirect (getURL().'site/message/'.$index);
                else 
                        $this->redirect (getURL().'site/message/57');
            }
            else 
                        $this->redirect (getURL().'site/message/56');
            
        }
        $this->render('blockade_all_money');
    }
    
    // dong tài khoan
    public function actionBlockAccount(){
        if(isset($_POST['data'])){
            $data =$_POST['data'];
            $meber = Member::model()->find('name="'.$data['name'].'"');
            if($meber){
                $status = (isset($data['status']))?0:1;
                $index = ($status>0)?18:17; //echo $status.':'.$index; die;
                if(Yii::app()->db->createCommand()->update('members', array('status'=>$status), 'name='.$data['name']))
                        $this->redirect (getURL().'site/message/'.$index);
                else 
                        $this->redirect (getURL().'site/message/57');
            }  else 
                 $this->redirect (getURL().'site/message/58');
        }
        $this->render('block_account');
    }
    
    // khoi phuc tai khoan
    public function actionUnblockAccount(){
        $this->render('unblock_account');
    }
    
    // kiem tra thong tin thanh vien
    public function actionQueryAccount(){
        if(isset($_POST['data'])){
            $data = $_POST['data'];
            $member= Member::model()->find('name="'.$data['name'].'"');
            $this->render('member_info',array('member'=>$member));
        } else 
        $this->render('query_account');
    }
    
    // truy van thong tin tài khoan tien
    public function actionQueryAccountCard(){
         if(isset($_POST['data'])){
            $data = $_POST['data'];
            $data['numberaccount'] = trim($data['numberaccount']);
            $data['numberaccount'] = str_replace(' ', '', $data['numberaccount']);
            $card= CardAccount::model()->find('numberaccount="'.$data['numberaccount'].'"');
            if($card)
                $member = Member::model()->findByPk($card->member_id);
            else 
                $member='';
            $this->render('account_info',array('member'=>$member));
        } else 
            $this->render('query_account_card');
    }

    //chay ajax load thong tin thanh vien
    public function actionGetMemberInfo(){ 
        $condition ='';
        if(isset($_POST['name'])){
            $name=  trim($_POST['name']);
            $name = str_replace(' ', '', $name);
            $condition .='name="'.$name.'"';
        }
        
        if(isset($_POST['cmnd'])){
            $cmnd=  trim($_POST['cmnd']);
            $cmnd = str_replace(' ', '', $cmnd);
            $condition .='cmnd="'.$cmnd.'"';
        }
        
        if(isset($_POST['numberaccount'])){
            $numberaccount=  trim($_POST['numberaccount']);
            $numberaccount = str_replace(' ', '', $numberaccount);
            $accounr = CardAccount::model()->find('numberaccount="'.$numberaccount.'"');
            if($accounr)
                $condition .='id='.$accounr->member_id;
            else 
                $condition .='id is null';
        }
        
        $member=  Member::model()->find($condition);
        $this->renderPartial('get_member_info',array('member'=>$member));
    }

    // nap tien
    public function actionUpdateMoney(){
        $session = getSession();
        if(isset($_POST['data'])){
            $data = $_POST['data'];
            $data['name']=  trim($data['name']);
            $data['numberaccount'] = trim($data['numberaccount']);
            $data['numberaccount'] = str_replace(' ', '', $data['numberaccount']);
            $data['money']= trim($data['money']);
            $data['user_id'] = Yii::app()->session['user']['id'];
            $data['money']=str_replace(',', '', $data['money']);
            $member = Member::model()->find('cmnd="'.$data['cmnd'].'" and name="'.$data['name'].'"'); 
            if($member && $member->CardAccount['numberaccount']==$data['numberaccount']){
                $card = CardAccountNoCheck::model()->find('numberaccount='.$data['numberaccount']);
                $card->money += $data['money'];
                if($card->save()){
                    Yii::app()->db->createCommand()->insert('update_money', array('numberaccount'=>$data['numberaccount'],'money'=>$data['money'],'status'=>1,'created'=>date('Y-m-d H:i:s'),'information'=>$data['information'],'user_id'=>$data['user_id']));
                    //$this->redirect (getURL ().'site/message/53'); 
                    if(isset($session['updateMoney']))
                        unset ($session['updateMoney']);
                    $data['title']='Phiếu thu tiền';
                    $data['action']=1;
                    $session['updateMoney'] = $data;
                    
                    $this->redirect (array('inPhieu'));
                } 
            }
            else 
                    $this->redirect (getURL().'site/message/56');          
            
        }
        $this->render('update_money');
    }
    
    // nap diem
    public function actionAddDiem(){
        $session = getSession();
        if(isset($_POST['data'])){
            $data = $_POST['data'];
            $data['name']=  trim($data['name']);            
            $data['diem']= trim($data['diem']);
            $data['user_id'] = Yii::app()->session['user']['id'];
            $data['diem']=str_replace(',', '', $data['diem']);
            $data['created'] = date('Y-m-d');
            $member = Member::model()->find('name="'.$data['name'].'"');            
            if($member){
                $data['member_id'] = $member->id; unset($data['name']);
                $diem = new DiemKhac();
                $diem->attributes = $data;
                if($diem->save()){                    
                    $this->redirect (getURL ().'site/message/87'); 
                } else 
                    $this->redirect (getURL ().'site/message/89'); 
            }
            else 
                    $this->redirect (getURL().'site/message/88');          
            
        }
        $this->render('add_diem');
    }
    
    // rut tien
    public function actionGetMoney(){ 
        $session = getSession();
        if(isset($_POST['data'])){
            $data = $_POST['data'];
            $data['name']=  trim($data['name']);
            $data['numberaccount'] = trim($data['numberaccount']);
            $data['numberaccount'] = str_replace(' ', '', $data['numberaccount']);
            $data['money']= trim($data['money']);
            $data['user_id'] = Yii::app()->session['user']['id'];
            $data['money']=str_replace(',', '', $data['money']);
            $member = Member::model()->find('cmnd="'.$data['cmnd'].'" and name="'.$data['name'].'"');
            if($member && $member->CardAccount['numberaccount']==$data['numberaccount']){
                if($member->status<1)
                    $this->redirect(getURL().'site/message/64');
                $card = CardAccount::model()->find('numberaccount='.$data['numberaccount']);
                if($card->blockade>0)
                    $this->redirect(getURL().'site/message/63');
          //      if(($card->money-50000)>=$data['money']){
                if(($card->money-0)>=$data['money']){
                    $card->money -= $data['money'];
                    if($card->save()){
                        Yii::app()->db->createCommand()->insert('update_money', array('numberaccount'=>$data['numberaccount'],'money'=>$data['money'],'status'=>0,'created'=>date('Y-m-d H:i:s'),'information'=>$data['information'],'user_id'=>$data['user_id']));                        
                        //$this->redirect (getURL ().'site/message/54');
                    if(isset($session['updateMoney']))
                        unset ($session['updateMoney']);
                    $data['title']='Phiếu rút tiền';
                    $data['action']=0;
                    $session['updateMoney'] = $data;
                    
                    $this->redirect (array('inPhieu'));
                    }
                }
                 else
                     $this->redirect (getURL ().'site/message/55');
            }
            else 
                    $this->redirect (getURL().'site/message/56');
        }      
        
        $this->render('get_money');
    }    
    
    // chuyển nhượng
    public function actionTransfer(){
        if(isset($_POST['data'])){
            $data=$_POST['data'];
            $data['account_send'] = trim($data['account_send']);
            $data['account_send'] = str_replace(' ', '', $data['account_send']);
            $data['account_get'] = trim($data['account_get']);
            $data['account_get'] = str_replace(' ', '', $data['account_get']);
            $data['money']= trim($data['money']);
            $data['money']=str_replace(',', '', $data['money']);
            $data['created'] = date('Y-m-d H:i:s');
            $data['modified'] = date('Y-m-d H:i:s');
            $account_send = CardAccountNoCheck::model()->find('numberaccount="'.$data['account_send'].'"'); 
            $account_get = CardAccountNoCheck::model()->find('numberaccount="'.$data['account_get'].'"'); 
            if(!$account_send)
                $this->redirect (getURL().'site/message/60');
            if(!$account_get)
                $this->redirect (getURL().'site/message/61');
            if($account_send->blockade>0)
                $this->redirect(getURL().'site/message/63');
            $membersend= Member::model()->findByPk($account_send->member_id);
            if($membersend->status<1)
                $this->redirect(getURL().'site/message/65');
          ///  if(($account_send->money-50000)>=$data['money']){
            if(($account_send->money-0)>=$data['money']){
                $sum_transfer = Yii::app()->db->createCommand('select sum(money) from transfer where account_send='.$data['account_send'].' and created>="'.date('Y-m-d').'"')->queryScalar();
                if($sum_transfer<$account_send['max_transfer']){
                    if(($sum_transfer+$data['money'])<$account_send['max_transfer']){
                        $account_send->money -= $data['money'];
                        $account_get->money += $data['money'];
                        if($account_send->save()&& $account_get->save()){   
                            $transfer_obj = new Transfer();
                            $transfer_obj->attributes= $data; 
                            $transfer_obj->save();
                            $this->redirect (getURL().'site/message/59');
                        }
                    } else 
                        $this->redirect(getURL().'site/message/52');
                } else {
                    $this->redirect(getURL().'site/message/51');
                }
            } else {
                $this->redirect(getURL().'site/message/50');
            }  
        }
        $this->render('transfer');
    }
    
    public function actionListMemberNoCard(){
        $members = Yii::app()->db->createCommand('select * from members where id not in (select member_id from card_accounts) and name <> "1234567890"')->queryAll();
        $this->render('list_member_no_card',array('members'=>$members));
    }
    // danh sach tai khoan bi phong toa so du
    public function actionListBlockAll(){
        $card_acounts = CardAccount::model()->findAll("blockade=1");// pr($card_acounts); die;
        $this->render('list_block_all',array('card_acounts'=>$card_acounts));
    }
    
    // danh sach tai khoan bi khóa
    public function actionListBlockAccount(){
        $members = Member::model()->findAll('status=0');
        $this->render('list_block_account',array('members'=>$members));
    }

    // lam lai the
    public function actionRemakeCard(){
        if(isset($_POST['data'])){
            $data=$_POST['data'];
            $data['numberaccount'] = trim($data['numberaccount']);
            $data['numberaccount'] = str_replace(' ', '', $data['numberaccount']);
            $data['fee']= trim($data['fee']);
            $data['fee']=str_replace(',', '', $data['fee']);
            $data['created'] = date('Y-m-d H:i:s');
            $data['type']='remakecard';
            if(Yii::app()->db->createCommand()->insert('fees', $data))
                $this->redirect(getURL().'site/message/62');
        }
        $this->render('remake_card');
    }
    
    // bao cao thu tien(tien gui)
    public function actionReportImport(){
        if(Yii::app()->session['user']['data_user']->power==2){
            $from = (isset($_POST['d_from']))?trim($_POST['d_from']):date('d/m/Y');
            $to = (isset($_POST['d_to']))?trim($_POST['d_to']).' 23:59:59':date('d/m/Y').' 23:59:59';  
            if(!empty($from)&&!empty($to)){
                $from = str_replace('/', '-', $from);
                $from = date('Y-m-d',  strtotime($from));
                $to = str_replace('/', '-', $to);    
                $to = date('Y-m-d H:i:s',  strtotime($to)); 
                $imports = Yii::app()->db->createCommand('select * from update_money where status=1 and created>="'.$from.'" and created<="'.$to.'"')->queryAll();
                $reports=array();
                foreach ($imports as $key=> $import){
                    $reports[$key]['UpdateMoney'] =$import;
                    $card = Yii::app()->db->createCommand('select * from card_accounts where numberaccount="'.$import['numberaccount'].'"')->queryRow();           
                    $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$card['member_id'].'"')->queryRow();            
                }  
                $this->render('report_import',array('reports'=>$reports,'from'=>date('d/m/Y',  strtotime($from)),'to'=>date('d/m/Y',  strtotime($to))));
            }  else      
                $this->render('report_import');
        }
    }
    
    // bao cao rut tien
    public function actionReportExport(){ 
        if(Yii::app()->session['user']['data_user']->power==2){
            $from = (isset($_POST['d_from']))?trim($_POST['d_from']):date('d/m/Y');
            $to = (isset($_POST['d_to']))?trim($_POST['d_to']).' 23:59:59':date('d/m/Y').' 23:59:59';   
            if(!empty($from)&&!empty($to)){
                $from = str_replace('/', '-', $from);
                $from = date('Y-m-d',  strtotime($from));
                $to = str_replace('/', '-', $to);    
                $to = date('Y-m-d H:i:s',  strtotime($to));
                $imports = Yii::app()->db->createCommand('select * from update_money where status=0 and created>="'.$from.'" and created<="'.$to.'"')->queryAll();
                $reports=array();
                foreach ($imports as $key=> $import){
                    $reports[$key]['UpdateMoney'] =$import;
                    $card = Yii::app()->db->createCommand('select * from card_accounts where numberaccount="'.$import['numberaccount'].'"')->queryRow();           
                    $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$card['member_id'].'"')->queryRow();            
                }  
                $this->render('report_export',array('reports'=>$reports,'from'=>date('d/m/Y',  strtotime($from)),'to'=>date('d/m/Y',  strtotime($to))));
            }  else      
                $this->render('report_export');
        }
    }
    
    // bao cao rut tien
    public function actionReportTransfer(){ 
        if(Yii::app()->session['user']['data_user']->power==2){
            $from = (isset($_POST['d_from']))?trim($_POST['d_from']):date('d/m/Y');
            $to = (isset($_POST['d_to']))?trim($_POST['d_to']).' 23:59:59':date('d/m/Y').' 23:59:59';  
            if(!empty($from)&&!empty($to)){
                $from = str_replace('/', '-', $from);
                $from = date('Y-m-d',  strtotime($from));
                $to = str_replace('/', '-', $to);    
                $to = date('Y-m-d H:i:s',  strtotime($to));
                $reports = Yii::app()->db->createCommand('select * from transfer where created>="'.$from.'" and created<="'.$to.'"')->queryAll();
                $this->render('report_transfer',array('reports'=>$reports,'from'=>date('d/m/Y',  strtotime($from)),'to'=>date('d/m/Y',  strtotime($to))));
            }
            else
                $this->render('report_transfer');
        }
    }
    
    // bao cao rut tien
    public function actionReportFees(){
        if(Yii::app()->session['user']['data_user']->power==2){
            $from = (isset($_POST['d_from']))?trim($_POST['d_from']):date('d/m/Y');
            $to = (isset($_POST['d_to']))?trim($_POST['d_to']).' 23:59:59':date('d/m/Y').' 23:59:59';   
            if(!empty($from)&&!empty($to)){
                $from = str_replace('/', '-', $from);
                $from = date('Y-m-d',  strtotime($from));
                $to = str_replace('/', '-', $to);    
                $to = date('Y-m-d H:i:s',  strtotime($to));
                $fees = Yii::app()->db->createCommand('select * from fees where created>="'.$from.'" and created<="'.$to.'"')->queryAll();
                $reports=array();
                foreach ($fees as $key=> $fee){
                    $reports[$key]['Fee'] =$fee;
                    $card = Yii::app()->db->createCommand('select * from card_accounts where numberaccount="'.$fee['numberaccount'].'"')->queryRow();           
                    $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$card['member_id'].'"')->queryRow();            
                }
                $this->render('report_fees',array('reports'=>$reports,'from'=>date('d/m/Y',  strtotime($from)),'to'=>date('d/m/Y',  strtotime($to))));
            }
            else
                $this->render('report_fees');
        }
    }
    
    // bao cao hoa hong
    public function actionReportRose(){  
        if(Yii::app()->session['user']['data_user']->power==2){
            $month = date('m'); 
            $year=date('Y');
            if($month==1)
                $year--;            
            if($month>1)
                $month--;
            else 
                $month = 12;
            $month = (isset($_POST['month']))?trim($_POST['month']):$month;
            $year = (isset($_POST['year']))?trim($_POST['year']):$year;
            if(!empty($month)&&!empty($year)){            
                $roses = Yii::app()->db->createCommand('select * from rose_months where month="'.$month.'" and year="'.$year.'" and status="success"')->queryAll();
                $reports=array();
                foreach ($roses as $key=> $rose){
                    $reports[$key]['Rose'] =$rose;            
                    $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$rose['member_id'].'"')->queryRow();            
                }    
                $this->render('report_rose',array('reports'=>$reports,'month'=>$month,'year'=>$year));
            }
            else 
                $this->render('report_rose');
        }
    }
    
    // bao cao hoa hong
    public function actionReportTax(){  
        if(Yii::app()->session['user']['data_user']->power==2){
            $month = date('m'); 
            $year=date('Y');
            if($month==1)
                $year--;            
            if($month>1)
                $month--;
            else 
                $month = 12;
            $month = (isset($_POST['month']))?trim($_POST['month']):$month;
            $year = (isset($_POST['year']))?trim($_POST['year']):$year;
            if(!empty($month)&&!empty($year)){            
                $taxs = Yii::app()->db->createCommand('select * from member_tax where month="'.$month.'" and year="'.$year.'"')->queryAll();
                $reports=array();
                foreach ($taxs as $key=> $tax){
                    $reports[$key]['Tax'] =$tax;            
                    $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$tax['member_id'].'"')->queryRow();            
                }    
                $this->render('report_tax',array('reports'=>$reports,'month'=>$month,'year'=>$year));
            }
            else
                $this->render('report_tax');
        }
    }
    
    // thiet lap muc dong thue
    public function actionSetTax(){
        $tax = Yii::app()->db->createCommand('select value from member_options where name="tax"')->queryScalar();
        $salary = Yii::app()->db->createCommand('select value from member_options where name="salary"')->queryScalar();
        if(isset($_POST['data'])){
            $data = $_POST['data']; 
            $data['salary'] = str_replace(',', '', $data['salary']);
            if($tax){
                $result=Yii::app()->db->createCommand()->update('member_options', array('value'=>$data['tax']), 'name="tax"');
            }
            else{
                $result=Yii::app()->db->createCommand()->insert('member_options', array('value'=>$data['tax'],'name'=>'tax','created'=>date('Y-m-d')));
            }
            
            if($salary){
                $result2=Yii::app()->db->createCommand()->update('member_options', array('value'=>$data['salary']), 'name="salary"');
            }
            else{
                $result2=Yii::app()->db->createCommand()->insert('member_options', array('value'=>$data['salary'],'name'=>'salary','created'=>date('Y-m-d')));
            }
            
            if($result&&$result2)
                $this->redirect(getURL().'site/message/66');
            else
                $this->redirect(getURL().'site/message/67');
        }
        $this->render('set_tax',array('tax'=>$tax,'salary'=>  number_format($salary)));
    }
    
    //loai cac tai khoan khong can dong thue
    public function actionSetNoTax(){
        if(isset($_POST['data'])){
            $data = $_POST['data'];
            $data['name']=  trim($data['name']);
            $data['numberaccount'] = trim($data['numberaccount']);
            $data['numberaccount'] = str_replace(' ', '', $data['numberaccount']);
            $data['cmnd'] = trim($data['cmnd']);
            $member = Member::model()->find('cmnd="'.$data['cmnd'].'" and name="'.$data['name'].'"');
            if($member && $member->CardAccount['numberaccount']==$data['numberaccount']){
                $card = CardAccount::model()->find('numberaccount='.$data['numberaccount']);
                $card->no_tax = isset($data['no_tax'])?0:1;
                $index = isset($data['no_tax'])?71:72;
                if($card->save()){                    
                    $this->redirect (getURL ().'site/message/'.$index);
                }
            }
            else 
                    $this->redirect (getURL().'site/message/56');          
            
        }
        $this->render('set_no_tax');
    }

        // thiet lap muc dong phi sms
    public function actionSetFeeSMS(){
        $fee = Yii::app()->db->createCommand('select value from member_options where name="fee_sms"')->queryScalar();
        if(isset($_POST['data'])){
            $data = $_POST['data'];            
            if($fee){
                $result=Yii::app()->db->createCommand()->update('member_options', array('value'=>$data['fee']), 'name="fee_sms"');
            }
            else{
                $result=Yii::app()->db->createCommand()->insert('member_options', array('value'=>$data['fee'],'name'=>'fee_sms','created'=>date('Y-m-d')));
            }
            if($result)
                $this->redirect(getURL().'site/message/69');
            else
                $this->redirect(getURL().'site/message/70');
        }
        $this->render('set_sms',array('fee'=>$fee));
    }
    
    // thiet lap cach tinh hoa hong
    public function actionSetCheckBonus(){
        $this->layout='default_system';
        $checkbonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $checkbonus = unserialize($checkbonus);
        if(isset($_POST['data'])){ 
            $data = $_POST['data']; //pr($data); die;
            $data = serialize($data);
            if($checkbonus){
                $result=Yii::app()->db->createCommand()->update('member_options', array('value'=>$data), 'name="bonus_level"');
            }
            else{
                $result=Yii::app()->db->createCommand()->insert('member_options', array('value'=>$data,'name'=>'bonus_level','created'=>date('Y-m-d')));
            }
            if($result)
                $this->redirect(getURL().'site/message/74');
            else
                $this->redirect(getURL().'site/message/75'); 
        } 
        $this->render('set_check_bonus',array('checkbonus'=>$checkbonus));
    }
    
    // xet duyet hoa hong cac thanh vien
    public function actionBrowseRose(){
        if(Yii::app()->session['user']['data_user']->power==2){
            $month = date('m'); 
            $year=date('Y');
            if($month==1)
                $year--;
            if($month>1)
                $month--;
            else 
                $month = 12;
            $members = Member::model()->findAll();        
            foreach($members as $key=> $member){
                $data[$key]['Rose'] = Yii::app()->tree->sumRoseMember($member,$month,$year);
                $data[$key]['Member']=$member;
            }
            $session = getSession();
            $session['browse']=$data;
            $session['time']=array('month'=>$month,'year'=>$year);
            $this->render('browser_rose',array('data'=>$data,'month'=>$month,'year'=>$year));
        }
    }
    
    //lap lenh thanh toan tien hoa hong
    public function actionMakeRose(){
        if(Yii::app()->session['user']['data_user']->power==2){
            $month = date('m'); 
            $year=date('Y');
            if($month==1)
                $year--;            
            if($month>1)
                $month--;
            else 
                $month = 12;
            $month = (isset($_POST['data']['month']))?trim($_POST['data']['month']):$month;
            $year = (isset($_POST['data']['year']))?trim($_POST['data']['year']):$year;
            $members = Member::model()->findAll();
            $total_real_rose=0;
            $error=0;
            foreach($members as $member){
                $card = $member->CardAccount; 
                if($card){ 
                    $rose = Yii::app()->tree->sumRoseMember($member,$month,$year);
                    $moneyRose = Yii::app()->tree->getRoseMonthCard($rose,$card);
                    $moneyTax = $moneyRose['moneyTax'];
                    $realTotal =$moneyRose['realTotal'];
                    $realTotal +=$rose['hoahongtieudung'];
                    $total_real_rose +=$realTotal;    
                    $count_month=0;
                    // form duoc submit va da check nut dong y thanh toan
                    if(isset($_POST['data'])&& isset($_POST['data']['give'])){ 
                        if($member->title==0){
                            // thanh vien duoc bao luu hoa hong toi da 2 thang khi la thanh vien ket noi
                            $count_month = Yii::app()->db->createCommand('select count(*) from rose_months where member_id="'.$member->id.'"')->queryScalar();                        
                            if($count_month>=3){ 
                                // thanh vien da tham gia >= 3 thang, huy toan hoa hong da duoc bao luu truoc do neu co
                                Yii::app()->db->createCommand()->update('rose_months', array('status'=>'cancel','modified'=>date('Y-m-d')), 'status="fail" and member_id="'.$member->id.'"');
                            }                        
                        }
                        if($member->title>0){  
                            // la thanh vien chinh thuc, thanh toan tien hoa hong thang hien tai va hoa hong bao luu neu co va luu lich su hoa hong o trang thai thanh cong
                            if($count_month<3){ 
                                $oldRoseMonth = RoseMonth::model()->findAll('member_id="'.$member->id.'" and status="fail"');
                                foreach($oldRoseMonth as $oldRose){
                                   $oldRoseData = unserialize($oldRose['totalrose']);
                                   $moneyRose = Yii::app()->tree->getRoseMonthCardLastMonth($oldRoseData,$card);
                                   $realTotal += $moneyRose['realTotal'];
                                   $total_real_rose +=$realTotal;
                                   $moneyTax += $moneyRose['moneyTax'];
                                }
                            } 
                            $card->money += $realTotal;
                            if(Yii::app()->db->createCommand()->update('card_accounts', array('money'=>$card->money), 'numbercard="'.$card->numbercard.'"')){ 
                                if($moneyTax>0)
                                    Yii::app()->db->createCommand()->insert('member_tax', array('member_id'=>$member->id,'money'=>$moneyTax,'status'=>'success','month'=>$month,'year'=>$year,'created'=>date('Y-m-d')));                           
                                if($count_month<3){
                                    // cap nhat trang thai cua 2 thang bao luu neu co la thanh cong, da thanh toan hoa hong
                                    Yii::app()->db->createCommand()->update('rose_months', array('status'=>'success','modified'=>date('Y-m-d')), 'status="fail" and member_id="'.$member->id.'"');
                                }
                                // luu lich su hoa hong thang dang tinh
                                Yii::app()->db->createCommand()->insert('rose_months',array('member_id'=>$member->id,'totalrose'=>  serialize($rose),'status'=>'success','month'=>$month,'year'=>$year,'created'=>date('Y-m-d'),'modified'=>date('Y-m-d'),'vip'=>$member->vip));                            
                            }
                            else {
                                if($realTotal==0)
                                    Yii::app()->db->createCommand()->insert('rose_months',array('member_id'=>$member->id,'totalrose'=>  serialize($rose),'status'=>'success','month'=>$month,'year'=>$year,'created'=>date('Y-m-d'),'modified'=>date('Y-m-d'),'vip'=>$member->vip));                            
                                else 
                                    $error++;
                            }
                            
                        } else { 
                            // thanh vien ket noi, chi thanh toan hoa hong tieu dung, hoa hong thu dong cua 4 tang dau tien, cac loai khac ko thanh toan, luu lich su hoa hong o trang thai that bai.
                            $card->money +=$rose['hoahongtieudung']+$rose['buying']['total']['success'];
                            Yii::app()->db->createCommand()->update('card_accounts', array('money'=>$card->money), 'numbercard="'.$card->numbercard.'"');
                            Yii::app()->db->createCommand()->insert('rose_months',array('member_id'=>$member->id,'totalrose'=>  serialize($rose),'status'=>'fail','month'=>$month,'year'=>$year,'created'=>date('Y-m-d'),'modified'=>date('Y-m-d'),'vip'=>$member->vip));                            
                        }
                    }
                } 
            }  
            if(isset($_POST['data'])&& isset($_POST['data']['give']))
                $this->redirect (getURL ().'site/message/68');
            else 
                $this->render('make_rose',array('total'=>$total_real_rose,'month'=>$month,'year'=>$year));                
        }
    }
    
    // thuc hien thua ke
    public function actionThuaKe(){
        if(isset($_POST['data'])){
            $data=$_POST['data'];
            $member_give= Member::model()->find('name="'.$data['peron_give'].'"');
            $member_get= Member::model()->find('name="'.$data['peron_get'].'"');
            $password= rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
            $password= addCode($password,3);
            $passwordcard= rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
            $passwordcard= addCode($passwordcard,3);
            if($member_give){
                if(isset($data['join'])){
                    if($member_get && Yii::app()->db->createCommand()->insert('member_inheritance',array('member_give'=>$member_give->id,'member_get'=>$member_get->id,'created'=>date('Y-m-d')))){
                        if(Yii::app()->db->createCommand()->update('members',array('password'=>$password), 'name="'.$data['peron_give'].'"')){                                        
                            Yii::app()->db->createCommand()->update('card_accounts',array('password_card'=>$passwordcard), 'member_id="'.$member_give->id.'"');
                            sendMail($member_get->email, 'phong@gmail.com', 'Gửi thông tin đăng nhập cua thành viên mà bạn được thừa kế', 'Tên đăng nhập :'.$member_give->name.' , mật khẩu đăng nhập :'.getString($password,3).' , mật khẩu thẻ : '.getString($passwordcard,3).' , Sau khi đăng nhập , vào phần thông tin cá nhân để thảy đổi thông tin cá nhân, vào phần thay đổi mật khẩu đăng nhập, mật khẩu thẻ để thay đổi lại mật khẩu mặc định.');
                            $this->redirect (getURL ().'site/message/73');
                        }
                    }
                }
                else {                
                    if(Yii::app()->db->createCommand()->update('members',array('cmnd'=>$data['cmnd'],'password'=>$password), 'name="'.$data['peron_give'].'"')){                                        
                        Yii::app()->db->createCommand()->update('card_accounts',array('password_card'=>$passwordcard), 'member_id="'.$member_give->id.'"');
                        sendMail($data['email'], 'phong@gmail.com', 'Gửi thông tin đăng nhập cua thành viên mà bạn được thừa kế', 'Tên đăng nhập :'.$member_give->name.' , mật khẩu đăng nhập :'.getString($password,3).' , mật khẩu thẻ : '.getString($passwordcard,3).' , Sau khi đăng nhập , vào phần thông tin cá nhân để thảy đổi thông tin cá nhân, vào phần thay đổi mật khẩu đăng nhập, mật khẩu thẻ để thay đổi lại mật khẩu mặc định.');
                        $this->redirect (getURL ().'site/message/73');
                    }
                }
            }           
        }
        $this->render('thua_ke');
    }
    
    public function actionInPhieu(){
        $this->layout='empty';
        $session = getSession();
        $member=  Member::model()->find('name="'.$session['updateMoney']['name'].'"');
        $setting = Setting::model()->findByPk(1);    
        $update = Yii::app()->db->createCommand('select * from update_money where numberaccount="'.$session['updateMoney']['numberaccount'].'" order by id desc limit 1')->queryRow();
        $this->render('in_phieu',array('member'=>$member,'update'=>$update,'setting'=>$setting));
    }

        // format so ajax
    public function actionCreateNumber(){
        $number = str_replace(',', '', $_POST['number']);
        echo number_format($number); 
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
    
    // thay doi thong tin thanh vien
    public function actionChangeMemberInfo($id){
        $member = Member::model()->findByPk($id);
        $cities = City::model()->findAll("status = 1 order by stt asc");
        $arr_city = CHtml::listData($cities, 'id', 'name');
        $this->performAjaxValidation($member); 
        if(isset($_POST['Member'])){ 
                $data = $_POST['Member'];
                $data['birthday'] =$_POST['birth_year'].'-'.$_POST['birth_month'].'-'.$_POST['birth_day'];
                $data['date_create'] =$_POST['year_create'].'-'.$_POST['month_create'].'-'.$_POST['day_create'];                
                unset($data['captcha']);
                $name = $member->name;                
                if($_FILES['Member']['error']['avatar']!=4){
                    $file=CUploadedFile::getInstance($member,'avatar'); // lay thong tin file upload trong model va tra ve ten file                                         
                    $data['avatar']='uploadfile/avatar/'.$file; 
                }
                if(Yii::app()->db->createCommand()->update('members', $data, 'id='.$member->id)){
                    if($_FILES['Member']['error']['avatar']!=4)
                         $file->saveAs($data['avatar']); 
                    // neu ten dang nhap thay doi
                    if($name!=$data['name']){
                        Yii::app()->db->createCommand()->update('members', array('person1'=>$data['name']), 'person1='.$name);
                        Yii::app()->db->createCommand()->update('members', array('person2'=>$data['name']), 'person2='.$name);
                    }
                     $member = Member::model()->findByPk($id);
                   // $this->redirect ('index');
                    $this->render('member_info',array('member'=>$member));
                }
            }
        else
            $this->render('change_member_info',array('member'=>$member,'cities'=>$arr_city));
    }
    
    // thay the thanh vien
    public function actionChangeMember(){
        if(isset($_POST['data'])){
            $mem_btt = Member::model()->find('name="'.$_POST['data']['name_btt'].'"');
            $mem_tt = Member::model()->find('name="'.$_POST['data']['name_tt'].'"');
            if(!empty($mem_btt) && !empty($mem_tt)){
                $node=new Nested_Set(Yii::app()->db); 
                $id = $mem_btt->id;
                $member1= $node->getNodeInfo($id);                
                $id2 = $mem_tt->id; 
                $member2=$node->getNodeInfo($id2);
                // pr($member1); pr($member2); die;
                foreach($member1 as $key=>$value){                        
                    $member1[$key]=$member2[$key];
                    $member2[$key]=$value;
                }
                unset($member1['level']); unset($member1['lft']); unset($member1['rgt']);unset($member1['parents']);unset($member1['id']);
                unset($member2['level']); unset($member2['lft']); unset($member2['rgt']);unset($member2['parents']);unset($member2['id']);
                // thay doi data
                $node->updateNode($member1,$id); 
                $node->updateNode($member2,$id2);
               
                $count=Yii::app()->db->createCommand('select max(id) from members')->queryScalar();                    
                $count ++;
                // thay doi id
                Yii::app()->db->createCommand()->update('members', array('id'=>$count), 'id='.$id);
                Yii::app()->db->createCommand()->update('members', array('id'=>$id), 'id='.$id2);
                Yii::app()->db->createCommand()->update('members', array('id'=>$id2), 'id='.$count);
                // thay doi cac thanh vien con theo id moi;
                Yii::app()->tree->updateNodes($id,$id2);
                Yii::app()->tree->updateNodes($id2,$id);                
                $this->redirect(getURL().'site/message/90');// nang cap thanh cong
            }

        }
        $this->render('change_member');
    }
    
    // danh sach thanh vien dat sao
    public function actionListVip(){  
       // $this->layout='default_account';
            $month = date('m'); 
            $year=date('Y');
            if($month==1)
                $year--;            
            if($month>1)
                $month--;
            else 
                $month = 12;
            $month = (isset($_POST['month']))?trim($_POST['month']):$month;
            $year = (isset($_POST['year']))?trim($_POST['year']):$year;   
            $vip=array();
            if(!empty($month)&&!empty($year)){            
                if($month==date('m')&&$year==date('Y')){
                    $memberlist = Member::model()->findAll();
                    foreach($memberlist as $member ){
                        Yii::app()->tree->setMemberTitle($member->id);
                        Yii::app()->tree->setVip($member->id);
                    }
                    $vip[1]=  Member::model()->findAll('vip=1');
                    $vip[2]=  Member::model()->findAll('vip=2');
                    $vip[3]=  Member::model()->findAll('vip=3');
                    $vip[4]=  Member::model()->findAll('vip=4');
                    $vip[5]=  Member::model()->findAll('vip=5');
                }
            }
            else {
                $membervip=  RoseMonth::model()->findAll("vip=1 and month = $month and year = $year");
                $membervip=  CHtml::listData($membervip, 'member_id', 'member_id');
                $vip[1]=  empty($membervip)?array():Member::model()->findAll('id in('.  implode(',', $membervip).')');
                $membervip=  RoseMonth::model()->findAll("vip=2 and month = $month and year = $year");
                $membervip=  CHtml::listData($membervip, 'member_id', 'member_id');
                $vip[2]=  empty($membervip)?array():Member::model()->findAll('id in('.  implode(',', $membervip).')');
                $membervip=  RoseMonth::model()->findAll("vip=3 and month = $month and year = $year");
                $membervip=  CHtml::listData($membervip, 'member_id', 'member_id');
                $vip[3]=  empty($membervip)?array():Member::model()->findAll('id in('.  implode(',', $membervip).')');
                $membervip=  RoseMonth::model()->findAll("vip=4 and month = $month and year = $year");
                $membervip=  CHtml::listData($membervip, 'member_id', 'member_id');
                $vip[4]=  empty($membervip)?array():Member::model()->findAll('id in('.  implode(',', $membervip).')');
                $membervip=  RoseMonth::model()->findAll("vip=5 and month = $month and year = $year");
                $membervip=  CHtml::listData($membervip, 'member_id', 'member_id');
                $vip[5]=  empty($membervip)?array():Member::model()->findAll('id in('.  implode(',', $membervip).')');
            }
            $this->render('list_vip',array('vip'=>$vip,'month'=>$month,'year'=>$year));
               
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
