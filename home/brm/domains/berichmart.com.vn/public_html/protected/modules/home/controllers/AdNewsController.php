<?php

class AdNewsController extends Controller
{
    public $layout = 'home';
    public $listCat;
    public $cat;
    public $member;
    public $freshnews;
    public $adnews;
    public $sale;
    
    public function actions()
        {
            return array(
            'captcha'=>array('class'=>'CCaptchaAction',
                            'backColor'=>0xFFFFFF,
                            'foreColor'=>0x000,
                            'height'=>'50',
                            'width'=>'120'
                )
            );
        }
        
    public function actionIndex($id=null)
	{       
            
	}
    public function actionView($id=null)
	{
            $this->layout = 'detail_rao_vat';
            $adnews = AdNews::model()->findByPk($id);
            $cat = Category::model()->findByPk($adnews->category_id);
            $this->cat = $cat;
            $this->member= Member::model()->findByPk($adnews->member_id); 
            $other_news = AdNews::model()->findAll('id <> ? order by id DESC limit 5',array($id));
            $this->freshnews = AdNews::model()->findAll('id <> ? order by id DESC limit 12',array($id));
            $comments = Comment::model()->findAll('status = 1 && news_id='.$id); 
            $this->render('view',array('news'=>$adnews,'other_news'=>$other_news,'comments'=>$comments));
	}
    public function actionList($id=252)
	{
            $catlist=  Category::model()->findAll(array('condition'=>'parent_id='.$id,'order'=>'t.order asc'));
            if(!empty($catlist))
                $this->layout = 'list_rao_vat';
            else 
                $this->layout = 'listlast_rao_vat';
            
            $this->freshnews = AdNews::model()->findAll('id <> ? order by id DESC limit 15',array($id));            
            //if(empty($catlist))
               // $this->redirect(array('products/listlast/'.$id));
            $cat = Category::model()->findByPk($id);
            $catId = Category::model()->getListId($id);
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition='category_id IN(' . implode(',',$catId) . ')';
            $count = AdNews::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=10; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = AdNews::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->cat = $cat;
            $cities = City::model()->findAll('status = 1 order by stt asc');
            if(!empty($catlist))
                $this->render('list',array('list'=>$catlist,'adnews'=>$data,'pages'=>$pages,'countnews'=>$count,'cities'=>$cities));
            else
                $this->render('listlast',array('list'=>$catlist,'adnews'=>$data,'pages'=>$pages,'countnews'=>$count,'cities'=>$cities));
	}
        
    public function actionListByMember($id){
            $this->layout = 'list_rao_vat';    
            $this->freshnews = AdNews::model()->findAll('id <> ? order by id DESC limit 15',array($id));
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition='member_id = '.$id;
            $count = AdNews::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=10; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = AdNews::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $cities = City::model()->findAll('status = 1 order by stt asc');
            $cat = Category::model()->findByPk($_GET['cat']);
            $this->cat = $cat;
            $this->render('listbymember',array('adnews'=>$data,'pages'=>$pages,'countnews'=>$count,'cities'=>$cities));
    }
    
    public function actionAddcomment(){
            //$session = getSession(); 
            $captcha=Yii::app()->getController()->createAction("captcha");
            $code = $captcha->verifyCode;            
            if($code === $_REQUEST['captcha']){                 
                $data = $_POST;
                $model = new Comment();
                $data['created']=date('Y-m-d');
                $data['modified']=date('Y-m-d');
                $data['status']=1;
                $model->attributes = $data;
                $model->save();
                $this->redirect(array('adnews/view/'.$data['news_id']));
                
            }            
        }
        
        public function actionSearch($id=252)
	{   
            $condition='';
            $session = getSession();
            if(isset($_GET['type']))
                if(!empty($_GET['type']))
                    $condition='type = '.$_GET['type'];
                else
                    $condition = '';
            if(isset($_GET['city_id']))
                if(!empty($_GET['city_id']))
                    $condition='city_id = '.$_GET['city_id'];
                else
                    $condition = '';
            if(isset($_GET['city_id'])||isset($_GET['type']))
                $session['condition']=$condition;
            $catlist=  Category::model()->findAll(array('condition'=>'parent_id='.$id,'order'=>'t.order asc'));
            if(!empty($catlist))
                $this->layout = 'list_rao_vat';
            else 
                $this->layout = 'listlast_rao_vat';
            
            $this->freshnews = AdNews::model()->findAll('id <> ? order by id DESC limit 15',array($id));            
            //if(empty($catlist))
               // $this->redirect(array('products/listlast/'.$id));
            $cat = Category::model()->findByPk($id);
            $catId = Category::model()->getListId($id);
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            if(!empty($session['condition']))
                $criteria->condition='category_id IN(' . implode(',',$catId) . ')'.' and '.$session['condition'];
            else
                $criteria->condition='category_id IN(' . implode(',',$catId) . ')';
            $count = AdNews::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=10; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = AdNews::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->cat = $cat;
            $cities = City::model()->findAll('status = 1 order by stt asc');
            if(!empty($catlist))
                $this->render('list',array('list'=>$catlist,'adnews'=>$data,'pages'=>$pages,'countnews'=>$count,'cities'=>$cities));
            else
                $this->render('listlast',array('list'=>$catlist,'adnews'=>$data,'pages'=>$pages,'countnews'=>$count,'cities'=>$cities));
	}
        
        public function actionSearchPrice($id){
           $this->layout='listlast_rao_vat';
           $condition = 'category_id = '.$id;
           $this->cat = Category::model()->findByPk(($id));
           $session = getSession();
            if(isset($_POST['m_from'])){
                if(!empty($_POST['m_from']))
                    $condition .= ' and price >='.$_POST['m_from'];
                if(!empty($_POST['m_to']))
                    $condition .= ' and price <='.$_POST['m_to'];
                $session['condition'] = $condition;
            }             
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition=$session['condition'];
            $count = AdNews::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=10; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = AdNews::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $cities = City::model()->findAll('status = 1 order by stt asc');
            $this->render('listlast',array('adnews'=>$data,'pages'=>$pages,'countnews'=>$count,'cities'=>$cities)); 
        }
        
        public function beforeAction($action) {
            $sale=  Help::model()->find('status=1 order by id desc');
            $this->sale=$sale;
            return true;
        }
    
}