<?php

class NewsController extends Controller
{
    public $layout = 'news';
    public $listCat;
    public $sale;
    public function actionIndex()
	{   
        $slidenews = News::model()->findAll('status = 1 and slidenews=1 order by id desc limit 4');
        $hotnews = News::model()->findAll('status = 1 and hotnews=1 order by id limit 9');
        $bonus_news=News::model()->findAll('status = 1 and category_id=368 order by id desc limit 5');
        $even_news=News::model()->findAll('status = 1 and category_id=369 order by id desc limit 5');
        $product_news=News::model()->findAll('status = 1 and category_id=370 order by id desc limit 5');
        $business_news=News::model()->findAll('status = 1 and category_id=371 order by id desc limit 5');
        $this->render('index',array('slidenews'=>$slidenews,'hotnews'=>$hotnews,'bonus_news'=>$bonus_news,'even_news'=>$even_news,'product_news'=>$product_news,'business_news'=>$business_news));
	}
    public function actionView($id)
	{
            $this->layout = 'detail_news';
            $news = News::model()->findByPk($id);
            $othernews = News::model()->findAll('id <> '.$id.' and status=1 and category_id ='.$news->category_id.' order by id desc limit 10');
            $this->render('view',array('news'=>$news,'othernews'=>$othernews));
	}
      // xem chi tiet 1 tin mới nhất trong 1 danh muc  
    public function actionViewCategory($id){   
        $this->layout = 'detail_news';
        $category=Category::model()->findByPk($id);
        $categorylist = Category::model()->getListId($category->parent_id);
        $news = News::model()->find('category_id=? order by id desc',array($id));
        $othernews = News::model()->findAll('category_id <>'.$id.' and status=1 and category_id in('.  implode(',', $categorylist).') order by id desc limit 10');
        $this->render('view_category',array('news'=>$news,'othernews'=>$othernews));
    }
    public function actionList($id)
	{            
            $cat = Category::model()->findByPk($id);
            $catId = Category::model()->getListId($id);
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition='category_id IN(' . implode(',',$catId) . ')';
            $count = News::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=10; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = News::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->render('list',array('cat'=>$cat,'news'=>$data,'pages'=>$pages));
	}
        
        public function actionCooperation($id=null){
            if(!isset($id))
                $id=400;
            $news = News::model()->find('category_id='.$id);
            $this->render('cooperation',array('news'=>$news));
        }
        
        public function actionSearch(){
            $session = getSession();
            if(isset($_POST['key'])){
                $condition = 'title like "%'.$_POST['key'].'%"';                             
                $session['condition'] = $condition;
            } 
            $criteria = new CDbCriteria(); // tao dieu kien
            $criteria->order="id desc";//sắp xếp theo thứ tự tăng dần(desc) theo khoa chính la id
            $criteria->condition=$session['condition'];
            $count = News::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=10; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = News::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
            $this->render('search',array('data'=>$data,'pages'=>$pages)); 
            
        }


        public function beforeAction($action) {
            $sale=  Help::model()->find('status=1 order by id desc');
            $this->sale=$sale;
            return true;
        }
}