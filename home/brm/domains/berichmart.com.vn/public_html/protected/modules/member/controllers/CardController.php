<?php
class CardController extends CController{
    public $layout='account';
    public $title;
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
        
    public function actionIndex(){
        $this->title='Nạp thẻ';
        $result=  Yii::app()->db->createCommand("SELECT * FROM vdc_category")->queryAll();
        $this->render('index',array('cats'=>$result));
    }
    
     public function actionDownload(){ 
        $this->title='Tải thẻ';
        $result=  Yii::app()->db->createCommand("SELECT * FROM vdc_category")->queryAll();
        $this->render('download',array('cats'=>$result));
    }
    
    // tai ve ma the
    public function actionGetTag(){
        include('class/nusoap.php');
        $session = getSession();
        $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
        $u ='esccard_vn';
        $pas = '123456';
        $key_u ="hQFc+3BHRTDqy1KoJOBgf51wrU2fyiZn";
 
	if($_POST['product']>0 && $_POST['qty']>0)	{
          // tinh gia trietkhau
         $product = VDCProduct::model()->find('id="'.$_POST['product'].'"');
         $provider = VDCProvider::model()->find('id="'.$product->provider_id.'"');
         $price =$product->price;
         /* 
         $packagebonus = PackageBonus::model()->find('name="'.$provider->name.'" and package_id="'.$member->package_id.'"');         
         $tien_bonus =$packagebonus->value*$price/100;
         $pricelevel1 = 0; $pricelevel2=0;
         if($member->level==2){
             $pricelevel1 = 0.3*$tien_bonus;
             $pricelevel2 = 0.7*$tien_bonus;
             $price_off = $price - $pricelevel2; 
         }
         else{
            $price_off = $price-$tien_bonus;
         } 
          */  
         
         // check co du tien mua the ko
         $cardaccount= CardAccountNoCheck::model()->find('member_id="'.$member->id.'"');
         if($cardaccount->password_card !=  addCode($_POST['passcard'], 3))
                $this->redirect(getURL().'site/message/85');// chua co tài khoan the 
         if($cardaccount->money<($price*$_POST['qty']))
             $this->redirect(getURL().'site/message/77');// ko du tien mua the
         $cardmember= CardMember::model()->find('member_id="'.$member->id.'"');
         if(empty($cardmember))
             $this->redirect(getURL().'site/message/79');// chua co tài khoan the
         
         if($cardmember->money<($price*$_POST['qty']))
             $this->redirect(getURL().'site/message/77');// ko du tien mua the
         
         $WSDL = "http://demo.buyme.vn:88/api/topup.php?wsdl";
         $client = new nusoap_client($WSDL, true);
         $client->soap_defencoding = 'UTF-8';
         $result = $client->call('download_softpin', array(
         'user_name'=>$u,
         'password'=>$pas,
         'product_id'=>$_POST['product'],
         'qty'=>$_POST['qty'],
		 ));             
		  if($result['error']==0){                      
                      // tao giao dich
                      $transaction = new Transaction();
                      $transaction->member_id = $member->id;
                      $transaction->product_id = $_POST['product'];
                      $transaction->qty = $_POST['qty'];
                     // $transaction->price_off=$price_off;
                      $transaction->created = date('Y-m-d H:i:s');
                      $transaction->status=1;
                      //$transaction->money_rose= $pricelevel1;
                     // $transaction->downloaded=0;
                      $transaction->save();
                      $transaction_id=  Yii::app()->db->createCommand('select max(id) from transactions where member_id=? and product_id=? and created >=?')->queryScalar(array($member->id,$_POST['product'],date('Y-m-d').' 00:00:00'));                                            
                       
                       $session['cards'] = $result['softpin'];
                       $session['card_product'] = $_POST['product'];
                        foreach($result['softpin'] as $k=>$itm){				  
                                $vdc = new VDCDownloadSoftpin();
                                $itm['pin_code'] = decrypt2($itm['pin_code'], $key_u);
                                $vdc->attributes=$itm;
                                $vdc->member_id=$member->id;
                                $vdc->transaction_id=$transaction_id;
                                $vdc->product_id = $_POST['product'];
                                $vdc->created=date('Y-m-d H:i:s'); 
                                $vdc->save();
                        }
                        // tru tien trong tai khoan thanh vien 
                         $cardmember->money -= $price*$_POST['qty'];
                         $cardmember->save();
                        /*
                         // cong tien cho thanh vien cap 1
                         if($member->level==2){
                            $parent_id = $member->parent_id;
                            $cardParent = CardAccountNoCheck::model()->find('member_id="'.$parent_id.'"');
                            $cardParent->money +=$pricelevel1*$_POST['qty'];
                            $cardParent->save();
                            // luu lich su thanh vien cap 2 dc nhan tien
                            $history = new History();
                            $history->created = date('Y-m-d H:i:s');
                            $history->money= $pricelevel1*$_POST['qty'];
                            $history->transaction_id=$transaction_id;
                            $history->member_get = $parent_id;
                            $history->information="Hoa hồng được hưởng";
                            $history->save();
                         }  
                         * 
                         */                           
			$this->redirect(array('message'));
		  }
                  else { // pr($result);
                    $session['result']=$result;
                    $this->redirect(array('error'));
                  }
	}else{
		echo 'Có lỗi xảy ra. Xin vui lòng thử lại';
	}

    }
    
