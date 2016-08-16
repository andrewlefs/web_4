<?php

class DefaultController extends Controller
{
    public $layout = 'home';
    public $listCat;
    public $sale;
    
    public function actionIndex()
	{       /*
                Yii::app()->sourceLanguage='en_us';
                Yii::app()->language='vi'   ; 
                echo Yii::t('tb', 'tb2'); die;
         * 
         */
        //ini_set ( 'soap.wsdl_cache_enable' , 0 ); ini_set ( 'soap.wsdl_cache_ttl' , 0 );
       // $service = new SoapClient('http://berichmart.com.vn/service/webService/service');
      //  var_dump($service->__getFunctions());
       // echo $service->hello('nguyen van cong'); die;
     //  $service = new SoapClient('http://localhost/berichmart/service/webService/service');
     // $pros = $service->getTaiKhoanTheList("admin","admin");
// pr($pros);
// die;

            $catlist = Category::model()->findAll('parent_id = 252 order by t.order asc limit 8');
            $this->listCat = $catlist;           
            $productreduce = Product::model()->findAll('reduce=1 and status = 1 order by id desc limit 20');
            $categorylist = Category::model()->findALL('status=1 and t.show=1');   
            $productviews = Product::model()->findAll('status = 1 order by view desc limit 28');
            $this->render('index',array('productreduce'=>$productreduce,'categorylist'=>$categorylist,'productviews'=>$productviews));
	}
    public function actionView()
	{
            $this->layout = 'detail';
            $this->render('view');
	}
    public function actionListds()
	{
            $this->layout = 'list';
            $this->render('listds');
	}
        
        public function beforeAction($action) {
            $sale=  Help::model()->find('status=1 order by id desc');
            $this->sale=$sale;
            return true;
        }
}