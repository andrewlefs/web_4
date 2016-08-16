<?php

class ProductsController extends Controller
{
    public $layout = 'list';
    public $listCat;
    public $cat;
    public $product;
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
            $catlist = Category::model()->findAll('parent_id = 252 order by t.order asc');
            $this->listCat = $catlist;
            $this->render('index');
	}
    public function actionView($id = null)
	{
            $product = Product::model()->findByPk($id);
            $product->view++;
            $product->save();
            $this->product=$product; 
            $this->cat=  Category::model()->findByPk($product->category_id);
            $this->layout = 'detail';
            $comments = Comment::model()->findAll('status = 1 && product_id='.$id); 
            //$field = ProductOption::model()->findAll('group_product_id = '.$product->group_product_id);
            //$field = CHtml::listData($field, 'id', 'name'); // danh sach nhóm san pham
            $field = Yii::app()->db->createCommand('select * from  product_options where group_product_id='.$product->group_product_id)->queryAll();
            $field = convertArray($field);
            $this->render('view',array('product'=>$product,'comments'=>$comments,'fields'=>$field));
	}
    public function actionList($id=null)
	{ 
            $catlist=  Category::model()->findAll(array('condition'=>'parent_id='.$id,'order'=>'t.order asc'));
            if(empty($catlist))
                $this->redirect(array('products/listlast/'.$id));
            $cat = Category::model()->findByPk($id);
            $catId = Category::model()->getListId($id);
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition='category_id IN(' . implode(',',$catId) . ')';
            $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=15; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->cat = $cat;
            $this->render('list',array('list'=>$catlist,'products'=>$data,'pages'=>$pages));
	}
        
        public function actionListlast($id = null)
	{ // echo 'id : '.$id.' style : '.$style; die;
            $this->layout='listproduct';            
            $cat = Category::model()->findByPk($id);
            $catId = Category::model()->getListId($id);
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition='category_id IN(' . implode(',',$catId) . ')';
            $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=15; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->cat = $cat; 
            $this->render('listlast',array('products'=>$data,'pages'=>$pages));
	}
        
        public function actionListlast2($id = null)
	{  
            $this->layout='listproduct';
            $cat = Category::model()->findByPk($id);
            $catId = Category::model()->getListId($id);
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition='category_id IN(' . implode(',',$catId) . ')';
            $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=4; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->cat = $cat; 
            $this->render('listlast',array('products'=>$data,'pages'=>$pages));
	}
        
        public function actionAddcomment(){
            //$session = getSession(); 
            $captcha=Yii::app()->getController()->createAction("captcha");
            $code = $captcha->verifyCode;            
            if($code === $_REQUEST['captcha']){                 
                $data = $_POST;
                $model = new Comment();
                $data['created']=date('Y-m-d');
                $data['modified']=date('Y-m-d');
                $data['status']=1;
                $model->attributes = $data;
                $model->save();
                $this->redirect(array('products/view/'.$data['product_id']));
                
            }            
        }
        
        public function actionTest($id = null){
            echo 'id : '. $id; die;
        }
        
        public function actionSearch($id){
           $this->layout='listproduct';
           $condition = 'category_id = '.$id;
           $this->cat = Category::model()->findByPk(($id));
           $session = getSession();
            if(isset($_POST['m_from'])){
                if(!empty($_POST['m_from']))
                    $condition .= ' and price_sell_sell >='.$_POST['m_from'];
                if(!empty($_POST['m_to']))
                    $condition .= ' and price_sell_sell <='.$_POST['m_to'];
                $session['condition'] = $condition;
            }             
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition=$session['condition'];
            $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=15; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->render('search',array('products'=>$data,'pages'=>$pages)); 
        }
        
        public function actionSearchName(){
           $this->layout='listproduct';          
           $session = getSession();
            if(isset($_POST['name_p'])){ 
                $condition = 'title like "%'.$_POST['name_p'].'%"';
                if(!empty($_POST['cat_id'])){
                    $session['cat_id'] = $_POST['cat_id'];
                    $listcat = Category::model()->getListId($_POST['cat_id']);
                    $condition .= 'and category_id in ('.  implode(',', $listcat).')'; 
                }               
                $session['condition'] = $condition;
            }
            if(isset($session['cat_id']))
                $this->cat = Category::model()->findByPk(($session['cat_id']));
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition=$session['condition'];
            $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=4; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->render('search',array('products'=>$data,'pages'=>$pages)); 
        }
        
        // tim kiem theo param
        public function actionSearchParams(){
            $this->layout='listproduct';  
            
            $condition=$keys=$values='';            
            if(isset($_GET['nsx'])){ // lay tham so nsx cu
                $condition .= (empty($condition))?'':' and ';
                $condition .='producer_id='.$_GET['nsx'];
            } 
            if(isset($_GET['cat'])){ // lay tham so nsx cu
                $condition .= (empty($condition))?'':' and ';
                $condition .='category_id='.$_GET['cat'];
                $this->cat = Category::model()->findByPk($_GET['cat']);
            } 
            
            if(isset($_GET['key'])){// lay mang tham so option
                $keys=$_GET['key'];
                $values=$_GET['value'];
                $keys=  explode(',', $keys);
                $values = explode(',', $values);
                $arr=array();                
                foreach($keys as $k=>$v){
                    $arr[$v]=$values[$k];                   
                } 
                $condition .= (empty($condition))?'':' and ';
                $condition .="fields like'".createConditionSerialize($arr)."'";
            }
           
             //   $this->cat = Category::model()->findByPk(($session['cat_id']));
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition=$condition;
            $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=4; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien            
            $this->render('search',array('products'=>$data,'pages'=>$pages)); 
        }
        
        public function actionGetName(){
        if(Yii::app()->request->isAjaxRequest && isset($_GET['q'])){
            $name = $_GET['q'];
            //$_GET['q'] là mặc dịnh chuổi ký tự gửi tới
            $limit = $_GET['limit'];
            //lấy limit
            $criteria = new CDbCriteria();
            $criteria->condition = "title LIKE :val";
            $criteria->params =array(":val"=>"%$name%");
            $criteria->limit =$limit;
            $data = Product::model()->findAll($criteria);
            $result =""; // nhớ có dòng này
            foreach($data as $key =>$val){
                $result .=$val['title']."|".$val['id']."\n";
            // "|" để phân cách 2 cái kết quả trả về item[1] là id, item[0] là name
            // "\n" ko có xuống dòng là hiện ra trên 1 dòng luôn, rất mất thẩm mỹ
            }
            echo $result;
        }
    }
    
    public function actionViewShoppingCart(){
        $this->layout='subwraper';
        $session = getSession(); 
        $member='';
        if(isset($session['member']))
            $member= Member::model ()->findByPk ($session['member']['id']);
        if(!isset($session['shopingcart']))
                {
                        $this->redirect(getURL().'site/message/6');//gio hang rong
                }
        if(isset($session['member_buying'])){
              
              $this->redirect(array('suaDonHang'));
          } else
            if(isset($session['shopingcart']))
                {   
                        $shopingcart=$session['shopingcart'];			 
                        $this->render('viewshoppingcart',array('shopingcart'=>$shopingcart,'member'=>$member));
                }
    }
    
    public function actionAddShoppingCart($id=null){
        $product=Product::model()->findByPk($id);
        //echo $product->quantity; die;
        if($product->quantity==0 || empty($product->quantity))
            {
                    //echo '<script language="javascript"> alert("Hết hàng!"); window.back(); </script>';
                    $this->redirect(getURL().'site/message/2');//het hang
            } else {
	/*
	Neu co ma san pham
	 $shopingcart[$id]['name']=$product['Product']['title'];	
	 */
         $session = getSession();           
	 if(!isset($session['shopingcart']))
	 $session['shopingcart']=array();
	 if(isset($session['shopingcart']))	 
	 {   $shopingcart=$session['shopingcart'];
		 if(isset($shopingcart[$id]))
		 {
			 // echo '<script language="javascript"> if(!confirm("Sản phẩm đã có trong giỏ hàng. Qúy khách có mua thêm nữa không ?")) window.back(); </script>';
			 $shopingcart[$id]['sl']= $shopingcart[$id]['sl']+1;
			 $shopingcart[$id]['total']=$shopingcart[$id]['price_sell']*$shopingcart[$id]['sl'];
                          $shopingcart[$id]['bonus']=$product->bonus*$shopingcart[$id]['sl'];
			 $session['shopingcart']=$shopingcart;			  //pr($_SESSION['shopingcart']); die;
                         // echo '<script language="javascript"> alert("Đã đặt hàng thêm 1 sản phẩm này!"); window.back(); </script>'; 
                         $this->redirect(getURL().'site/message/3'); // mua them 1 sp da co trong gio hang
		 }
	     else
		 {			  
				$shopingcart[$id]['name']=$product->title;
                                $shopingcart[$id]['alias']=$product->alias;
				$shopingcart[$id]['images']=  getURL().$product->image;	
				$shopingcart[$id]['sl']=1;
				$shopingcart[$id]['price_sell']=$product->price_sell;
				$shopingcart[$id]['total']=$shopingcart[$id]['price_sell'];
                                $shopingcart[$id]['bonus']=$product->bonus;
				$session['shopingcart']=$shopingcart;
				$this->redirect(getURL().'site/message/1'); //Thêm sản phẩm thành công.
				//echo '<script language="javascript"> alert("Thêm sản phẩm thành công."); window.back(); </script>';
	         }
	 }}
    }
    
    public function actionEditShoppingCart(){
        $session = getSession(); 
        if(isset($_POST['quantity'])){
            $prolist=$_POST['quantity'];// pr($prolist); die;
            foreach($prolist as $key=>$value) { 
                $product=Product::model()->findByPk($key);
                if($product->quantity < $value)
                {
                    $this->redirect(array('/'.'gio-hang'));
                } else 
                if(isset($session['shopingcart']))
                    {   
                        $shopingcart=$session['shopingcart'];			 
                        if(isset($shopingcart[$key]))
                        {
                                $shopingcart[$key]['sl']=$value;
                                $shopingcart[$key]['total']=$shopingcart[$key]['sl']*$shopingcart[$key]['price_sell'];
                                $shopingcart[$key]['bonus'] = $value*$product->bonus;
                        }
                        $session['shopingcart']=$shopingcart;
                        
                    }
          }
          if(isset($_GET['edit'])&& isset($session['member_buying'])){
              $member_buying =$session['member_buying'];
              $member_buying['products']=  serialize($session['shopingcart']);
              $session['member_buying'] =$member_buying;
              $this->redirect(array('suaDonHang'));
          }
          $this->redirect(array('/'.'gio-hang'));
      }
    }
    
    public function actionDeleteShoppingCart($id=null){
        $session = getSession();  
        if(isset($session['shopingcart']))
            {   
                    $shopingcart=$session['shopingcart'];			 
                    if(isset($shopingcart[$id]))
                    unset($shopingcart[$id]);
                    $session['shopingcart']=$shopingcart;
                    $this->redirect(array('/'.'gio-hang'));
            }
    }
    
    public function actionDeleteAll(){ 
        $session = getSession();  
        if(isset($session['shopingcart']))
            unset ($session['shopingcart']);
         if(isset($session['member_buying']))
            unset ($session['member_buying']);
        //echo '123'; die;
        $this->redirect(getURL());
    }
    // guiwn don hang buoc 1
    public function actionPaymoney(){
        $session = getSession(); 
        $personbuy=$_POST['personbuy'];
        $personget=$_POST['personget'];
        $thanhtoan = $_POST['thanhtoan'];
        $vanchuyen = $_POST['vanchuyen'];
        $shopingcart=$session['shopingcart'];        
        $buying['products']=  serialize($shopingcart);
        $buying['member_id']= isset($session['member'])? $session['member']['id']:'';
        $buying['profit']=0;
        $buying['total']=0;
        $buying['personbuy'] = serialize($personbuy);
        $buying['personget'] = serialize($personget);
        $buying['time'] = serialize($_POST['time']);
        $buying['thanhtoan'] = $thanhtoan;
        $buying['vanchuyen'] = $vanchuyen;
        $buying['status'] = 0;
        foreach($shopingcart as $key=>$value){
            $product= Product::model()->findByPk($key);
            $buying['profit'] += $value['sl']*$product->bonus;
            $buying['total'] += $value['total'];
        }
        if(isset($session['member'])){
            $mem = Member::model()->findByPk($session['member']['id']);
            $diem_off=0;
            if($mem->title>0){
                $the =Yii::app()->tree->getRoseConsuming('card');
                $tien =Yii::app()->tree->getRoseConsuming('money');
                if($thanhtoan!='tienmat')
                    $diem_off = $buying['profit']*$the;
                else 
                    $diem_off = $buying['profit']*$tien;  
            }
             else {
                 $tvkn=Yii::app()->tree->getRoseConsuming('tvkn');
                 $diem_off = $buying['profit']*$tvkn;
             }
            $money_off =$diem_off*1000;
            $total_off = $buying['total']-$money_off;
            $buying['money_off']=$money_off;
            $buying['total_off']=$total_off;            
        } else{
            $buying['money_off']=0;
            $buying['total_off']=$buying['total'];   
        }
        $buying['created']=date('Y-m-d');
        $buying['modified']=date('Y-m-d');
        $session['member_buying']=$buying;
        $this->redirect(array('sendDonHang'));        
    }
    // gui don hang buoc 2
    public function actionSendDonHang(){
        $session = getSession();
        if(!isset($session['member_buying']))
            $this->redirect (getURL ());
        else if(isset ($_POST['senđonhang'])){
            $memberbuying = new MemberBuying();
            $buying = $session['member_buying']; 
            $personbuy= unserialize($buying['personbuy']);
            $memberbuying->attributes=$buying;
            if($memberbuying->save()){
                unset($session['shopingcart']);
                unset($session['member_buying']);
                // thanh vien mua hang bang the , tru tien trong tai khoan
                if(isset(Yii::app()->session['member'])&&$buying['thanhtoan']=='the'){
                    $member_id = Yii::app()->session['member']['id'];
                    $card = CardAccountNoCheck::model()->find('member_id="'.$member_id.'"');
                    if(!empty($card)&&($card->money-50000)>=$buying['total_off']){
                        $card->money -= $buying['total_off'];
                        $card->save();
                    }                    
                }
                sendMail($personbuy['email'],'phong@gmail.com','Gửi đơn hàng',$buying,'don_hang');
                $this->redirect(getURL().'site/message/19');
            }
        }
        $this->render('send_don_hang',array('member_buying'=>$session['member_buying']));
    }
    
    public function actionSuaDonHang(){
        $this->layout='subwraper';
        $session = getSession();
        if(!isset($session['member_buying']))
                {
                        $this->redirect(getURL());//gio hang rong
                }        			 
        $this->render('sua_don_hang',array('member_buying'=>$session['member_buying']));
                
    }
    
    public function actionFomat(){
        $number = $_REQUEST['number'];
        echo number_format($number);
    }
    public function actionCheckMoneyMember(){
        $member_id=$_REQUEST['member_id'];
        $total_off = $_REQUEST['total_off'];
        $member = Member::model()->findByPk($id);
        if(($member->CardAccount['money']-50000 )>=$total_off)
            echo 1;
        else {
            echo 0;
        }
    }

    public function beforeAction($action) {
            $sale=  Help::model()->find('status=1 order by id desc');
            $this->sale=$sale;
            return true;
        }
        
}