    public function actionAgency(){
        $this->title='Đại lý';
        $packages = Package::model()->findAll('1=1 order by value asc');
        $this->render('agency',array('packages'=>$packages));
    }
    
    public function actionHoTro(){
        $this->title='Hỗ trợ';
        $news = News::model()->find('category_id=2');
        $this->render('ho_tro',array('news'=>$news)); 
    }
    
    //tao dai ly
    public function actionCreateAgency(){
        $this->title='Tạo đại lý';
        $Member = new Member(); 
        $parent = Member::model()->findByPk(Yii::app()->session['member']['id']);
        // Uncomment the following line if AJAX validation is needed
        if($parent->level==1){ 
            $this->performAjaxValidation($Member);
            if(isset($_POST['Member'])){ //pr($_POST); die;
                $data = $_POST['Member']; 
                $packageselect = Package::model()->findByPk($data['package_id']);                
                if($parent->CardAccount['money']<$packageselect->value){
                    $this->redirect(getURL().'site/message/78');
                }
                $data['status']=1;
                $data['image']=  getImageURL($data['image']);
                $data['email']=  encrypt2($data['email']);
                $data['code']=  encrypt2($data['code']);
                $data['password']=  encrypt2($data['password']);
                $data['repassword']=  encrypt2($data['repassword']);
                $data['username']=  encrypt2($data['username']);
                $data['reusername']=  encrypt2($data['reusername']);
                $data['created']=date('Y-m-d');
                $data['modified']=date('Y-m-d');            
                $data['parent_id']=$parent->id;
                $data['level']=$parent->level+1;
                $file ='';
                if($_FILES['Member']['error']['image']!=4){
                        $file=CUploadedFile::getInstance($Member,'image'); // lay thong tin file upload trong model va tra ve ten file                                         
                        $Member->image='tiny/uploaded/'.$file; 
                    }
                $Member->attributes = $data;                  
                if($Member->save()){
                    if(!empty($file))
                        $file->saveAs($Member->image); 
                    // tao tai khoan
                    $mem= Member::model()->find('email=? and code=?',array($data['email'],$data['code']));
                    if($mem){
                        $cardaccount = new CardAccountNoCheck();                    
                        $money = $packageselect->value;
                        $money= str_replace(',', '', $money); 
                        $datacard['created']=  date('Y-m-d');
                        $datacard['modified']=  date('Y-m-d');
                        $datacard['member_id']= $mem->id;
                        $datacard['money'] = $money;  
                        $datacard['status']=1;
                        // tao so tai khoan gom 12 so
                        $mem->code = decrypt2($mem->code);
                        $datacard['numberaccount']=  date('Ymd'). substr($mem->code,2,4);           
                        do{
                            $exists = CardAccount::model()->find('numberaccount="'.$datacard['numberaccount'].'"');
                            if(!empty($exists))
                                $datacard['numberaccount']++;
                        }while(!empty($exists));
                        $cardaccount->attributes=$datacard;
                        if($cardaccount->save()){
                            // tru tien tai khoan nguoi tao
                            $parentcard = $parent->CardAccount;
                            $parentcard->money -= $money;
                            $parentcard->save();
                            // luu lich su
                            $transfer = new Transfer();
                            $transfer->created=date('Y-m-d H:i:s');
                            $transfer->member_send=$parent->id;
                            $transfer->member_get = $mem->id;
                            $transfer->money=  $money;
                            $transfer->information='Tạo thành viên mới';
                            $transfer->save();                        
                            $this->redirect(getURL().'site/message/80');
                        }
                    }                
                }
            }      
            $package = Package::model()->findAll();
            $package=  CHtml::listData($package, 'id', 'value');        
            $this->render("create_agency",array('Member'=>$Member,'package'=>$package)); 
        }
    }
    
    // lay ve thong tin sp sp products va chen vao database
    public function actionGetProductInfo($id){
        include('class/nusoap.php');
        $u ='esccard_vn';
        $pas = '123456';
        $product_id = $id;
        $key_u ="hQFc+3BHRTDqy1KoJOBgf51wrU2fyiZn";
        $WSDL = "http://demo.buyme.vn:88/api/topup.php?wsdl";
        $client = new nusoap_client($WSDL, true);
        $client->soap_defencoding = 'UTF-8';        
	$result = $client->call('get_product_info', array(
         'user_name'=>$u,
         'password'=>$pas,
         'product_id'=>$product_id,
        ));
        pr($result); die;
        // chen vao database
    }
    
    public function actionMessage(){
        $session = getSession();
        $pro = VDCProduct::model()->find('id="'.$session['card_product'].'"'); 
        $this->render('message',array('cards'=>$session['cards'],'product'=>$pro));
    }
    
    public function actionError(){
        $session = getSession();
        $this->render('error',array('result'=>$session['result']));
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
            $member = Member::model()->findByPk(Yii::app()->session['member']['id']);
            $this->member=$member;
            $sale=  Help::model()->find('status=1 order by id desc');
            $this->sale=$sale;
            return checkLoginMember($this);
        }
}
?>
