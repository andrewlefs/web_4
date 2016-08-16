<?php
class TestController extends Controller{
    public $layout = "default";
    public function actionSearch(){
        checkLogin($this);
        $this->render('search');
        
    }

    public function actionAjaxSearch(){
        checkLogin($this);
        $name = $_POST['txtName'];
        $criteria = new CDbCriteria(); // tao dieu kien
        $criteria->condition = "title LIKE '%$name%'";
        $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
        $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=3; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->renderPartial("ajaxSearch",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    
    public function actionList(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien
        $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
        $count = Product::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Product::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("list",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
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
    
    public function actionAddshopingcart($id=null){
		$product=Product::model()->findByPk($id);
                //echo $product->quantity; die;
		if($product->quantity==0 || empty($product->quantity))
		 {
			 echo '<script language="javascript"> alert("Het hang."); window.back(); </script>';
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
			 echo '<script language="javascript"> if(!confirm("San pham da ton tai trong gio hang, co muon mua them nua khong ?")) window.back(); </script>';
			 $shopingcart[$id]['sl']= $shopingcart[$id]['sl']+1;
			 $shopingcart[$id]['total']=$shopingcart[$id]['price_sell']*$shopingcart[$id]['sl'];			
			 $session['shopingcart']=$shopingcart;			  //pr($_SESSION['shopingcart']); die;
	echo '<script language="javascript"> alert("da tang sp nay then 1"); window.back(); </script>'; 
		 }
	     else
		 {			  
				$shopingcart[$id]['name']=$product->title;	
				$shopingcart[$id]['images']=  getURL().$product->image;	
				$shopingcart[$id]['sl']=1;
				$shopingcart[$id]['price_sell']=$product->price_sell;
				$shopingcart[$id]['total']=$shopingcart[$id]['price_sell'];
				$session['shopingcart']=$shopingcart;
				
				echo '<script language="javascript"> alert("them sp thanh cong."); window.back(); </script>';
	         }
	 }}
	
	} 
    
        public function actionViewshopingcart(){	
            $session = getSession();  
	    if(!isset($session['shopingcart']))
		 {
			 echo '<script language="javascript"> alert("Chua co san pham nao trong gio hang."); window.location.replace("'.  getURL().'"); </script>';
		 }	
		 
		if(isset($session['shopingcart']))
		 {   
			 $shopingcart=$session['shopingcart'];			 
			 $this->render('viewshopingcart',array('shopingcart'=>$shopingcart));
		 }
		  
	}
    
        public function actionDeleteshopingcart($id=null){
                $session = getSession();  
		if(isset($session['shopingcart']))
		 {   
			 $shopingcart=$session['shopingcart'];			 
			  if(isset($shopingcart[$id]))
			  unset($shopingcart[$id]);
			  $session['shopingcart']=$shopingcart;
			  $this->redirect(array('viewshopingcart'));
		 }
		
	}
	public function actionUpdateshopingcart($id=null){
                $session = getSession();  
		$product=Product::model()->findByPk($id);
		if($product->quantity < $_POST['soluong'])
		 {
			 echo '<script language="javascript"> alert("so luong mua nhieu hon kho dang co"); window.location.replace("'.DOMAIN.'products/viewshopingcart"); </script>';
		 } else 
		if(isset($session['shopingcart']))
		 {   
			 $shopingcart=$session['shopingcart'];			 
			  if(isset($shopingcart[$id]))
			  {
				  $shopingcart[$id]['sl']=$_POST['soluong'];
				  $shopingcart[$id]['total']=$shopingcart[$id]['sl']*$shopingcart[$id]['price_sell'];
			  }
			  $session['shopingcart']=$shopingcart;			  
			   echo '<script language="javascript"> window.location.replace("'.  getURL().'test/viewshopingcart"); </script>';
		 }
	}
	
	public function actionSendshopingcart(){
                 $session = getSession();  
		 $shopingcart=$session['shopingcart'];	
		 foreach($shopingcart as $key=>$product){
		 	$pro = $this->Product->findById($key);
			if(!empty($pro['Product']['quantity']))
			{
				$pro['Product']['quantity'] = $pro['Product']['quantity'] - $product['sl'];
				$this->Product->save($pro['Product']);
			}
		 }
		 unset($session['shopingcart']);
		 echo '<script language="javascript"> alert("Gá»­i Ä‘Æ¡n hÃ ng thÃ nh cÃ´ng"); window.location.replace("'.DOMAIN.'"); </script>';
	}
}
?>
