<?php
Yii::import("application.library.Nested_Set");
class DefaultController extends Controller
{
    public $layout='home';
    public $member;
    public $sale;


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
        
    public function actionIndex()
	{   
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            $this->redirect(getURL().'member/default/rose/'.$member->id);
	}
        
        // cay thanh vien
        public function actionTreeMember($id=null){
            if(isset($id))
                $member = Member::model()->findByPk($id);
            else
                $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            
            $this->member=$member;
            $person =Member::model()->find('name="'.$member->person1.'"');
            $tvkn = Yii::app()->db->createCommand('SELECT count(*) as total FROM `members` WHERE status=0 and lft>'.$member->lft.' and rgt <'.$member->rgt)->queryRow();
            $tvct = Yii::app()->db->createCommand('SELECT count(*) as total FROM `members` WHERE status=1 and lft>'.$member->lft.' and rgt <'.$member->rgt)->queryRow();
            $tvkn2 = Yii::app()->db->createCommand('SELECT count(*) as total FROM `members` WHERE status=0 and lft>'.$person->lft.' and rgt <'.$person->rgt)->queryRow();
            $tvct2 = Yii::app()->db->createCommand('SELECT count(*) as total FROM `members` WHERE status=1 and lft>'.$person->lft.' and rgt <'.$person->rgt)->queryRow();
            $levels1 = Yii::app()->db->createCommand('SELECT  distinct level FROM `members` WHERE level <='.($member->level+2).' and lft>'.$member->lft.' and rgt <'.$member->rgt)->queryAll();
            $levels2 = Yii::app()->db->createCommand('SELECT  distinct level FROM `members` WHERE level <='.($person->level+2).' and lft>'.$person->lft.' and rgt <'.$person->rgt)->queryAll();            
            $total71 = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE level <='.($member->level+10).' and lft>'.$member->lft.' and rgt <'.$member->rgt)->queryRow();
            $total72 = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE level <='.($person->level+10).' and lft>'.$person->lft.' and rgt <'.$person->rgt)->queryRow();            
            $tree = Member::model()->getTreeMember('id='.$member->id); 
            $thongke= Yii::app()->tree->thongke($member); 
            $this->render('tree_member',array('tree'=>$tree,'levels1'=>$levels1,'levels2'=>$levels2,'member'=>$member,'person'=>$person,'tvkn'=>$tvkn,'tvct'=>$tvct,'tvkn2'=>$tvkn2,'tvct2'=>$tvct2,'total71'=>$total71,'total72'=>$total72,'thongke'=>$thongke));
        }

        // thong tin thanh vien
        public function actionMemberInfo(){
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            $this->member=$member;
            $this->performAjaxValidation($member);   
            if(isset($_POST['Member']))
            {
               if($_FILES['Member']['error']['avatar']!=4){
                    $file=CUploadedFile::getInstance($member,'avatar'); // lay thong tin file upload trong model va tra ve ten file                                         
                    $member->avatar='uploadfile/avatar/'.$file;                    
                    if($member->save()){
                        $file->saveAs($member->avatar); 
                        $this->redirect(getURL().'member');
                    }
                }
            }
            $this->render('memberinfo',array('member'=>$member));
        }
        
        // danh sach thasnh vien gioi thieu truc tiep
        public function actionGetListMemberSubOnline(){
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            $this->member=$member; 
            $listmember = Member::model()->findAll('person1 ="'.$member->name.'"');
            $this->render('list_thanh_vien_con_truc_tiep',array('listmember'=>$listmember,'member'=>$member));
        }

        protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='frm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionRose($id){
           // echo Yii::app()->tree->sumProfit(141,date('m'),date('Y'));
           //echo Yii::app()->tree->sumRose(140,1,'gtgt',8,2012);
           // die;            
            $member = Member::model()->findByPk($id);
            $data = Yii::app()->tree->sumRoseMember($member); // pr($data); die;
            $this->render('rose',array('member'=>$member,'data'=>$data));
        }
        
        public function actionUpdateTVCT(){
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            $money=Yii::app()->tree->getMoneyUpdateTVCT();
            $this->member=$member;
            if(isset($_POST['update'])){
            $account = CardAccountNoCheck::model()->find('member_id="'.$member->id.'"');
            if(($account->money-50000)<$money)
                $this->redirect(getURL().'site/message/80');// thong bao tai khoan ko du tien
            else {
                $account->money -=$money;
                $account->save();
                Yii::app()->db->createCommand()->insert('update_money', array('numberaccount'=>$account->numberaccount,'money'=>$money,'status'=>2,'created'=>date('Y-m-d H:i:s'),'information'=>'Thanh viên tự nâng cập tài khoản lên thành viên chính thức','user_id'=>0));                        
            }
            if(Yii::app()->db->createCommand()->update('members',array('title'=>1),'id='.$member->id))
                $this->redirect(getURL().'site/message/7');// nang cap thanh cong
            }
            $this->render('updatetvct',array('money'=>$money));
        }
        
        public function actionRoseOffline($id){
            $member = Member::model()->findByPk($id);
            $data = Yii::app()->tree->sumRoseMember($member,0,0,'offline');
            $arrLevel = $data['offline']['level'];
            $total =  $data['offline']['total'];
            $this->render('rose_offline',array('member'=>$member,'arrLevel'=>$arrLevel,'total'=>$total));
        }
        
        public function actionRoseOnline($id){
            $member = Member::model()->findByPk($id);
            $data = Yii::app()->tree->sumRoseMember($member,0,0,'online');
            $arrLevel = $data['online']['level'];
            $total =  $data['online']['total'];
            $this->render('rose_online',array('member'=>$member,'arrLevel'=>$arrLevel,'total'=>$total));
        }
        
        public function actionRoseBuying($id){
            $member = Member::model()->findByPk($id);
            $data = Yii::app()->tree->sumRoseMember($member,0,0,'buying');
            $arrLevel = $data['buying']['level'];
            $total =  $data['buying']['total'];
            $this->render('rose_buying',array('member'=>$member,'arrLevel'=>$arrLevel,'total'=>$total));
        }
        
        // chi tiet loi nhuan tieu dung
        public function actionDetailBuying(){
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            $this->member=$member;
            $month = isset($_POST['month'])?$_POST['month']:date('m');
            $year = isset($_POST['year'])?$_POST['year']:date('Y');
            $productBuying= MemberBuying::model()->findAll('member_id=? and month(created)=? and year(created)=?',array($member->id,$month,$year));            
            $this->render('detail_buying',array('member'=>$member,'productBuying'=>$productBuying,'month'=>$month,'year'=>$year));
        }
        
        // lich su hoa hong
        
        public function actionHistory(){
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            $this->member=$member;            
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
            $condition = 'member_id='.$member->id;
            $condition .= ' and month="'.$month.'" and year="'.$year.'" and status="success"';
            $condition .= ' order by created desc';
            $rosemonths = RoseMonth::model()->findAll($condition);
            $this->render('history',array('rosemonths'=>$rosemonths,'member'=>$member,'month'=>$month,'year'=>$year));
        }
        
        // LICH SU HOA HONG CHI TIET
        public function actionDetailHistory(){
            $member_id=$_GET['member'];
            $member = Member::model()->findByPk($member_id);
            $this->member=$member;
            $month=$_GET['month'];
            $year=$_GET['year'];
            $rosemonth=  RoseMonth::model()->find('member_id=? and month=? and year=?',array($member_id,$month,$year));
            $this->render('detailhistory',array('rosemonth'=>$rosemonth,'member'=>$member,'month'=>$month,'year'=>$year));
        }


        public function actionSearchMember(){
            // chi duoc tim kiem cac thanh vien con trong cay cua minh
            $member='';
            $member_root = Member::model()->findByPk(Yii::app()->session['member']['id']);
            if(isset($_POST['member_name'])){
                $member= Member::model()->find('name=? and lft > ? and rgt < ?',array($_POST['member_name'],$member_root->lft,$member_root->rgt)); 
            }
            $this->render('search_member',array('member'=>$member));
        }
        
        
        // tinh hoa hong cuoi moi thang luu vao bang rose month
        public function actionMakeRoseMonth(){
            $memberlist=  Member::model()->findAll('id <> 1'); 
            foreach($memberlist as $member){
                $data = Yii::app()->tree->makeRoseMonth($member,'success');
            }            
        }
        
        // chay ajax lay thong tinh thanh vien khi click vao cay
        public function actionGetSidebarRight(){
            $member_id=$_POST['member'];
            $member =  Member::model()->findByPk($member_id);
            $person =Member::model()->find('name="'.$member->person1.'"');
            $tvkn = Yii::app()->db->createCommand('SELECT count(*) as total FROM `members` WHERE status=0 and lft>'.$member->lft.' and rgt <'.$member->rgt)->queryRow();
            $tvct = Yii::app()->db->createCommand('SELECT count(*) as total FROM `members` WHERE status=1 and lft>'.$member->lft.' and rgt <'.$member->rgt)->queryRow();
            $tvkn2 = Yii::app()->db->createCommand('SELECT count(*) as total FROM `members` WHERE status=0 and lft>'.$person->lft.' and rgt <'.$person->rgt)->queryRow();
            $tvct2 = Yii::app()->db->createCommand('SELECT count(*) as total FROM `members` WHERE status=1 and lft>'.$person->lft.' and rgt <'.$person->rgt)->queryRow();
            $levels1 = Yii::app()->db->createCommand('SELECT  distinct level FROM `members` WHERE level <='.($member->level+2).' and lft>'.$member->lft.' and rgt <'.$member->rgt)->queryAll();
            $levels2 = Yii::app()->db->createCommand('SELECT  distinct level FROM `members` WHERE level <='.($person->level+2).' and lft>'.$person->lft.' and rgt <'.$person->rgt)->queryAll();            
            $total71 = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE level <='.($member->level+10).' and lft>'.$member->lft.' and rgt <'.$member->rgt)->queryRow();
            $total72 = Yii::app()->db->createCommand('SELECT  count(*) as sum FROM `members` WHERE level <='.($person->level+10).' and lft>'.$person->lft.' and rgt <'.$person->rgt)->queryRow();            
            $tree = Member::model()->getTreeMember('id='.$member->id); 
            $this->renderPartial('sidebar_rigth',array('levels1'=>$levels1,'levels2'=>$levels2,'member'=>$member,'person'=>$person,'tvkn'=>$tvkn,'tvct'=>$tvct,'tvkn2'=>$tvkn2,'tvct2'=>$tvct2,'total71'=>$total71,'total72'=>$total72));
            
        }
        
        // thay the thanh vien
        public function actionChangeMember($id){
            if(isset($_POST['m_name'])){
                $node=new Nested_Set(Yii::app()->db);                
                $member1= $node->getNodeInfo($id);
                $member2= Member::model()->find('name='.$_POST['m_name']);
                $submember2 = Member::model()->findAll('parents = "'.$member2->id.'"');
                if(!empty($submember2))
                    $this->redirect (getURL ().'site/message/13');
                $id2 = $member2->id; 
                if(!empty($member2)){
                    $member2=$node->getNodeInfo($member2->id);
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
                    $this->redirect(getURL().'site/message/8');// nang cap thanh cong
                }
                else
                {
                    // chuyen huong thong bao loi
                     $this->redirect(getURL().'site/message/9');// nang cap thanh cong
                }
                
            }
            $this->render('change_member');
        }
        public function actionMakeCard(){
            $members = Member::model()->findAll('numbercard=""');
            $node = new Nested_Set(Yii::app()->db);
            foreach ($members as $member){
                $numberCard=date('dmY', strtotime($member->created));                    
                $numberCard .= substr($member->name, 0,4);
                $idmax=  Yii::app()->db->createCommand('select max(id) from members')->queryScalar();
                switch(strlen($idmax)){
                case 1:
                    for($i=0;$i<3;$i++)
                            $numberCard .= rand (0, 9);
                    break;
                case 2:
                    for($i=0;$i<2;$i++)
                            $numberCard .= rand (0, 9);
                    break;
                case 3:                  
                    $numberCard .= rand (0, 9);
                    break;
                }
                if(strlen($idmax)>4)
                    $numberCard = substr ($numberCard, 0, 16-strlen($idmax));
                $numberCard .= $idmax;
                $data['numbercard']=$numberCard;
                $node->updateNode($data, $member->id);
            }
        }
        
        public function actionUpdateMemberInfo(){
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
             $cities = City::model()->findAll("status = 1 order by stt asc");
            $arr_city = CHtml::listData($cities, 'id', 'name');
            $this->performAjaxValidation($member); 
            if(isset($_POST['Member'])){ 
                $data = $_POST['Member'];
                $data['birthday'] =$_POST['birth_year'].'-'.$_POST['birth_month'].'-'.$_POST['birth_day'];
                $data['date_create'] =$_POST['year_create'].'-'.$_POST['month_create'].'-'.$_POST['day_create'];                
                unset($data['captcha']);
                
                if($_FILES['Member']['error']['avatar']!=4){
                    $file=CUploadedFile::getInstance($member,'avatar'); // lay thong tin file upload trong model va tra ve ten file                                         
                    $data['avatar']='uploadfile/avatar/'.$file; 
                }
                if(Yii::app()->db->createCommand()->update('members', $data, 'id='.$member->id)){
                    if($_FILES['Member']['error']['avatar']!=4)
                         $file->saveAs($data['avatar']); 
                    $this->redirect ('index');
                }
            }
            $this->render('update_member_info',array('member'=>$member,'cities'=>$arr_city));
        }
        
        public function actionDonHang(){
            $criteria = new CDbCriteria(); // tao dieu kien 
            $criteria->order="id desc";
            $criteria->condition='member_id="'.Yii::app()->session['member']['id'].'"';
            $count = MemberBuying::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=5; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = MemberBuying::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->render("don_hang",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
        }
        
        public function actionDetailDonHang($id=null){
            $donhang = MemberBuying::model()->findByPk($id);
            $this->renderPartial('detail_don_hang',array('donhang'=>$donhang));
        }
        
        public function actionChange(){
            $node = new Nested_Set(Yii::app()->db);
            $node->updateNode(array(), 327, 315);
            echo 'thanh cong'; die;
        }

        public function beforeAction($action) {
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            $this->member=$member;
            $sale=  Help::model()->find('status=1 order by id desc');
            $this->sale=$sale;
            return checkLoginMember($this);
        }
}