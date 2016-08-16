<?php
Yii::import("application.library.Nested_Set");
class ReportRoseController extends Controller{
    public $layout = "default_report";    
    
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
        $this->render('index');
    }
                // bao cao thu tien(tien gui)
    public function actionReportImport(){
        $from = (isset($_POST['d_from']))?trim($_POST['d_from']):date('d/m/Y');
        $to = (isset($_POST['d_to']))?trim($_POST['d_to']).' 23:59:59':date('d/m/Y').' 23:59:59'; 
        $user_id = (isset($_POST['user_id']))?trim($_POST['user_id']):'';
        $userlist = User::model()->findAll();
        $userlist = CHtml::listData($userlist, 'id', 'fullname');
        if(!empty($from)&&!empty($to)){
            $from = str_replace('/', '-', $from);
            $from = date('Y-m-d',  strtotime($from));
            $to = str_replace('/', '-', $to);    
            $to = date('Y-m-d H:i:s',  strtotime($to)); 
            if(empty($user_id))
                $imports = Yii::app()->db->createCommand('select * from update_money where status=1 and created>="'.$from.'" and created<="'.$to.'"')->queryAll();
            else 
                $imports = Yii::app()->db->createCommand('select * from update_money where status=1 and created>="'.$from.'" and created<="'.$to.'" and user_id="'.$user_id.'"')->queryAll();
            $reports=array(); $total=0;
            foreach ($imports as $key=> $import){
                $reports[$key]['UpdateMoney'] =$import;
                $total += $import['money'];
                $card = Yii::app()->db->createCommand('select * from card_accounts where numberaccount="'.$import['numberaccount'].'"')->queryRow();           
                $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$card['member_id'].'"')->queryRow();            
                $reports[$key]['User']= Yii::app()->db->createCommand('select * from users where id="'.$import['user_id'].'"')->queryRow();            
            }  
            $this->render('report_import',array('reports'=>$reports,'total'=>$total,'from'=>date('d/m/Y',  strtotime($from)),'to'=>date('d/m/Y',  strtotime($to)),'user_id'=>$user_id,'userlist'=>$userlist));
        }  else      
            $this->render('report_import');
    }
    
    // bao cao rut tien
    public function actionReportExport(){ 
            $from = (isset($_POST['d_from']))?trim($_POST['d_from']):date('d/m/Y');
            $to = (isset($_POST['d_to']))?trim($_POST['d_to']).' 23:59:59':date('d/m/Y').' 23:59:59'; 
            $user_id = (isset($_POST['user_id']))?trim($_POST['user_id']):'';
            $userlist = User::model()->findAll();
            $userlist = CHtml::listData($userlist, 'id', 'fullname');
            if(!empty($from)&&!empty($to)){
                $from = str_replace('/', '-', $from);
                $from = date('Y-m-d',  strtotime($from));
                $to = str_replace('/', '-', $to);    
                $to = date('Y-m-d H:i:s',  strtotime($to));
                if(empty($user_id))
                    $imports = Yii::app()->db->createCommand('select * from update_money where status=0 and created>="'.$from.'" and created<="'.$to.'"')->queryAll();
                else
                    $imports = Yii::app()->db->createCommand('select * from update_money where status=0 and created>="'.$from.'" and created<="'.$to.'" and user_id="'.$user_id.'"')->queryAll();
                $reports=array();
                $total=0;
                foreach ($imports as $key=> $import){
                    $reports[$key]['UpdateMoney'] =$import;
                    $total += $import['money'];
                    $card = Yii::app()->db->createCommand('select * from card_accounts where numberaccount="'.$import['numberaccount'].'"')->queryRow();           
                    $reports[$key]['Member']= Yii::app()->db->createCommand('select * from members where id="'.$card['member_id'].'"')->queryRow();            
                    $reports[$key]['User']= Yii::app()->db->createCommand('select * from users where id="'.$import['user_id'].'"')->queryRow();            
                }  
                $this->render('report_export',array('reports'=>$reports,'total'=>$total,'from'=>date('d/m/Y',  strtotime($from)),'to'=>date('d/m/Y',  strtotime($to)),'user_id'=>$user_id,'userlist'=>$userlist));
            }  else      
                $this->render('report_export'); 
    }
    
    // bao cao 
    public function actionReportTransfer(){ 
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
    
    // bao cao rut tien
    public function actionReportFees(){
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
    
    // bao cao hoa hong
    public function actionReportRose(){  
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
    
    // bao cao hoa hong
    public function actionReportTax(){ 
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
    
    // bao cao hoa hong
    public function actionReportHHTong(){  
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
            if(!empty($month)&&!empty($year)){            
                $roses = Yii::app()->db->createCommand('select * from rose_months where month="'.$month.'" and year="'.$year.'" and status="success"')->queryAll();               
                $tongall=$tong_hhthudong=$tong_hhptht = $tong_hhhtptht=array('tong_hoa_hong'=>0,'so_tien_thanh_toan'=>0,'so_tien_con_lai'=>0);
                $tongall['thue']=0;
                $tong = array();
                foreach ($roses as $key=> $rose){ 
                    $hoahong = unserialize($rose['totalrose']);
                    // tong hoa hong cua thanh vien chua xac dinh cac dk
                    $tong_hoa_hong_full = $hoahong['online']['total']['sum'] +$hoahong['offline']['total']['sum'] + $hoahong['buying']['total']['totalrose']+$rose['hoahongtieudung'];
                    // tong hoa hong cua thanh vien nhan duoc thuc te khi xet cac dieu kien nhan hoa hong cac cap
                    $total=$hoahong['buying']['total']['success']+$hoahong['offline']['total']['success']+$hoahong['online']['total']['success']+$rose['hoahongtieudung'];  
                    // tinh thue cua thanh vien
                    $tax=  $hoahong['tax'];                    
                    $moneyTax = ($total>=$hoahong['salary'])?$total/100*$tax:0;
                    $realTotal =$total-$moneyTax;    // so tien da tinh thue        
                    
                    // cong don hoa hong cac thanh vien lai cua tat ca cac loai hoa hong
                    $tongall['tong_hoa_hong'] +=$tong_hoa_hong_full;
                    $tongall['so_tien_thanh_toan'] +=$realTotal;
                    $tongall['so_tien_con_lai'] += $tong_hoa_hong_full - $realTotal;
                    $tongall['thue'] += $moneyTax;
                    // cong dong hh thu dong
                    $tong_hhthudong['tong_hoa_hong'] +=$hoahong['buying']['total']['totalrose'];
                    $tong_hhthudong['so_tien_thanh_toan'] +=$hoahong['buying']['total']['success'];
                    $tong_hhthudong['so_tien_con_lai'] += $hoahong['buying']['total']['totalrose'] - $hoahong['buying']['total']['success'];
                    // cong dong hh ho tro ptht
                    $tong_hhhtptht['tong_hoa_hong'] +=$hoahong['offline']['total']['sum'];
                    $tong_hhhtptht['so_tien_thanh_toan'] +=$hoahong['offline']['total']['success'];
                    $tong_hhhtptht['so_tien_con_lai'] += $hoahong['offline']['total']['sum'] - $hoahong['offline']['total']['success'];
                    // cong dong hh ptht
                    $tong_hhptht['tong_hoa_hong'] +=$hoahong['online']['total']['sum'];
                    $tong_hhptht['so_tien_thanh_toan'] +=$hoahong['online']['total']['success'];
                    $tong_hhptht['so_tien_con_lai'] += $hoahong['online']['total']['sum'] - $hoahong['online']['total']['success'];
                    
                }    
                $tong['full']=$tongall;
                $tong['hhthudong']=$tong_hhthudong;
                $tong['hhhotroptht']=$tong_hhhtptht;
                $tong['hhptht']=$tong_hhptht;
                $this->render('report_hh_tong',array('total'=>$tong,'month'=>$month,'year'=>$year));
            }
            else 
                $this->render('report_hh_tong');
    }
    
    // báo cáo lợi nhuận
    public function actionBaoCaoLoiNhuan(){
        $this->render('bao_cao_loi_nhuan');
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
    public function actionReportTotalMoneyMember(){
        $memberlist = Member::model()->findAll('1=1 order by id asc');
        $this->render('report_total_money_member',array('memberlist'=>$memberlist));
    }
    
    //tra ve tong tien thanh vien da nap
    public function actionReportTotalMoneyUpdateMember(){
        $naptienlist =  Yii::app()->db->createCommand('select members.*, update_money.numberaccount, sum(update_money.money) as total from members,card_accounts,update_money where update_money.numberaccount=card_accounts.numberaccount and card_accounts.member_id = members.id and update_money.status=1 group by update_money.numberaccount order by total')->queryAll();
       // pr($naptienlist); die;
        $this->render('report_total_money_update_member',array('naptienlist'=>$naptienlist));
    }
    //tra ve tong tien thanh vien nang cap theo ngay thang nam
    public function actionReportTotalMoneyTVCT(){
        $day = (!empty($_REQUEST['day']))?$_REQUEST['day']:'';
        $month = (!empty($_REQUEST['month']))?$_REQUEST['month']:'';
        $year = (!empty($_REQUEST['year']))?$_REQUEST['year']:'';
        $condition='';
        $condition .= (!empty($day))?' and day(created)='.$day:'';
        $condition .= (!empty($month))?' and month(created)='.$month:'';
        $condition .= (!empty($year))?' and year(created)='.$year:'';
       // echo $condition.'<br>';
        $totalmoney =  Yii::app()->db->createCommand('select sum(money) as total from update_money where status=2'.$condition)->queryScalar();
        //ECHO($totalmoney); echo 'abc'; die;
        $this->render('report_total_tvct',array('totalmoney'=>$totalmoney,'condition'=>$condition,'day'=>$day,'month'=>$month,'year'=>$year));
    }
    
    // tra ve thong thanh vien cac danh hieu
     public function actionReportCountMemberTitle(){
        $result = Yii::app()->tree->getListMemberTotalMoney();
        $this->render('report_count_member_title',array('result'=>$result));
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
