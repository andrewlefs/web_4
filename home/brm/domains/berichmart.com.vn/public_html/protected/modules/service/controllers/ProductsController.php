<?php
class ProductsController extends Controller
{
    
    public function actionIndex()
	{    // mac dinh chay giao dien test
            $this->render('index');
	}
    public function actionGetProducts(){
        $sql='select * from products where status=1';
        if(isset($_GET['id']) && intval($_GET['id'])) {
            $product_id = intval($_GET['id']);
            $sql .= ' and id='.$product_id;  
        } 
        if(isset($_GET['code'])) {
            $code = $_GET['code'];
            $sql .= ' and code="'.$code.'"';  
        } 
        
        if(isset($_GET['category_id']) && intval($_GET['category_id'])) {
            $category_id = intval($_GET['category_id']);
            $sql .= ' and category_id='.$category_id;  
        } 
        
        if(isset($_GET['producer_id']) && intval($_GET['producer_id'])) {
            $producer_id = intval($_GET['producer_id']);
            $sql .= ' and producer_id='.$producer_id;  
        } 
        
        if(isset($_GET['group_product_id']) && intval($_GET['group_product_id'])) {
            $group_product_id = intval($_GET['group_product_id']);
            $sql .= ' and group_product_id='.$group_product_id;  
        }         
        $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : ''; //All is the default
        $sql .=(!empty($number_of_posts))?' limit '.$number_of_posts:'';
        
        $products = Yii::app()->db->createCommand($sql)->queryAll();  
        foreach($products as $pro){
            $data[]['product'] = $pro;
        }
        header('Content-type: application/json');
        if(isset($data))
            echo json_encode(array('posts'=>$data));
        else echo false;
    }
    
    public function actionInsertProduct(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $product = new Product();
        $product->attributes=$data;
        if($product->save())
            echo true;
        else
            echo false;
    }
    
     public function actionUpdateProduct(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $sql='';
        if(isset($_GET['id']) && intval($_GET['id'])) {
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' id='.$_GET['id'];  
        } 
        if(isset($_GET['code'])) {
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' code="'.$_GET['code'].'"';  
        } 
        if(!empty($sql)){
            $product =  Product::model()->find($sql);
            $product->attributes=$data;
            if($product->save())
                echo true;
            else
                echo false;
        }
    }
    
    public function actionDeleteProduct(){
        $sql='';
        if(isset($_GET['id']) && intval($_GET['id'])) {
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' id='.$_GET['id'];  
        } 
        if(isset($_GET['code'])) {
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' code="'.$_GET['code'].'"';  
        } 
        
        if(Product::model()->find($sql)->delete())
            echo true;
        else 
            echo false;
    }
    
    public  function actionUploadImage(){
        $uploaddir = Yii::getPathOfAlias('webroot').'/uploadfile/images/uploads/';
        $result=array();
        if(!empty($_FILES)){
            foreach($_FILES as $key=> $image){
                $uploadfile = $uploaddir . $image['name'];
                if (move_uploaded_file($image['tmp_name'], $uploadfile)) {   
                    $result[$key]= 'uploadfile/images/uploads/'.$image['name'];
                }
                else
                    $result[$key]='';
            }
            header('Content-type: application/json');
            echo json_encode($result);
        } else $this->renderPartial('uploadimage')     ;
            
    }


    public function actionTest(){ 
        // demo post du lieu json de insert
        $data = array('id'=>128,'name'=>'nguyen van cong','address'=>'tu liem ha noi');
        $data= json_encode($data); // echo 'http://'.$_SERVER['SERVER_NAME'].getURL().'service/products/insertProduct';        
        $result = file_post_contents('http://'.$_SERVER['SERVER_NAME'].getURL().'service/products/insertProduct', $data);
        if(empty($result))
            echo 'khong co du lieu';
        else {
           // header('Content-type: application/json');
            echo $result;
            $result = json_decode($result);
            pr(parseObjectToArray($result));
            }
    }
        
}