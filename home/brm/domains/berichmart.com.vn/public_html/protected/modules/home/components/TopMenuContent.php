<?php
Yii::import('zii.widgets.CPortlet');
 
class TopMenuContent extends CPortlet
{
    public function init()
    {
		//$this->title=CHtml::encode(Yii::app()->user->name);
        parent::init();
    }
 
    protected function renderContent()
    {
		$connection=Yii::app()->db;
		$sql="SELECT * FROM users";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$list=array();
			while(($row=$dataReader->read())!==false) {
				$list[]=array('id'=>$row['id']);
			}
		$num=count($list);
        $this->render('TopMenuContent',array('num'=>$num));
    }
}
?>