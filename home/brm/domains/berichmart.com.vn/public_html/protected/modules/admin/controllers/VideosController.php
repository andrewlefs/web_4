<?php

class VideosController extends Controller{
    public $layout = 'admin';
            
    public function actionIndex(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $count = Video::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Video::model()->findAll($criteria); 
        $this->render("index",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
    }
    public function actionAdd(){  
        checkLogin($this);
        $Video = new Video(); 
        // check xem co phai la video cho album mac dinh
        $album_id = isset($_GET['album_id'])?$_GET['album_id']:'';
        if(!empty($album_id)){
            $album = Album::model()->findByPk($album_id);
            $Video->album_id=$album->id;
            $singers = getArray($album->singer_id);
            $Video->singer_id = isset($singers[0])?$singers[0]:'';
            if(isset($singers[0]))
                unset ($singers[0]);
            $Video->singerlist=$singers;
        }
        $event_id = isset($_GET['event_id'])?$_GET['event_id']:'';
        if(!empty($event_id)){ 
            $event = Event::model()->findByPk($event_id);
            $Video->event_id=$event->id;            
        }
        $session = getSession();
        $session['model']=$Video;
        // Uncomment the following line if AJAX validation is needed
	$this->performAjaxValidation($Video);
        if(isset($_POST['Video'])){ //pr($_POST); die;            
            $data = $_POST['Video'];            
            $data['file']=  getImageURL($data['file']);
            if(!empty($data['videocategorylist'])){
                $data['videocategorylist'] = implode(',', $data['videocategorylist']);            
                $data['video_category_id']=','.$data['video_category_id'].','.$data['videocategorylist'].',';
            }
            if(!empty($data['singercategorylist'])){
                $data['singercategorylist'] = implode(',', $data['singercategorylist']);            
                $data['singer_category_id']=','.$data['singer_category_id'].','.$data['singercategorylist'].',';
            }
            if(!empty($data['singerlist'])){
                $data['singerlist'] = implode(',', $data['singerlist']);            
                $data['singer_id']=','.$data['singer_id'].','.$data['singerlist'].',';
            }
            if(!empty($data['subject_id'])){
                $data['subject_id'] = ','.implode(',', $data['subject_id']).','; 
            }
            $data['status']=1;
            $data['created']=date('Y-m-d H:i:s');
            $data['modified']=date('Y-m-d H:i:s');
            $Video->attributes = $data;      
            if($Video->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        } 
        $Video_category = VideoCategory::model()->findAll('parent_id is null');
        $Video_category = CHtml::listData($Video_category, 'id', 'name'); 
        $singer_category = VideoCategory::model()->findAll('parent_id is null');
        $singer_category = CHtml::listData($singer_category, 'id', 'name');
        $albums = Album::model()->findAll();
        $albums=  CHtml::listData($albums, 'id', 'name');
        $events = Event::model()->findAll();
        $events=  CHtml::listData($events, 'id', 'name');
        $subjects = Subject::model()->findAll();
        $subjects=  CHtml::listData($subjects, 'id', 'name');
        $this->render("add",array('Video'=>$Video,'Video_category'=>$Video_category,'singer_category'=>$singer_category,'albums'=>$albums,'subjects'=>$subjects,'events'=>$events));
    }
    public function actionEdit($id = null){ 
        checkLogin($this);
        $Video = Video::model()->findByPk($id);
        $session = getSession();        
        $this->performAjaxValidation($Video);
        if(isset($_POST['Video'])){ 
            $data = $_POST['Video'];
            $data['file']=  getImageURL($data['file']);
            if(!empty($data['videocategorylist'])){
                $data['videocategorylist'] = implode(',', $data['videocategorylist']);            
                $data['video_category_id']=','.$data['video_category_id'].','.$data['videocategorylist'].',';
            }
            if(!empty($data['singercategorylist'])){
                $data['singercategorylist'] = implode(',', $data['singercategorylist']);            
                $data['singer_category_id']=','.$data['singer_category_id'].','.$data['singercategorylist'].',';
            }
            if(!empty($data['singerlist'])){
                $data['singerlist'] = implode(',', $data['singerlist']);            
                $data['singer_id']=','.$data['singer_id'].','.$data['singerlist'].',';
            }
            if(!empty($data['subject_id'])){
                $data['subject_id'] = ','.implode(',', $data['subject_id']).','; 
            }
            $data['modified']=date('Y-m-d H:i:s'); //pr($data); die;            
            $Video->attributes = $data;
            if($Video->save())// chi luu khi cac truong du lieu khong null deu co gia trị
            $this->redirect(array('index'));
        } 
        $Video_category = VideoCategory::model()->findAll('parent_id is null');
        $Video_category = CHtml::listData($Video_category, 'id', 'name');
        $singer_category = VideoCategory::model()->findAll('parent_id is null');
        $singer_category = CHtml::listData($singer_category, 'id', 'name');
        $albums = Album::model()->findAll();
        $albums=  CHtml::listData($albums, 'id', 'name');
        $events = Event::model()->findAll();
        $events=  CHtml::listData($events, 'id', 'name');
        $subjects = Subject::model()->findAll();
        $subjects=  CHtml::listData($subjects, 'id', 'name');
        // xu ly danh sach the loai Video
        $Video_category_list= getArray($Video->video_category_id);
        $Video->video_category_id = isset($Video_category_list[0])?$Video_category_list[0]:'';
        if(isset($Video_category_list[0]))
            unset ($Video_category_list[0]);
        $Video->videocategorylist=$Video_category_list;
        // xu ly danh sach the loai nghe si
        $singer_category_list= getArray($Video->singer_category_id);
        $Video->singer_category_id = isset($singer_category_list[0])?$singer_category_list[0]:'';
        if(isset($singer_category_list[0]))
            unset ($singer_category_list[0]);
        $Video->singercategorylist=$singer_category_list;
        //xy ly danh sach nghe si
        $singer_list= getArray($Video->singer_id);
        // xu ly chu de
        $Video->subject_id= getArray($Video->subject_id);
        $Video->singer_id = isset($singer_list[0])?$singer_list[0]:'';
        if(isset($singer_list[0]))
            unset ($singer_list[0]);
        $Video->singerlist=$singer_list;
        
        $session['model']=$Video;
       // pr($Video_category_list); die;
        $this->render("edit", array('Video'=>$Video,'Video_category'=>$Video_category,'singer_category'=>$singer_category,'albums'=>$albums,'subjects'=>$subjects,'events'=>$events));
    }
    public function actionDelete($id=null){
        checkLogin($this);
         Video::model()->findByPk($id)->delete();
         $this->redirect(array('index'));
    }
    public function actionUpdateStatus($id){
        checkLogin($this);
        $Video = Video::model()->findByPk($id);
        $Video->status = ($Video->status==0)?1:0;
        $Video->save();
        $this->redirect(array('index'));
    }
     public function actionView($id=null) {
        checkLogin($this);
        $Video = Video::model()->findByPk($id); 
        $this->render("view", array ('Video'=>$Video));
    }

    
    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='frm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    public function actionGetVideoList(){
        checkLogin($this);
        $criteria = new CDbCriteria(); // tao dieu kien 
        $criteria->order="id desc";
        $condition='';
        $event_id = isset($_GET['event_id'])?$_GET['event_id']:'';
        if(!empty($event_id)){ 
            $condition='event_id="'.$event_id.'"'; 
            $criteria->condition = $condition;
        } 
        $event= Event::model()->findByPk($event_id);
        $album_id = isset($_GET['album_id'])?$_GET['album_id']:'';
        if(!empty($album_id)){ 
            $condition='album_id="'.$album_id.'"'; 
            $criteria->condition = $condition;
        }        
        $album=  Album::model()->findByPk($album_id);
        $count = Video::model()->count($criteria); // dem so ban ghi theo dieu kien
        $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
        $pages->pageSize=12; // so ban ghi tren 1 trang
        $pages->applyLimit($criteria); //dieu kien phan trang
        $data = Video::model()->findAll($criteria); 
        $this->render("list",array('data'=>$data,'pages'=>$pages,'event'=>$event,'album'=>$album)); // gui du lieu ra view
    }
    
    public function actionSearch(){
        checkLogin($this);        
        if(isset($_POST['Video'])){
            $data= $_POST['Video']; 
            $condition='';
            $condition1='';
            if(!empty($data['videocategorylist']))
                foreach ($data['videocategorylist'] as $k=>$v){
                    $condition1 .=!empty($condition1)?' or ':'';
                    $condition1 .=' video_category_id like "%,'.$v.',%" ';
                }
            $condition1 =!empty($condition1)?'('.$condition1.')':''; 
            
            $condition2='';
            if(!empty($data['singercategorylist']))
                foreach ($data['singercategorylist'] as $k=>$v){
                    $condition2 .=!empty($condition2)?' or ':'';
                    $condition2 .=' singer_category_id like "%,'.$v.',%" ';
                }
            $condition2 =!empty($condition2)?'('.$condition2.')':'';
           
            $condition3='';
            if(!empty($data['singerlist']))
                foreach ($data['singerlist'] as $k=>$v){
                    $condition3 .=!empty($condition3)?' or ':'';
                    $condition3 .=' singer_id like "%,'.$v.',%" ';
                }
             $condition3 =!empty($condition3)?'('.$condition3.')':'';
             
            $condition4=''; 
            if(!empty($data['subject_id']))
                foreach ($data['subject_id'] as $k=>$v){
                    $condition4 .=!empty($condition4)?' or ':'';
                    $condition4 .=' subject_id like "%,'.$v.',%" ';
                } 
             $condition4 =!empty($condition4)?'('.$condition4.')':'';
             $condition =$condition1;
             if(!empty($condition)&&!empty($condition2))
                 $condition .=' and '.$condition2;
             else
                 $condition .=$condition2;
             
             if(!empty($condition)&&!empty($condition3))
                 $condition .=' and '.$condition3;
             else
                 $condition .=$condition3;
             
             if(!empty($condition)&&!empty($condition4))
                 $condition .=' and '.$condition4;
             else
                 $condition .=$condition4;
             if(!empty($data['name'])){
                 $condition = !empty($condition)?'name like "%'.$data['name'].'%" and '.$condition:'name like "%'.$data['name'].'%"';
             }
             if(!empty($data['album_id'])){
                 $condition = !empty($condition)?'album_id = "'.$data['album_id'].'" and '.$condition:'album_id = "'.$data['album_id'].'"';
             }
             if(!empty($data['event_id'])){
                 $condition = !empty($condition)?'event_id = "'.$data['event_id'].'" and '.$condition:'event_id = "'.$data['event_id'].'"';
             }
             if(!empty($data['famous'])){
                 $condition = !empty($condition)?'famous = "'.$data['famous'].'" and '.$condition:'famous = "'.$data['famous'].'"';
             }
             if(!empty($data['new'])){
                 $condition = !empty($condition)?'new = "'.$data['new'].'" and '.$condition:'new = "'.$data['new'].'"';
             }
                
            $criteria = new CDbCriteria(); // tao dieu kien 
            $criteria->order="id desc";     
            if(!empty($condition))
                $criteria->condition=$condition;
            $count = Video::model()->count($criteria); // dem so ban ghi theo dieu kien
            $pages=new CPagination($count); // tao phan trang chua tong so ban ghi
            $pages->pageSize=12; // so ban ghi tren 1 trang
            $pages->applyLimit($criteria); //dieu kien phan trang
            $data = Video::model()->findAll($criteria); 
            $this->render("kq_search",array('data'=>$data,'pages'=>$pages)); // gui du lieu ra view
        }
        else{
            $Video = new Video;
            $session = getSession();
            $session['model']=$Video;
            $Video_category = VideoCategory::model()->findAll('parent_id is null');
            $Video_category = CHtml::listData($Video_category, 'id', 'name'); 
            $singer_category = VideoCategory::model()->findAll('parent_id is null');
            $singer_category = CHtml::listData($singer_category, 'id', 'name');
            $albums = Album::model()->findAll();
            $albums=  CHtml::listData($albums, 'id', 'name');
            $events = Event::model()->findAll();
            $events=  CHtml::listData($events, 'id', 'name');
            $subjects = Subject::model()->findAll();
            $subjects=  CHtml::listData($subjects, 'id', 'name');
            $this->render("search",array('Video'=>$Video,'Video_category'=>$Video_category,'singer_category'=>$singer_category,'albums'=>$albums,'subjects'=>$subjects,'events'=>$events));
        }
    }
   
}
?>
