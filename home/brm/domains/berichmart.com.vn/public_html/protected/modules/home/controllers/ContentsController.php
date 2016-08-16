<?php
/**
 * SiteController
 */
class ContentsController extends Controller
{
	public function actionIndex()
	{
			$request = Yii::app()->request;
			$catid=$request->getParam('catid');
			$data=Content::model()->getContentCatergory($catid);
			$name=Content::model()->getNameCategory($catid);
			$this->layout= 'content';
			$this->render('index',array('data'=>$data,'name'=>$name));
			
	}
	public function actionSearch()
	{
			$request = Yii::app()->request;
			$name=$request->getParam('name');
			$where=array('status=1',"title like '%$name%'");
				$data=Content::model()->getSearch($where);
			$name=array(0=>array("name"=>"K&#7871;t qu&#7843; t&#236;m ki&#7871;m"));
		    $this->layout= 'content';
			$this->render('index',array('data'=>$data,'name'=>$name));
			
	}
	public function actionView()
	{
			$request = Yii::app()->request;
			$id=$request->getParam('id');
			$data=Content::model()->getContent($id);
			$other=Content::model()->getContentCatergory($data[0]['category_id'],$id);
			$this->layout= 'content';
			$this->render('view',array('data'=>$data,'other'=>$other));
			
	}
	public function actionHome()
	{
			$this->layout= 'content';
			$this->render('home');
			
	}
}