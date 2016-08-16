<?php
Yii::import("application.library.Nested_Set");
class TreeMember extends CApplicationComponent
{
    // tra ve doanh thu tieu dung trong thang cua 1 thanh vien    
    public function sumProfit($member_id,$month,$year){
        $sum = Yii::app()->db->createCommand("SELECT round(sum(TongDiem),2)as sum from hoadon where month(NgayXuat)=$month and year(NgayXuat)=$year and member_id=$member_id")->queryScalar();        
        $sum2 = Yii::app()->db->createCommand("SELECT round(sum(diem),2)as sum from diemkhac where month=$month and year=$year and member_id=$member_id")->queryScalar();  
        return ($sum+$sum2);
    }
    // tinh tong hoa hong trong thang huong tu thanh vien con co cap do level
    /*
    public function sumRose($member_id,$sub_level,$rose,$month,$year){
        $sum = Yii::app()->db->createCommand("SELECT sum(money)as sum from member_bonus where month(created)=$month and year(created)=$year and member_id=$member_id and submember_level=$sub_level and rose='$rose'")->queryRow();        
        return $sum['sum'];
    }
    */
    
    
    // set cap do title
    public function setMemberTitle($member_id,$month=0,$year=0){ 
        $month = ($month==0)?date('m'):$month;
        $year = ($year==0)?date('Y'):$year;
        $model = new Nested_Set(Yii::app()->db);
       // $last_month=  strtotime(date('Y-m-d').' -1 month');
        $sum = $this->sumProfit($member_id,$month,$year); // tinh tong doanh thu
        $member = Member::model()->findByPk($member_id);
        $member_level_1= Member::model()->findAll('parents = '.$member_id); // cac thanh vien cap 1
        $sub_member_online_tvct = Yii::app()->db->createCommand('select count(*) as sum from members where person1="'.$member->name.'" and title>0')->queryRow(); // 3 thanh vien chinh thuc dc giioi thieu truc tiep 
        $dieukiendiem =$this->getDieuKienHoaHongDiem();
        $member_ct=0;
        $member_silver = 0; 
        $member_1=array();
        foreach($member_level_1 as $level1){
            $member_1[$level1->id] = $level1->id; 
            if($level1->title>0)
                $member_ct++; // tong so thanh vien cap 1 la tvct
            
            if($level1->title2>0)
                $member_silver++; // tong so thanh vien cap 1 dat silver
        }
        
        if(isset($sub_member_online_tvct['sum']) && $sub_member_online_tvct['sum']>=3){ // >= 3 thanh vien ct gioi thieu truc tiep
            if($sum>=$dieukiendiem['tvtc']) // tieu dung 100d
                $model->updateNode(array('title'=>2), $member_id); //thanh vien tich cuc   
            else if($member->title>1)
                $model->updateNode(array('title'=>1), $member_id);
        } 
        else if($member->title>1)
                $model->updateNode(array('title'=>1), $member_id);
        if($member_ct>=3){ // 3 tvct  cap 1                 
            $member_level_3 = Member::model()->findAll("lft >=".$member->lft." and rgt <=".$member->rgt.' and title>0 and level='.($member->level+3)); // tim thanh vien cap 3 la chinh thuc
            $member_tree_tvct = Member::model()->findAll("lft >".$member->lft." and rgt <".$member->rgt.' and title>0'); // tim tvct tren toan cay
            if(count($member_tree_tvct)>=100) // 3 tvct cap 1 , 100 tvct tren toan cay
                $model->updateNode(array('title2'=>1), $member_id); // thanh vien bac silver
            else if($member_silver<3)
                $model->updateNode(array('title2'=>0), $member_id); // khong dat silver , gold
        }
        
        if($member_silver>=3 && count($member_tree_tvct)>=365) // 3 silver , toan he thong co 365 tvct, dat gold
                $model->updateNode(array('title2'=>2), $member_id); // thanh vien vang gold
        
    } 
    
