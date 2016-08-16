<?php
class usersController extends Controller
{
   
    public function actionIndex()
	{    // mac dinh chay giao dien test
            $this->render('index');
	}
    public function actionGetUsers(){
        $sql='select * from users where status=1';
        if(isset($_GET['id']) && intval($_GET['id'])) {
            $user_id = intval($_GET['id']);
            $sql .= ' and id='.$user_id;  
        } 
        if(isset($_GET['name'])) {
            $sql .= ' and name="'.$_GET['name'].'"';  
        } 
        if(isset($_GET['password'])) {
            $sql .= ' and password="'. md5($_GET['password']).'"';  
        } 
        $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : ''; //All is the default
        $sql .=(!empty($number_of_posts))?' limit '.$number_of_posts:'';
        // echo $sql; die;  
        $users = Yii::app()->db->createCommand($sql)->queryAll();  
        foreach($users as $pro){
            $data[]['user'] = $pro;
        }
        header('Content-type: application/json');
        if(isset($data))
            echo json_encode(array('posts'=>$data));
        else echo false;
    }
    
    public function actionInsertUser(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $data['password']=  md5($data['password']);
        $user = new User();
        $user->attributes=$data;
        if($user->save())
            echo true;
        else
            echo false;
    }
    
    public function actionUpdateUser(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $sql='';
        if(isset($_GET['id']) && intval($_GET['id'])) {
            $user_id = intval($_GET['id']);
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' id='.$user_id;  
        } 
        if(isset($_GET['name'])) {
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' name="'.$_GET['name'].'"';  
        } 
        if(isset($_GET['password'])) {
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' password="'. md5($_GET['password']).'"';  
        } 
         if(isset($data['password']))
             $data['password']=  md5 ($data['password']);
        if(!empty($sql)){
            $user =  User::model()->find($sql);
            $user->attributes=$data;
            if($user->save())
                echo true;
            else
                echo false;
        }
    }
    
    public function actionDeleteUser(){
        $sql='';
        if(isset($_GET['id']) && intval($_GET['id'])) {
            $user_id = intval($_GET['id']);
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' id='.$user_id;  
        } 
        if(isset($_GET['name'])) {
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' name="'.$_GET['name'].'"';  
        } 
        if(isset($_GET['password'])) {
            $sql .=(!empty($sql))?' and ':'';
            $sql .= ' password="'. md5($_GET['password']).'"';  
        } 
        if(GroupProduct::model()->find($sql)->delete())
            echo true;
        else 
            echo false;
    }
    
    public function actionTest(){ 
        // demo post du lieu json de insert
        $data = array('id'=>128,'name'=>'nguyen van cong','address'=>'tu liem ha noi');
        $data= json_encode($data); // echo 'http://'.$_SERVER['SERVER_NAME'].getURL().'service/users/insertuser';        
        $result = file_post_contents('http://'.$_SERVER['SERVER_NAME'].getURL().'service/users/insertuser', $data);
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