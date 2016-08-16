<?php
class CategoryController extends Controller
{
    public $layout='home';
    public $member;
    public function actionIndex()
	{    // mac dinh chay giao dien test
            $this->render('index');
	}
    public function actionGetCats(){
        $sql='select * from categories where status=1';
        if(isset($_GET['id']) && intval($_GET['id'])) {
            $category_id = intval($_GET['id']);
            $sql .= ' and id='.$category_id;  
        } 
        if(isset($_GET['parent_id']) && intval($_GET['parent_id'])) {
            $parent_id = intval($_GET['parent_id']);
            $sql .= ' and parent_id='.$parent_id;  
        } 
        $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : ''; //All is the default
        $sql .=(!empty($number_of_posts))?' limit '.$number_of_posts:'';
        //echo $sql; die;  
        $categorys = Yii::app()->db->createCommand($sql)->queryAll();  
        foreach($categorys as $pro){
            $data[]['category'] = $pro;
        }
        header('Content-type: application/json');
        if(isset($data))
            echo json_encode(array('posts'=>$data));
        else echo false;
    }
    
    public function actionInsertCategory(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $category = new Category();
        $category->attributes=$data;
        if($category->save())
            echo true;
        else
            echo false;
    }
    
    public function actionUpdateCategory(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        if(isset($_GET['id'])){
            $category =  Category::model()->findByPk($_GET['id']);
            $category->attributes=$data;
            if($category->save())
                echo true;
            else
                echo false;
        }
    }
    
    public function actionDeleteCategory(){
        $id =(isset($_GET['id']))?$_GET['id']:'';
        if(Category::model()->findByPk($id)->delete())
            echo true;
        else 
            echo false;
    }
    
    public function actionTest(){ 
        // demo post du lieu json de insert
        $data = array('id'=>128,'name'=>'nguyen van cong','address'=>'tu liem ha noi');
        $data= json_encode($data); // echo 'http://'.$_SERVER['SERVER_NAME'].getURL().'service/categorys/insertcategory';        
        $result = file_post_contents('http://'.$_SERVER['SERVER_NAME'].getURL().'service/categorys/insertcategory', $data);
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