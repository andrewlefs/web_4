<?php

class QuestionController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = Question::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Question::model()->findAll($criteria); // mang chua ds cac ban ghi theo dieu kien
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }    
    public function actionAdd(){  
        checkLogin($this);
        $question = new Question(); 
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($question);
        if(isset($_POST['Question'])){ //pr($_POST); die;            
            $data = $_POST['Question'];
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $question->attributes = $data;      
            if($question->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("add",array('question'=>$question));//...
    }
    public function actionEdit($id = null){
        checkLogin($this);
        $question = Question::model()->findByPk($id);
        $this->performAjaxValidation($question);
        if(isset($_POST['Question'])){ //pr($_POST); die;
            $data = $_POST['Question'];
            $data['modified']=date('Y-m-d'); //pr($data); die;
            $question->attributes = $data;
            if($question->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("edit", array('question'=>$question));
    }
    
    public function actionAnswer($id = null){
        checkLogin($this);
        $question = Question::model()->findByPk($id);
        if(isset($_POST['answer'])){ //pr($_POST); die;
            $question->answer= $_POST['answer'];
            $question->modified=date('Y-m-d H:i:s'); //pr($data); die;
            $question->status = 1;
            if($question->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        }
        $this->render("answer", array('question'=>$question));
    }
    
    public function actionDelete($id=null){
        checkLogin($this);
         Question::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $question = Question::model()->findByPk($id);
        $question->status = ($question->status==0)?1:0;
        $question->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $question = Question::model()->findByPk($id); 
        $this->render("view", array ('cat'=>$question));
    }

    
    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='frm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
   
}
?>
