<?php
class GroupProductsController extends Controller
{
    
    public function actionIndex()
	{    // mac dinh chay giao dien test
            $this->render('index');
	}
    public function actionGetGroupProducts(){
        $sql='select * from group_products';
        if(isset($_GET['id']) && intval($_GET['id'])) {
            $group_id = intval($_GET['id']);
            $sql .= ' where id='.$group_id;  
        } 
        
        $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : ''; //All is the default
        $sql .=(!empty($number_of_posts))?' limit '.$number_of_posts:'';
       // echo $sql; die;  
        $groups = Yii::app()->db->createCommand($sql)->queryAll();  
        foreach($groups as $pro){
            $data[]['group'] = $pro;
        }
        header('Content-type: application/json');
        if(isset($data))
            echo json_encode(array('posts'=>$data));
        else echo false;
    }
    
    public function actionInsertGroupProduct(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $group = new GroupProduct();
        $group->attributes=$data;
       // pr($data);
       // pr($group->attributes);
        if($group->save())
            echo true;
        else
            echo false;
    }
    
    public function actionUpdateGroupProduct(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);    
        $data = parseObjectToArray($obj);
        if(isset($_GET['id'])||isset($_GET['code'])){
            if(isset($_GET['id']))
                $group =  GroupProduct::model()->findByPk($_GET['id']);
            else 
                $group =  GroupProduct::model()->find('code=?',array($_GET['code']));
            $group->attributes=$data;
            if($group->save())
                echo true;
            else
                echo false;
        }
    }
    
    public function actionTest(){ 
        // demo post du lieu json de insert
        $data = array('id'=>128,'name'=>'nguyen van cong','address'=>'tu liem ha noi');
        $data= json_encode($data); // echo 'http://'.$_SERVER['SERVER_NAME'].getURL().'service/products/insertProduct';        
        //echo $data; die;
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
    
    public function actionDeleteGroupProduct(){
        $id =(isset($_GET['id']))?$_GET['id']:'';
        if(GroupProduct::model()->findByPk($id)->delete())
            echo true;
        else 
            echo false;
    }
        
}