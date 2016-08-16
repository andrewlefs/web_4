<?php
class CronController extends Controller
{
    // tinh hoa hong cuoi moi thang luu vao bang rose month
        public function actionMakeRoseMonth(){
            //$lastDayOfMonth = $this->_check(date('m'),date('Y'));
            //if(date('d')==$lastDayOfMonth){ // neu ngay hien tai la ngay cuoi thang thi luu tu dong voi trang thai fail
                $memberlist=  Member::model()->findAll('id <> 1'); 
                foreach($memberlist as $member){
                    Yii::app()->tree->makeRoseMonth($member,'fail');
                } 
           // }
        }
        
        public function MakeRoseMonth(){
            $memberlist=  Member::model()->findAll('id <> 1'); 
            foreach($memberlist as $member){
                Yii::app()->tree->makeRoseMonth($member,'fail');
            } 
        }
        
        function _check($m, $y){
            switch($m){
                case 1:case 3:case 5:case 7:case 8:case 10:case 12: 
                    return 31;break;
                case 4:case 6:case 9:case 11:case 12:
                    return 30;break;
                case 2: return ($y % 4 == 0) ? 29 : 28;break;  
                }
        }
}

$crol = new CronController('cron','member');
$crol->MakeRoseMonth();
?>
