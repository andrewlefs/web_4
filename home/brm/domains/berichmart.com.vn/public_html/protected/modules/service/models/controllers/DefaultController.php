<?php
//Yii::import("application.library.Nested_Set");
class DefaultController extends Controller
{
    public $layout='home';
    public $member;
    public function actionIndex()
	{    // mac dinh chay giao dien test
            $this->render('index');
	}
        
}