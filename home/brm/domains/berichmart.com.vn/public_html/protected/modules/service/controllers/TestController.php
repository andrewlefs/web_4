<?php
class TestController extends Controller
{    
    public function actionIndex(){       
        $this->renderPartial('index');
    }
    
    // test them va sua voi method post
    public function actionTest(){ 
        // demo post du lieu json de insert
        $url =(isset($_POST['url']))?$_POST['url']:'';
        $data = (isset($_POST['data']))?$_POST['data']:'';
        $data= json_encode($data); 
        $result = file_post_contents($url, $data);
           // header('Content-type: application/json');
        echo $result;  
    }
}
?>