    // set danh hieu vip
    public function setVip($member_id,$month=0,$year=0){
        $month = ($month==0)?date('m'):$month;
        $year = ($year==0)?date('Y'):$year;
        $model = new Nested_Set(Yii::app()->db);
        $members = Member::model()->findAll('parents = '.$member_id);        
        $count = 0;
        if(count($members)<3) // dieu kien co ban la co 3 nhanh
            return;
        else {
            foreach($members as $member ){
                 $vip = Yii::app()->db->createCommand("select id from members where lft >= ".$member->lft." and rgt <=".$member->rgt." and vip = 4 limit 1")->queryRow();
                 if(isset($vip['id'])&& !empty($vip['id']))
                     $count++;
            }
            if($count >=3){ // co >= 3 member 4 sao
                $model->updateNode (array('vip'=>5),$member_id); // set vip 5 sao                
            }else{
                $count=0;
                foreach($members as $member ){
                 $vip = Yii::app()->db->createCommand("select id from members where lft >= ".$member->lft." and rgt <=".$member->rgt." and vip = 3 limit 1")->queryRow();
                 if(isset($vip['id'])&& !empty($vip['id']))
                     $count++;
                }
                if($count >=3){ // co >= 3 member 3 sao
                    $model->updateNode (array('vip'=>4),$member_id); // set vip 4 sao                    
                }else{
                    $count=0;
                    foreach($members as $member ){
                    $vip = Yii::app()->db->createCommand("select id from members where lft >= ".$member->lft." and rgt <=".$member->rgt." and vip = 2 limit 1")->queryRow();
                    if(isset($vip['id'])&& !empty($vip['id']))
                        $count++;
                    }
                    if($count >=3){ // co >= 3 member 2 sao
                        $model->updateNode (array('vip'=>3),$member_id); // set vip 3 sao                        
                    }  else{
                        $count=0;
                        foreach($members as $member ){
                        $vip = Yii::app()->db->createCommand("select id from members where lft >= ".$member->lft." and rgt <=".$member->rgt." and vip = 1 limit 1")->queryRow();
                        if(isset($vip['id'])&& !empty($vip['id']))
                            $count++;
                        }
                        if($count >=3){ // co >= 3 member 1 sao
                            $model->updateNode (array('vip'=>2),$member_id); // set vip 2 sao                            
                        } else{
                            foreach($members as $member ){
                            $memberGold = Yii::app()->db->createCommand("select id from members where lft >= ".$member->lft." and rgt <=".$member->rgt." and title2 = 2 limit 1")->queryRow();
                            if(isset($memberGold['id'])&& !empty($memberGold['id']))
                                $count++;
                            }
                            if($count >=3){ // co >= 3 member gold
                                $model->updateNode (array('vip'=>1),$member_id); // set vip 1 sao                                
                            }
                            else $model->updateNode (array('vip'=>0),$member_id); // ko co vip
                        }
                    }
                }
            }
        }
        
    }
    
