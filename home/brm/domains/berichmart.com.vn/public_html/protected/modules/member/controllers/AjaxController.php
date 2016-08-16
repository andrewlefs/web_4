<?php
class AjaxController extends CController{
    public function actionGetPrice(){
        if($_POST['id'])	{
		$id=$_POST['id']; 
		$result=  Yii::app()->db->createCommand("SELECT * FROM vdc_product where provider_id='$id'")->queryAll();
		$str = '<option value="" selected="selected">--Chọn mệnh giá--</option>  ';	
		foreach($result as $row)
		{
			$title=$row['title'];
			$price=$row['price'];
			$str .= '<option value="'.$price.'">'.$title.'</option>';

		}
		echo $str;
	}
    }
    
    public function actionGetProduct(){
        if($_POST['id'])	{
		$id=$_POST['id'];		
		$result=  Yii::app()->db->createCommand("SELECT * FROM vdc_product where provider_id='$id'")->queryAll();
		$str = '<option value="" selected="selected">--Chọn mệnh giá--</option>  ';	
		foreach($result as $row)
		{
			$title=$row['title'];
			$id=$row['id'];
			$str .= '<option value="'.$id.'">'.$title.'</option>';

		}
		echo $str;
	}
    }
    
     public function actionGetProvider(){
         if($_POST['id'])
	{
		$id=$_POST['id'];
		$result=  Yii::app()->db->createCommand("SELECT * FROM vdc_providers where category_id='$id'")->queryAll();
		$str = '<option value="" selected="selected">--Chọn nhà cung cấp --</option>  ';	
		foreach($result as $row)
		{
			$id=$row['id'];
			$data=$row['name'];
			$str .= '<option value="'.$id.'">'.$data.'</option>';

		}
		echo $str;
	}  
     }
     // nap tien vao dt
     public function actionGetProcessForm(){
        include('class/nusoap.php');
        $u ='esccard_vn';
        $pas = '123456';
        $key_u ="hQFc+3BHRTDqy1KoJOBgf51wrU2fyiZn";
        $WSDL = "http://demo.buyme.vn:88/api/topup.php?wsdl";
        $client = new nusoap_client($WSDL, true);
	if($_POST['price']>0 && $_POST['mobile']>0)	{	
		 $result = $client->call('direct_topup_mobile', array(
         'user_name'=>$u,
         'password'=>$pas,
         'mobile'=>$_POST['mobile'],
         'price'=>$_POST['price'],
		 ));	
		  if($result['error']==0){
			echo $result['error'];
		  }
	}else{
		echo 'Có lỗi xảy ra xin vui lòng thử lại';
	}
        }
        
        // format so ajax
    public function actionCreateNumber(){
        $number = str_replace(',', '', $_POST['number']);
        echo number_format($number); 
    }

}
?>
