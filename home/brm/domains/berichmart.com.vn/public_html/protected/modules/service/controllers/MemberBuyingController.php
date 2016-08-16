<?php
class MemberBuyingController extends Controller
{
    
    public function actionIndex()
	{    // mac dinh chay giao dien test
            $this->render('index');
	}
    public function actionGetMemberBuyings(){
        $sql='select * from member_buyings';
        $condition ='';
        if(isset($_GET['id']) && intval($_GET['id'])){
           $condition .= (empty($condition))?' where ':' and ';
           $condition .=' id='.$_GET['id'] ;
        }
        if(isset($_GET['member_id']) && intval($_GET['member_id'])) {
            $member_id= intval($_GET['member_id']);            
            $condition .= (empty($condition))?' where ':' and ';
           $condition .=' member_id='.$member_id;
        } 
        
        if(isset($_GET['month'])){
           $condition .= (empty($condition))?' where ':' and ';
           $condition .=' month(created)='.$_GET['month'] ;
        }
        
        if(isset($_GET['year'])){
           $condition .= (empty($condition))?' where ':' and ';
           $condition .=' year(created)='.$_GET['year'] ;
        }
        
        $sql .= $condition;
        $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : ''; //All is the default
        $sql .=(!empty($number_of_posts))?' limit '.$number_of_posts:'';
        //echo $sql; die;  
        $groups = Yii::app()->db->createCommand($sql)->queryAll();        
        foreach($groups as $pro){
            $data[]['memberbuying'] = $pro;
        }
        header('Content-type: application/json');
        if(isset($data))
            echo json_encode(array('posts'=>$data));
        else echo false;
    }
    
    public function actionInsertMemberBuying(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $data['products'] = parseObjectToArray($data['products']);
        foreach ($data['products'] as $key=> $pro)
            $data['products'][$key]=parseObjectToArray($pro);
        $data['products'] = serialize($data['products']);
        $group = new MemberBuying(); 
        $group->attributes=$data;
        if($group->save())
            echo true;
        else
            echo false;
    }
    
    public function actionUpdateMemberBuying(){
        //$json=$_GET ['json'];
        $json = file_get_contents('php://input');
        $obj = json_decode($json);        
        $data = parseObjectToArray($obj);
        $data['products'] = parseObjectToArray($data['products']);
        foreach ($data['products'] as $key=> $pro)
            $data['products'][$key]=parseObjectToArray($pro);
        $data['products'] = serialize($data['products']);
        if(isset($_GET['id'])){
            $group =  MemberBuying::model()->findByPk($_GET['id']);
            $group->attributes=$data;
            if($group->save())
                echo true;
            else
                echo false;
        }
    }
    
    public function actionDeleteMemberBuying(){
        $id =(isset($_GET['id']))?$_GET['id']:'';
        if(MemberBuying::model()->findByPk($id)->delete())
            echo true;
        else 
            echo false;
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