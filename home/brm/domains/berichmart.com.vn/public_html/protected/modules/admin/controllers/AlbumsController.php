<?php

class AlbumsController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = Album::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Album::model()->findAll($criteria); 
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $Album = new Album(); 
        $session = getSession();
        $session['model']=$Album;
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($Album);
        if(isset($_POST['Album'])){ //pr($_POST); die;            
            $data = $_POST['Album'];            
            $data['image']=  getImageURL($data['image']);
            if(!empty($data['albumcategorylist'])){
                $data['albumcategorylist'] = implode(',', $data['albumcategorylist']);            
                $data['album_category_id']=','.$data['album_category_id'].','.$data['albumcategorylist'].',';
            }
            if(!empty($data['singerlist'])){
                $data['singerlist'] = implode(',', $data['singerlist']);            
                $data['singer_id']=','.$data['singer_id'].','.$data['singerlist'].',';
            }
            $data['status']=1;
            $data['created']=date('Y-m-d');
            $data['modified']=date('Y-m-d');
            $Album->attributes = $data;      
            if($Album->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        } 
        $album_category = AlbumCategory::model()->findAll('parent_id is null');
        $album_category = CHtml::listData($album_category, 'id', 'name');        
        $this->render("add",array('Album'=>$Album,'album_category'=>$album_category));
    }
    public function actionEdit($id = null){ 
        checkLogin($this);
        $Album = Album::model()->findByPk($id);
        $session = getSession();        
        $this->performAjaxValidation($Album);
        if(isset($_POST['Album'])){ 
            $data = $_POST['Album'];
            $data['image']=  getImageURL($data['image']);
            if(!empty($data['albumcategorylist'])){
                $data['albumcategorylist'] = implode(',', $data['albumcategorylist']);            
                $data['album_category_id']=','.$data['album_category_id'].','.$data['albumcategorylist'].',';
            }
            if(!empty($data['singerlist'])){
                $data['singerlist'] = implode(',', $data['singerlist']);            
                $data['singer_id']=','.$data['singer_id'].','.$data['singerlist'].',';
            }
            $data['modified']=date('Y-m-d'); //pr($data); die;            
            $Album->attributes = $data;
            if($Album->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        } 
        $album_category = AlbumCategory::model()->findAll('parent_id is null');
        $album_category = CHtml::listData($album_category, 'id', 'name');
        // xu ly danh sach the loai album
        $album_category_list= getArray($Album->album_category_id);
        $Album->album_category_id = isset($album_category_list[0])?$album_category_list[0]:'';
        if(isset($album_category_list[0]))
            unset ($album_category_list[0]);
        $Album->albumcategorylist=$album_category_list;
        //xy ly danh sach nghe si
        $singer_list= getArray($Album->singer_id);
        $Album->singer_id = isset($singer_list[0])?$singer_list[0]:'';
        if(isset($singer_list[0]))
            unset ($singer_list[0]);
        $Album->singerlist=$singer_list;
        
        $session['model']=$Album;
       // pr($album_category_list); die;
        $this->render("edit", array('Album'=>$Album,'album_category'=>$album_category));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         Album::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $Album = Album::model()->findByPk($id);
        $Album->status = ($Album->status==0)?1:0;
        $Album->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $Album = Album::model()->findByPk($id); 
        $this->render("view", array ('Album'=>$Album));
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
