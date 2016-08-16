<?php
class Content extends CActiveRecord{
		
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function tableName(){
		return 'news';
	}
	public function getContent($id){
		$connection=Yii::app()->db;
		$sql="SELECT * FROM news WHERE status=1 AND id=$id  ORDER BY id DESC";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$list=array();
			while(($row=$dataReader->read())!==false) {
				$list[]=array('id'=>$row['id'],'user_id'=>$row['user_id'],'title'=>$row['title'],'dipslay'=>$row['dipslay'],'introduction'=>$row['introduction'],'content'=>$row['content'],'image'=>$row['image'],'category_id'=>$row['category_id'],'source'=>$row['source'],'view'=>$row['view'],'created'=>$row['created'],'modified'=>$row['modified'],'status'=>$row['status'],'image_thumb'=>$row['image_thumb'],'alias'=>$row['alias'],'meta_key'=>$row['meta_key'],'meta_des'=>$row['meta_des']);
			}	
		return $list;
	}
	public function getContentCatergory($catid,$id=null){
		if($id!=null){
			$other="AND id != $id";
		}
		$connection=Yii::app()->db;
		$sql="SELECT * FROM news WHERE status=1 AND category_id=$catid ".$other." ORDER BY id DESC";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$list=array();
			while(($row=$dataReader->read())!==false) {
				$list[]=array('id'=>$row['id'],'user_id'=>$row['user_id'],'title'=>$row['title'],'dipslay'=>$row['dipslay'],'introduction'=>$row['introduction'],'content'=>$row['content'],'image'=>$row['image'],'category_id'=>$row['category_id'],'source'=>$row['source'],'view'=>$row['view'],'created'=>$row['created'],'modified'=>$row['modified'],'status'=>$row['status'],'image_thumb'=>$row['image_thumb'],'alias'=>$row['alias'],'meta_key'=>$row['meta_key'],'meta_des'=>$row['meta_des']);
			}	
		return $list;
	}
	public function getContentNew(){
		$connection=Yii::app()->db;
		$sql="SELECT * FROM news WHERE status=1 ORDER BY id DESC";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$list=array();
			while(($row=$dataReader->read())!==false) {
				$list[]=array('id'=>$row['id'],'user_id'=>$row['user_id'],'title'=>$row['title'],'dipslay'=>$row['dipslay'],'introduction'=>$row['introduction'],'content'=>$row['content'],'image'=>$row['image'],'category_id'=>$row['category_id'],'source'=>$row['source'],'view'=>$row['view'],'created'=>$row['created'],'modified'=>$row['modified'],'status'=>$row['status'],'image_thumb'=>$row['image_thumb'],'alias'=>$row['alias'],'meta_key'=>$row['meta_key'],'meta_des'=>$row['meta_des']);
			}	
		return $list;
	}
	public function getSearch($where=null){
		$where= (array) $where;
		$where=implode(' AND ',$where);
		$connection=Yii::app()->db;
		$sql="SELECT * FROM news WHERE $where ORDER BY id DESC";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$list=array();
			while(($row=$dataReader->read())!==false) {
				$list[]=array('id'=>$row['id'],'user_id'=>$row['user_id'],'title'=>$row['title'],'dipslay'=>$row['dipslay'],'introduction'=>$row['introduction'],'content'=>$row['content'],'image'=>$row['image'],'category_id'=>$row['category_id'],'source'=>$row['source'],'view'=>$row['view'],'created'=>$row['created'],'modified'=>$row['modified'],'status'=>$row['status'],'image_thumb'=>$row['image_thumb'],'alias'=>$row['alias'],'meta_key'=>$row['meta_key'],'meta_des'=>$row['meta_des']);
			}	
		return $list;
	}
	public function getContentHit($id=array()){
		$id=implode(',',$id);
		$connection=Yii::app()->db;
		$sql="SELECT * FROM news WHERE status=1 AND id IN (".$id.")ORDER BY id DESC";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$list=array();
			while(($row=$dataReader->read())!==false) {
				$list[]=array('id'=>$row['id'],'user_id'=>$row['user_id'],'title'=>$row['title'],'display'=>$row['display'],'introduction'=>$row['introduction'],'content'=>$row['content'],'image'=>$row['image'],'category_id'=>$row['category_id'],'source'=>$row['source'],'view'=>$row['view'],'created'=>$row['created'],'modified'=>$row['modified'],'status'=>$row['status'],'image_thumb'=>$row['image_thumb'],'alias'=>$row['alias'],'meta_key'=>$row['meta_key'],'meta_des'=>$row['meta_des']);
			}	
		return $list;
	}
	public function getNameCategory($id){
		$connection=Yii::app()->db;
		$sql="SELECT * FROM categories WHERE status=1 AND id=$id  ORDER BY id DESC";
		$command=$connection->createCommand($sql);
		$dataReader=$command->query();
		$list=array();
			while(($row=$dataReader->read())!==false) {
				$list[]=array('id'=>$row['id'],'name'=>$row['name']);
			}	
		return $list;
		
	}
	public function loadContentCategory($catid){
		$data=Content::model()->getContentCatergory($catid);
		$name=Content::model()->getNameCategory($catid);
			$html="";
			$html.="<div class='cot'>";
			$html.='<div class="tieude"><div class="ten">'.$name[0]['name'].'</div><div class="them"><a href="index?catid='.$catid.'">Xem Th&#234;m</a></div></div>';
			$html.='<div class="noidung">';
			$html.='<div class="leftnoidung">
                        	<div class="imgnoidung"><img src="'.Yii::app()->request->baseUrl.'/'.$data[0]['image'].'" /></div>
                            <div class="chitiet">
                            	<div><a href=""><b>'.$data[0]['title'].'</b></a></div>
                                <span>'.$data[0]['introduction'].'</span>
                            </div>
                        </div>';
			$html.='<div class="rightnoidung"><ul>';			
		for($i=1;$i<5;$i++){
			
				$html.="<li><a href='view?id=".$data[$i]['id']."'>".$data[$i]['title']."</a></li>";	
		}
			$html.="</ul></div>";
			$html.="</div>";
			$html.="</div>";
			return $html;
	}
	public function loadContentNew(){
		$data=Content::model()->getContentNew();
		$html='<div id="rtopleft"><div id="tin">';
        $html.='<div><a href="view?id='.$data[0]['id'].'">'.$data[0]['title'].'</a></div>';
        $html.='<span>'.$data[0]['introduction'].'</span>';
        $html.='<img  src="'.Yii::app()->request->baseUrl.'/'.$data[0]['image'].'"/></div><div class="cleaner"></div>';     
        $html.='<div id="linklk"><ul>';
		for($i=1;$i<9;$i++){
			if($data[$i]['title']!=null){	
            $html.='<li><a href="view?id='.$data[0]['id'].'"><img src="'.Yii::app()->request->baseUrl.'/uploadfile/avatar/iconlink.png" />'.$data[$i]['title'].'</a></li>'; 
			}		
        }
		$html.='</ul></div></div>';
			return $html;
	}
	public function slideContent($id=array()){
		$data=Content::model()->getContentHit($id);
		$html ='<div id="slide">';
        $html.='<div id="slide_top">';
		for($i=0;$i<count($data);$i++){
		$id=$i+1;
        $html.='<div id="'.$id.'" class="img"><img src="'.Yii::app()->request->baseUrl.'/'.$data[$i]['image'].'" /> <br /><div class="summary-hotnews"><a href="view?id='.$data[$i]['id'].'">'.$data[$i]['title'].'</a><div>'.$data[$i]['introduction'].'</div></div></div>';
         }                   
        $html.='</div>';
        $html.='<div id="slide_bottom"><ul>';
		$html.='<li><a title="#1" class="active"><img src="'.Yii::app()->request->baseUrl.'/'.$data[0]['image'].'" /></a></li>';
		for($j=1;$j<count($data);$j++){
		if($j==0){$class="active";}
		$id=$j+1;
        $html.='<li><a title="#'.$id.'"><img src="'.Yii::app()->request->baseUrl.'/'.$data[$j]['image'].'" /></a></li>';
		 }					
        $html.='</ul></div></div>'; 
		return	$html;	
	}
	}
	?>