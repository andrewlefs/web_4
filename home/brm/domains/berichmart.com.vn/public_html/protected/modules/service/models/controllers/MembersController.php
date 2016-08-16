<?php
class MembersController extends Controller
{
   
    public function actionIndex()
	{    // mac dinh chay giao dien test
            $this->render('index');
	}
    public function actionGetMembers(){
        $sql='select * from members';
        $condition ='';
        if(isset($_GET['id']) && intval($_GET['id'])){
           $condition .= (empty($condition))?' where ':' and ';
           $condition .=' id='.$_GET['id'] ;
        }
        if(isset($_GET['name'])) {                        
            $condition .= (empty($condition))?' where ':' and ';
           $condition .=' name="'.$_GET['name'].'"' ;
        } 
        $sql .= $condition;
        $number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : ''; //All is the default
        $sql .=(!empty($number_of_posts))?' limit '.$number_of_posts:'';
        // echo $sql; die;  
        $Members = Yii::app()->db->createCommand($sql)->queryAll();  
        foreach($Members as $pro){
            $data[]['Member'] = $pro;
        }
        header('Content-type: application/json');
        if(isset($data))
            echo json_encode(array('posts'=>$data));
        else echo false;
    }      
        
}