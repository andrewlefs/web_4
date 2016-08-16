<?php
class TestController extends CController{
    public function actionIndex(){
        // tao doi tuong service
      // $service = new SoapClient('http://berichmart.com.vn/service/webService/service');
      // pr($service->getMemberByUsername('01234567891'));
       
    }
    
    public function actionHoaHong(){
        $members = Member::model()->findAll('title>0');
        $this->render('hoa_hong',array('members'=>$members)) ;       
    }
    
    public function actionRose(){       
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
            $tax=0;
             
            foreach($members as $member){
                $card = $member->CardAccount; 
                if($card){ 
                    $rose = Yii::app()->tree->sumRoseMember($member,$month,$year);
                    $moneyRose = Yii::app()->tree->getRoseMonthCard($rose,$card);
                    $moneyTax = $moneyRose['moneyTax']; $tax +=$moneyTax;
                    $realTotal =$moneyRose['realTotal'];
                    $realTotal +=$rose['hoahongtieudung'];
                    $total_real_rose +=$realTotal;  
                } 
            }  
            echo 'tax:'.$moneyTax.'<br>';
            echo $total_real_rose; die;
        
    }
    
    public function actionRose2(){
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
            $sum=0;
            foreach($data as $item){
                    $report = $item['Rose'];
                    $member= $item['Member'];
                    $buying=$report['buying']['total']['success'];
                    $offline=$report['offline']['total']['success'];
                    $online=$report['online']['total']['success'];
                    $tax=0;
                    $total=$buying+$offline+$online + $report['hoahongtieudung'];
                    $realTotal =$total-$tax;   
                    $sum = $sum+$realTotal;
            }
            echo $sum; die;
    }
    
    public function actionRose3($id){
        $month=$id;
        $rose = RoseMonth::model()->find("member_id=306 and month=$month");
        $hoahong = unserialize($rose['totalrose']);
        pr($hoahong); die;
    }
    
    
}
?>