    // check co duoc huong hoa hong hay khong    
    public function checkBonus($member_id,$level=1,$month=0,$year=0,$option=null){
        $month = ($month==0)?date('m'):$month;
        $year = ($year==0)?date('Y'):$year;
        $this->setMemberTitle($member_id,$month,$year); // set tvtc, silver, gold
        $this->setVip($member_id,$month,$year); // set vip 1-5
        $sum = $this->sumProfit($member_id,$month,$year); // tinh tong doanh thu
        $model = new Nested_Set(Yii::app()->db);
        $member = $model->getNodeInfo($member_id); //member duoc huong hoa hong
        $result=array();
        if(isset($option)&&!empty($option)){
            if($option='tvct'){
                if($member['title']>0 && $sum>=50) // la tvct  + doanh thu >= 50d
                        $result['success']= true;
                else{
                    if($member['title']==0)
                        $result['reason'][]='+ Chưa là thành viên chính thức';
                    if($sum<50)
                        $result['reason'][]='+ Doanh số tiêu dùng nhỏ hơn 50 điểm'; 
                    $result['success']=false;
                }
            }
            return $result;
        }
        if($member){            
            $count=0;               
            $memberslevel1 = Member::model()->findAll('parents = '.$member['id']);
                switch ($level){
                    case 1: case 2: case 3:
                        if($member['title']>0 && $sum>=50) // la tvct  + doanh thu >= 50d
                             $result['success']= true;
                        else{
                            if($member['title']==0)
                                $result['reason'][]='+ Chưa là thành viên chính thức';
                            if($sum<50)
                               $result['reason'][]='+ Doanh số tiêu dùng nhỏ hơn 50 điểm'; 
                            $result['success']=false;
                        }
                        break;
                    case 4:
                        if($member['title']>0 && $member['title2']==1 && $sum>=100) // tvct + silver + doanh thu >=100
                             $result['success']= true;
                        else{
                            if($member['title']==0)
                                $result['reason'][]='+ Chưa là thành viên chính thức';
                            if($member['title2']==0)
                                $result['reason'][]='+ Chưa là thành viên Silver';
                            if($sum<100)
                               $result['reason'][]='+ Doanh số tiêu dùng nhỏ hơn 100 điểm'; 
                            $result['success']=false;
                        }
                        break;
                    case 5:
                        if($member['title']==2 && $member['title2']==1){ // tvtc + silver                            
                            foreach($memberslevel1 as $child){
                                $member_silver = Member::model()->find('title2 = 1 and lft >= ? and rgt <= ?',array($child->lft,$child->rgt));
                                if(!empty($member_silver))
                                    $count++;
                            }
                            if($count>=2) // 2 thanh vien o 2 nhanh khac nhau
                                $result['success']= true;
                            else{
                                if($count<2)
                                    $result['reason'][]='+ Chưa có đủ 2 thành viên silver ở 2 nhánh khác nhau'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']==0)
                                $result['reason'][]='+ Chưa là thành viên Silver';
                            $result['success']=false;
                        }
                        break;
                    case 6:
                        if($member['title']==2 && $member['title2']==1){
                            foreach($memberslevel1 as $child){
                                $member_silver = Member::model()->find('title2 = 1 and lft >= ? and rgt <= ?',array($child->lft,$child->rgt));
                                if(!empty($member_silver))
                                    $count++;
                            }
                            if($count>=4) // 4 thanh vien o 2 nhanh khac nhau
                                $result['success']= true;
                            else {
                                if($count<4)
                                    $result['reason'][]='+ Chưa có đủ 4 thành viên silver ở 4 nhánh khác nhau'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']==0)
                                $result['reason'][]='+ Chưa là thành viên Silver';
                            $result['success']=false;
                        }
                        break;
                    case 7:
                        if($member['title']==2 && $member['title2']==2){ // tvtc + gold
                            $result['success']= true;                            
                        }else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']<2)
                                $result['reason'][]='+ Chưa là thành viên Gold';
                            $result['success']=false;
                        }
                        break;
                    case 8:
                        if($member['title']==2 && $member['title2']==2){
                            foreach($memberslevel1 as $child){
                                $member_gold = Member::model()->find('title2 = 2 and lft >= ? and rgt <= ?',array($child->lft,$child->rgt));
                                if(!empty($member_gold))
                                    $count++;
                            }
                            if($count>=2) // 2 thanh vien o 2 nhanh khac nhau
                                $result['success']= true;
                            else {
                                if($count<2)
                                    $result['reason'][]='+ Chưa có đủ 2 thành viên Gold ở 2 nhánh khác nhau'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']<2)
                                $result['reason'][]='+ Chưa là thành viên Gold';
                            $result['success']=false;
                        }
                        break;
                    case 9:
                        if($member['title']==2 && $member['title2']==2){
                            foreach($memberslevel1 as $child){
                                $member_gold = Member::model()->find('title2 = 2 and lft >= ? and rgt <= ?',array($child->lft,$child->rgt));
                                if(!empty($member_gold))
                                    $count++;
                            }
                            if($count>=4) // 4 thanh vien o 2 nhanh khac nhau
                                $result['success']= true;
                            else {
                                if($count<4)
                                    $result['reason'][]='+ Chưa có đủ 4 thành viên Gold ở 4 nhánh khác nhau'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']<2)
                                $result['reason'][]='+ Chưa là thành viên Gold';
                            $result['success']=false;
                        }
                        break;
                    case 10:
                        if($member['title']==2 && $member['vip']==1){
                            $result['success']= true;
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['vip']<1)
                                $result['reason'][]='+ Chưa là thành viên Vip 1*';
                            $result['success']=false;
                        }
                        break;
                    default :
                        if($member['vip']>=1)
                            $result['success']= true;
                        else{
                            $result['reason'][]='+ Chưa là thành viên Vip từ 1* trở lên';
                            $result['success']=false;
                        }
                }
           
            return $result;
        }
    }
    
    // check co duoc huong hoa hong hay khong    
    public function checkNewBonus($member_id,$level=1,$month=0,$year=0,$option=null){
        $month = ($month==0)?date('m'):$month;
        $year = ($year==0)?date('Y'):$year; // echo $month.':'.$year.' / '; die;
        $this->setMemberTitle($member_id,$month,$year); // set tvtc, silver, gold
        $this->setVip($member_id,$month,$year); // set vip 1-5
        $sum = $this->sumProfit($member_id,$month,$year); // tinh tong doanh thu
        $model = new Nested_Set(Yii::app()->db);
        $member = $model->getNodeInfo($member_id); //member duoc huong hoa hong
        $dieukiendiem =$this->getDieuKienHoaHongDiem();
        $result=array();
        
        if($member){            
            $count=0;               
            $memberslevel1 = Member::model()->findAll('parents = '.$member['id']);
                switch ($level){
                    case 1: case 2: case 3: case 4:
                        if(($member['title']>0 && $sum>=$dieukiendiem['tvct'])||($member['title']==0 && $option=='tvct'&&$sum>50)) // la tvct  + doanh thu >= 50d hoac la thanh vien ket noi voi doan thu >=50d
                             $result['success']= true;
                        else{
                            if($member['title']==0&&empty($option))
                                $result['reason'][]='+ Chưa là thành viên chính thức';
                            if($member['title']==0 && $option=='tvct' && $sum<50)
                                $result['reason'][]='+ Doanh số tiêu dùng nhỏ hơn 50 điểm';
                            if($sum<$dieukiendiem['tvct'])
                               $result['reason'][]='+ Doanh số tiêu dùng nhỏ hơn '.$dieukiendiem['tvct'].' điểm'; 
                            $result['success']=false;
                        }
                        break;
                    case 5:
                        if($member['title']==2) // tvtc
                             $result['success']= true;
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';                         
                            $result['success']=false;
                        }
                        break;
                    case 6:
                        if($member['title']==2) {// tvtc + co 1 thanh vien cap 1 la tvtc
                            foreach($memberslevel1 as $child){                                
                                if($child->title==2)
                                    $count++;
                            } 
                            if($count>0) // co 1 thanh vien cap 1 la tvtc
                                $result['success']= true;
                            else{
                                if($count==0)
                                    $result['reason'][]='+ Chưa có thành viên cấp 1 nào đạt thành viên tích cực'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';                                                        
                            $result['success']=false;
                        }
                        break;
                    case 7:
                        if($member['title']==2) {// tvtc + co 2 thanh vien cap 1 la tvtc
                            foreach($memberslevel1 as $child){                                
                                if($child->title==2)
                                    $count++;
                            } 
                            if($count>1) // co 2 thanh vien cap 1 la tvtc
                                $result['success']= true;
                            else{
                                if($count<2)
                                    $result['reason'][]='+ Chưa có đủ 2 thành viên cấp 1 đạt thành viên tích cực'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';                                                        
                            $result['success']=false;
                        }
                        break;
                    case 8:
                        if($member['title']==2) {// tvtc + co 3 thanh vien cap 1 la tvtc
                            foreach($memberslevel1 as $child){                                
                                if($child->title==2)
                                    $count++;
                            } 
                            if($count>2) // co 3 thanh vien cap 1 la tvtc
                                $result['success']= true;
                            else{
                                if($count<3)
                                    $result['reason'][]='+ Chưa có đủ 3 thành viên cấp 1 đạt thành viên tích cực'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';                                                        
                            $result['success']=false;
                        }
                        break;                    
                    case 9:
                        if($member['title']==2 && $member['title2']>0){ // tvtc + silver 
                            $result['success']= true;
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']==0)
                                $result['reason'][]='+ Chưa là thành viên Silver';
                            $result['success']=false;
                        }
                        break;
                    case 10:
                        if($member['title']==2 && $member['title2']>0){ // tvtc + silver + co 1 thanh vien cap 1 dat silver                          
                            foreach($memberslevel1 as $child){                                
                                if($child->title2>0)
                                    $count++;
                            }
                            if($count>0) // 1 thanh vien silver cap 1 ->
                                $result['success']= true;
                            else{
                                if($count==0)
                                    $result['reason'][]='+ Chưa có thành viên cấp 1 nào đạt silver'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']==0)
                                $result['reason'][]='+ Chưa là thành viên Silver';
                            $result['success']=false;
                        }
                        break;
                    case 11:
                        if($member['title']==2 && $member['title2']>0){ // tvtc + silver + co 2 thanh vien cap 1 dat silver                          
                            foreach($memberslevel1 as $child){                                
                                if($child->title2>0)
                                    $count++;
                            }
                            if($count>1) // 2 thanh vien silver cap 1 ->
                                $result['success']= true;
                            else{
                                if($count<2)
                                    $result['reason'][]='+ Chưa có đủ 2 thành viên cấp 1  đạt silver'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']==0)
                                $result['reason'][]='+ Chưa là thành viên Silver';
                            $result['success']=false;
                        }
                        break;
                    case 12:
                        if($member['title']==2 && $member['title2']==2){ // tvtc + gold
                            $result['success']= true;                            
                        }else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']<2)
                                $result['reason'][]='+ Chưa là thành viên Gold';
                            $result['success']=false;
                        }
                        break;
                    case 13: // tvtc + gold +  1 thanh vien cap 1 dat gold
                        if($member['title']==2 && $member['title2']==2){
                            foreach($memberslevel1 as $child){
                                if($child->title2==2)
                                    $count++;
                            }
                            if($count>0) // 1 thanh vien cap 1 dat gold
                                $result['success']= true;
                            else {
                                if($count<1)
                                    $result['reason'][]='+ Chưa có đủ 1 thành viên cấp 1 đạt gold'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']<2)
                                $result['reason'][]='+ Chưa là thành viên Gold';
                            $result['success']=false;
                        }
                        break;
                    case 14: // tvtc + gold +  2 thanh vien cap 1 dat gold
                        if($member['title']==2 && $member['title2']==2){
                            foreach($memberslevel1 as $child){
                                if($child->title2==2)
                                    $count++;
                            }
                            if($count>1) // 2 thanh vien cap 1 dat gold
                                $result['success']= true;
                            else {
                                if($count<2)
                                    $result['reason'][]='+ Chưa có đủ 2 thành viên cấp 1 đạt gold'; 
                                $result['success']=false;
                            }
                        }
                        else{
                            if($member['title']<2)
                                $result['reason'][]='+ Chưa là thành viên tích cực';
                            if($member['title2']<2)
                                $result['reason'][]='+ Chưa là thành viên Gold';
                            $result['success']=false;
                        }
                        break;           
                    default :
                        if($member['vip']>=1)
                            $result['success']= true;
                        else{
                            $result['reason'][]='+ Chưa là thành viên Vip từ 1* trở lên';
                            $result['success']=false;
                        }
                }
           
            return $result;
        }
    }
      
    
    public function getRoseOffline($level){            
        $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $check_bonus = unserialize($check_bonus); 
        if($level<11)
            return ($check_bonus['offline'][('level'.$level)]*1000) ;
        else
            return ($check_bonus['offline']['level11']*1000);
    }
        
    public function getRoseBuying($level){
        $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $check_bonus = unserialize($check_bonus); 
        if($level<11)
            return ($check_bonus['buying'][('level'.$level)]/100) ;
        else
            return ($check_bonus['buying']['level11']/100);
    }
    
    public function getRoseVip($level_vip){
        $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $check_bonus = unserialize($check_bonus);        
        return $check_bonus['level11'];
        /*
        switch($level_vip){
            case 1:
                return 0.001;
                break;
            case 1:
                return 0.002;
                break;
            case 1:
                return 0.003;
                break;
            case 1:
                return 0.004;
                break;
            case 1:
                return 0.005;
                break;
            default :0;
        }  
         * 
         */      
    }
    
    public function getRoseVipLevel(){
        $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $check_bonus = unserialize($check_bonus);        
        return $check_bonus['numberlevel'];
    }
    
    // hoa hong phat trien he thong
    public function getRoseOnline(){
        $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $check_bonus = unserialize($check_bonus);        
        return $check_bonus['online']*1000;
    }
    
    // nang cap thanh vien chinh thuc
    public function getMoneyUpdateTVCT(){
        $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $check_bonus = unserialize($check_bonus);        
        return $check_bonus['update_tvct']*1000;
    }
    
    // dieu nhan hoa hong voi so diem ?
    public function getDieuKienHoaHongDiem(){
        $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $check_bonus = unserialize($check_bonus);        
        return $check_bonus['dieukienhoahong'];
    }
    
    // hoa hong tieu dung
     public function getRoseConsuming($key){
        $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="bonus_level"')->queryScalar();
        $check_bonus = unserialize($check_bonus); 
        switch ($key){
            case 'tvkn': return ($check_bonus['consuming']['tvkn']/100);
            case 'money': return ($check_bonus['consuming']['tvct']['money']/100);
            case 'card': return ($check_bonus['consuming']['tvct']['card']/100);
        }
        
    }

    // tinh hoa hong cho member model
    public function sumRoseMember($member,$month=0,$year =0,$rose_type='all'){ 
        $month = ($month==0)?date('m'):$month;
        $year = ($year==0)?date('Y'):$year;
        $result = array();
        $levels = Yii::app()->db->createCommand('SELECT  distinct level FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level <='.($member->level+14).' order by level asc')->queryColumn();
        $level0n = Yii::app()->db->createCommand('SELECT count(*)as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level >'.($member->level+14))->queryRow();
        $arrLevel_1=$arrLevel_2=$arrLevel_3=array();
        $total_1=$total_2=$total_3=array('count'=>0,'sum'=>0,'success'=>0);
        $total_3['totalrose']=0;
        // $check_bonus = Yii::app()->db->createCommand('select value from member_options where name="check_bonus"')->queryScalar();
        foreach($levels as $key=>$value){
            $level = $value-$member->level;
            // tinh hoa hong gioi thieu gian tiep
            if($rose_type=='offline'||$rose_type=='all'){
                $count = Yii::app()->db->createCommand('select count(*) as sum from members where level='.$value.' and title >0 and lft>'.$member->lft.' and rgt<'.$member->rgt.' and month(created)='.$month.' and year(created)='.$year)->queryRow();  
                $sum = $count['sum']*$this->getRoseOffline($level);
                $arrLevel_1[$level]['level'] = $level;
                $arrLevel_1[$level]['count'] =  $count['sum'] ; 
                $arrLevel_1[$level]['sum'] =  $sum ; 
                $check=Yii::app()->tree->checkNewBonus($member->id,$level,$month,$year); 
                $arrLevel_1[$level]['success'] = $check['success'];
                if($check['success']==false)
                    $arrLevel_1[$level]['reason'] = $check['reason'];
                $total_1['count'] += $count['sum'] ; 
                $total_1['sum'] += $sum ; 
                if($arrLevel_1[$level]['success']==true)
                        $total_1['success'] += $sum;
            }
            
            // tinh hoa hong gioi thieu truc tiep
            if($rose_type=='online'||$rose_type=='all'){
                $count = Yii::app()->db->createCommand('select count(*) as sum from members where person1='.$member->name.' and title >0 and level='.$value.' and lft>'.$member->lft.' and rgt<'.$member->rgt.' and month(created)='.$month.' and year(created)='.$year)->queryRow();  
                $sum = $count['sum']*$this->getRoseOnline();
                $arrLevel_2[$level]['level'] = $level;
                $arrLevel_2[$level]['count'] =  $count['sum'] ; 
                $arrLevel_2[$level]['sum'] =  $sum ; 
                $check=Yii::app()->tree->checkNewBonus($member->id,$level,$month,$year); 
                $arrLevel_2[$level]['success'] = $check['success'];
                 if($check['success']==false)
                    $arrLevel_2[$level]['reason'] = $check['reason'];
                $total_2['count'] += $count['sum'] ; 
                $total_2['sum'] += $sum ; 
                if($arrLevel_2[$level]['success']==true)
                     $total_2['success'] += $sum;
            }
            
            // tinh hoa hong thu dong
            if($rose_type=='buying'||$rose_type=='all'){
                $memberlist= Member::model()->findAll('level=? and lft>? and rgt <?',array($value,$member->lft,$member->rgt));
                $memberlist = CHtml::listData($memberlist, 'id', 'id');
                $count = Yii::app()->db->createCommand('select count(*) as sum from members where level='.$value.' and lft>'.$member->lft.' and rgt<'.$member->rgt)->queryRow();  
                $countbuying = Yii::app()->db->createCommand('select round(sum(TongDiem),2) as sum from hoadon where member_id in(' . implode(',',$memberlist). ')'.' and month(NgayXuat)='.$month.' and year(NgayXuat)='.$year)->queryRow(); 
                $diemkhac = Yii::app()->db->createCommand("SELECT round(sum(diem),2)as sum from diemkhac where month=$month and year=$year and member_id in(" . implode(',',$memberlist). ")")->queryScalar();  
                $sum = ($countbuying['sum'] + $diemkhac)*$this->getRoseBuying($level)*1000; // echo $countbuying['sum'].' : '.$this->getRoseBuying($level).' : '.$sum.' : mang member '.implode(',',$memberlist).'<br>';
                $arrLevel_3[$level]['level'] = $level;
                $arrLevel_3[$level]['count'] =  $count['sum'] ; 
                $arrLevel_3[$level]['sum'] = $countbuying['sum'] + $diemkhac ; 
                $arrLevel_3[$level]['rose']=$this->getRoseBuying($level).'%';
                $arrLevel_3[$level]['totalrose']=$sum;                
                $check=Yii::app()->tree->checkNewBonus($member->id,$level,$month,$year,'tvct'); 
                $arrLevel_3[$level]['success'] =$check['success'];
                if($check['success']==false)
                    $arrLevel_3[$level]['reason'] = $check['reason'];
                $total_3['count'] += $count['sum'] ; 
                $total_3['sum'] += $countbuying['sum'] + $diemkhac ; // tong diem
                $total_3['totalrose'] += $sum; //tong tien cua diem*%hoa hong
                if($arrLevel_3[$level]['success']==true)
                     $total_3['success'] += $sum;
            }
        } 
        
        /*
        if($level0n['sum']>0){ // co thanh vien co cap 15 tro len
            $level = '15 - n'; // 15 - n
            // khong tinh hoa hong ho tro he thong cap 11->n
            /*
            if($rose_type=='offline'||$rose_type=='all'){
                $count = $level0n;  
                $sum = $count['sum']*$this->getRoseOffline(11); // level >10 dc 2k 1 nguoi
                $arrLevel_1[$level]['level'] = $level;
                $arrLevel_1[$level]['count'] =  $count['sum'] ; 
                $arrLevel_1[$level]['sum'] =  $sum ; 
                $check=Yii::app()->tree->checkNewBonus($member->id,11);  
                $arrLevel_1[$level]['success'] = $check['success'];
                if($check['success']==false)
                    $arrLevel_1[$level]['reason'] = $check['reason'];
                $total_1['count'] += $count['sum'] ; 
                $total_1['sum'] += $sum ; 
                if($arrLevel_1[$level]['success']==true)
                        $total_1['success'] += $sum;
            }
            
            
            // tinh hoa hong gioi thieu truc tiep
            if($rose_type=='online'||$rose_type=='all'){
                $count = Yii::app()->db->createCommand('select count(*) as sum from members where person1='.$member->name.' and title >0 and level >'.($member->level+14).' and lft>'.$member->lft.' and rgt<'.$member->rgt.' and month(created)='.$month.' and year(created)='.$year)->queryRow();  
                $sum = $count['sum']*$this->getRoseOnline();
                $arrLevel_2[$level]['level'] = $level;
                $arrLevel_2[$level]['count'] =  $count['sum'] ; 
                $arrLevel_2[$level]['sum'] =  $sum ; 
                $check=Yii::app()->tree->checkNewBonus($member->id,11,$month,$year,'tvct'); 
                $arrLevel_2[$level]['success'] = $check['success'];
                 if($check['success']==false)
                    $arrLevel_2[$level]['reason'] = $check['reason'];
                $total_2['count'] += $count['sum'] ; 
                $total_2['sum'] += $sum ; 
                if($arrLevel_2[$level]['success']==true)
                     $total_2['success'] += $sum;
            }
            
            // tinh hoa hong thu dong
            if($rose_type=='buying'||$rose_type=='all'){
                // tinh xem thanh vien vip nay duoc huong hoa hong them cua bao nhieu cap nua
                $numberLevel = $this->getRoseVipLevel()*$member->vip;
                $memberlist= Member::model()->findAll('level>? and lft>? and rgt <?',array(($member->level+$numberLevel),$member->lft,$member->rgt));
                $memberlist = CHtml::listData($memberlist, 'id', 'id');
                $count = $level0n;  
                $countbuying = Yii::app()->db->createCommand('select round(sum(profit),0) as sum from member_buyings where member_id in(' . implode(',',$memberlist). ')'.' and month(created)='.$month.' and year(created)='.$year)->queryRow();  
                $sum = $countbuying['sum']*$this->getRoseBuying(12)*1000; // echo $countbuying['sum'].' : '.$this->getRoseBuying($level).' : '.$sum.' : mang member '.implode(',',$memberlist).'<br>';
                $arrLevel_3[$level]['level'] = $level;
                $arrLevel_3[$level]['count'] =  $count['sum'] ; 
                $arrLevel_3[$level]['sum'] = $countbuying['sum'] ; 
                $arrLevel_3[$level]['rose']=$this->getRoseBuying($level).'%';
                $arrLevel_3[$level]['totalrose']=$sum;
                $check=Yii::app()->tree->checkNewBonus($member->id,11,$month,$year); 
                $arrLevel_3[$level]['success'] =$check['success'];
                if($check['success']==false)
                    $arrLevel_3[$level]['reason'] = $check['reason'];
                $total_3['count'] += $count['sum'] ; 
                $total_3['sum'] += $countbuying['sum'] ; 
                $total_3['totalrose'] += $sum; 
                if($arrLevel_3[$level]['success']==true)
                     $total_3['success'] += $sum;
            }
        } 
         */
        if($rose_type=='offline'||$rose_type=='all'){
            $result['offline']['level']=$arrLevel_1;
            $result['offline']['total']=$total_1;
        }
        
        if($rose_type=='online'||$rose_type=='all'){
            $result['online']['level']=$arrLevel_2;
            $result['online']['total']=$total_2;
        }
        
        if($rose_type=='buying'||$rose_type=='all'){
            $result['buying']['level']=$arrLevel_3;
            $result['buying']['total']=$total_3;
        }
        $result['tax']= Yii::app()->db->createCommand('select value from member_options where name="tax"')->queryScalar();                
        $result['salary'] = Yii::app()->db->createCommand('select value from member_options where name="salary"')->queryScalar();                
        $result['sumProfit'] = $this->sumProfit($member->id,$month,$year); // tinh tong doanh thu ( tong diem )
        // tinh hoa hong tieu dung 
        $result['hoahongtieudung'] = Yii::app()->db->createCommand("SELECT round(sum(TongHHTieuDung),2)as sum from hoadon where month(NgayXuat)=$month and year(NgayXuat)=$year and member_id=$member->id")->queryScalar();              
        
        return $result;
    }
    
    public function makeRoseMonth($member,$status,$month=0,$year=0){
        $month = ($month==0)?date('m'):$month;
        $year = ($year==0)?date('Y'):$year;
        $data=$this->sumRoseMember($member,$month,$year);
        $rose= array();
        $rose['member_id']=$member->id;
        $rose['totalrose']=  serialize($data);
        $rose['status']=$status;
        $rose['created']=  date('Y-m-d');
        $rose['modified']= date('Y-m-d');
        
        $rosemonth= new RoseMonth();
        $rosemonth->attributes=$rose; 
        if($rosemonth->save())
            return true;
        else
            return false;        
    }
    // tra ve cap do thanh vien
    public function getTitleLevelMember($member){ 
        if($member->title2>0)
            switch ($member->title2){
            case 1: return 'Silver'; break;
            case 2: return 'Gold'; break;
            }
        else{
            switch ($member->title){
                    case 2: return 'Tích cực'; break;
                    case 1: return 'Chính thức'; break;
                    default : return 'Kết nối';
            }
        }
    }
    // tra ve danh hieu thanh vien
    public function getVipMember($member){        
        if($member->vip>0)
            return 'VIP '.$member->vip.' *';
        else return '';
    }
    
    // thong ke
    public function  thongke($member){ 
        $result = array();
        $levels = Yii::app()->db->createCommand('SELECT  distinct level FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level<='.($member->level+20).' order by level asc')->queryColumn();
        $datalevel = array();
        $datatotal = array('tvkn'=>0,'tvct'=>0,'silver'=>0,'gold'=>0,'vip1'=>0,'vip2'=>0,'vip3'=>0,'vip4'=>0,'vip5'=>0,'total'=>0);
         foreach($levels as $key=>$value){
            $level = $value-$member->level;
            $datalevel[$level]['level']=$level;
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and title=0 order by level asc')->queryRow();
            $datalevel[$level]['tvkn']=$total['sum'];
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and title>0 order by level asc')->queryRow();
            $datalevel[$level]['tvct']=$total['sum'];
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and title2=1 order by level asc')->queryRow();
            $datalevel[$level]['silver']=$total['sum'];
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and title2=2 order by level asc')->queryRow();
            $datalevel[$level]['gold']=$total['sum'];
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and vip=1 order by level asc')->queryRow();
            $datalevel[$level]['vip1']=$total['sum'];
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and vip=2 order by level asc')->queryRow();
            $datalevel[$level]['vip2']=$total['sum'];
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and vip=3 order by level asc')->queryRow();
            $datalevel[$level]['vip3']=$total['sum'];
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and vip=4 order by level asc')->queryRow();
            $datalevel[$level]['vip4']=$total['sum'];
            $total = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE lft>'.$member->lft.' and rgt <'.$member->rgt.' and level='.$value.' and vip=5 order by level asc')->queryRow();
            $datalevel[$level]['vip5']=$total['sum'];
            $datalevel[$level]['total']=$datalevel[$level]['tvkn']+$datalevel[$level]['tvct']+$datalevel[$level]['silver']+$datalevel[$level]['gold']+$datalevel[$level]['vip1']+$datalevel[$level]['vip2']+ $datalevel[$level]['vip3']+$datalevel[$level]['vip4']+$datalevel[$level]['vip5'];
            $datatotal['tvkn'] += $datalevel[$level]['tvkn'];
            $datatotal['tvct'] += $datalevel[$level]['tvct'];
            $datatotal['silver'] += $datalevel[$level]['silver'];
            $datatotal['gold'] += $datalevel[$level]['gold'];
            $datatotal['vip1'] += $datalevel[$level]['vip1'];
            $datatotal['vip2'] += $datalevel[$level]['vip2'];
            $datatotal['vip3'] += $datalevel[$level]['vip3'];
            $datatotal['vip4'] += $datalevel[$level]['vip4'];
            $datatotal['vip5'] += $datalevel[$level]['vip5'];
            $datatotal['total'] += $datalevel[$level]['total'];
         }
         $result['levels']=$datalevel;
         $result['totals']=$datatotal;   
         return $result;
    }
    
    // tinh so tien hoa hong can thanh toan vo the thanh vien, va tien thue neu co
    public function getRoseMonthCard($rose=array(),$card=array()){
        $buying=$rose['buying']['total']['success'];
        $offline=$rose['offline']['total']['success'];
        $online=$rose['online']['total']['success'];
        $tax=  $rose['tax'];
        $total=$buying+$offline+$online; 
        $moneyTax = ($total>=$rose['salary'] && $card->no_tax==1)?$total/100*$tax:0;
        $realTotal =$total-$moneyTax; 
        return array('moneyTax'=>$moneyTax,'realTotal'=>$realTotal);
    }
    
    // tinh tien hoa hong cua cac thang bao luu
    public function getRoseMonthCardLastMonth($rose=array(),$card=array()){       
        $offline=$rose['offline']['total']['success'];
        $online=$rose['online']['total']['success'];
        $tax=  $rose['tax'];
        $total=$offline+$online; 
        $moneyTax = ($total>=$rose['salary'] && $card->no_tax==1)?$total/100*$tax:0;
        $realTotal =$total-$moneyTax; 
        return array('moneyTax'=>$moneyTax,'realTotal'=>$realTotal);
    }
    
    // tra ve tong so thanh vien cac danh hieu
    public function  getListMemberTotalMoney(){
       $members = Member::model()->findAll();
       foreach ($members as $member){
           $this->setMemberTitle($member->id);
           $this->setVip($member->id);
       }
       $result['count_tvkn'] = Yii::app()->db->createCommand('select count(*) from members where title=0')->queryScalar();
       $result['count_tvct'] = Yii::app()->db->createCommand('select count(*) from members where title>0')->queryScalar();
       $result['count_tvtc'] = Yii::app()->db->createCommand('select count(*) from members where title=2')->queryScalar();
       $result['count_tvsilver'] = Yii::app()->db->createCommand('select count(*) from members where title2=1')->queryScalar();
       $result['count_tvgold'] = Yii::app()->db->createCommand('select count(*) from members where title2=2')->queryScalar();
       $result['count_tvvip1'] = Yii::app()->db->createCommand('select count(*) from members where vip=1')->queryScalar();
       $result['count_tvvip2'] = Yii::app()->db->createCommand('select count(*) from members where vip=2')->queryScalar();
       $result['count_tvvip3'] = Yii::app()->db->createCommand('select count(*) from members where vip=3')->queryScalar();
       $result['count_tvvip4'] = Yii::app()->db->createCommand('select count(*) from members where vip=4')->queryScalar();
       $result['count_tvvip5'] = Yii::app()->db->createCommand('select count(*) from members where vip=5')->queryScalar();
       
       return $result;
    }
    
    // xay dung ham de quy tu tinh lai cac thuoc tinh level, left, right, khi thay the
    public function updateNodes($id1,$id2){
        $model = new Nested_Set(Yii::app()->db);
        $subnode1 = Member::model()->findAll('parents="'.$id1.'"');
        $subnode2 = Member::model()->findAll('parents="'.$id2.'"');
        foreach($subnode1 as $child){            
            $model->updateNode(array('modified'=>date('Y-m-d')),$child->id,$id2);           
        }
        foreach($subnode2 as $child){            
            $model->updateNode(array('modified'=>date('Y-m-d')),$child->id,$id1);            
        }
    }
    
}
?>
