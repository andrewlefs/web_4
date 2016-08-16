<?php
class CardAccountsController extends Controller
{
   // nap tien
   public function actionUpdateMoney(){ 
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $condition = '';
        if(isset($data['member_id']))
            $condition .='member_id='.$data['member_id'];
        
        if(isset($data['numbercard'])){
            $condition .=(!empty($condition))? ' and ':'';
            $condition .='numbercard='.$data['numbercard'];
        }
        
        if(isset($data['password_card'])){
            $condition .=(!empty($condition))? ' and ':'';
            $condition .='password_card="'.addCode($data['password_card'],3).'"';
        }
        
        if(isset($data['numberaccount'])){
            $condition .=(!empty($condition))? ' and ':'';
            $condition .='numberaccount='.$data['numberaccount'];
        }
        if(isset($data['money'])&& intval($data['money'])){
            $card = CardAccount::model()->find($condition);
            $card->money += $data['money'];
            if($card->save())
                echo true;
            else 
                echo false;
        }
   }
   
   // chuyen tien dent ai khoan nguoi khac
   public function actionSendMoneyToOther(){
       
   }
}
?>
