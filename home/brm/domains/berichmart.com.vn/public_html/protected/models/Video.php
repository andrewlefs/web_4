<?php
class Video extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
        public $videocategorylist,$singercategorylist,$singerlist;
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'videos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,video_category_id,singer_category_id,singer_id,subject_id,created, modified, status', 'required'),
                        array('status','numerical','integerOnly'=>true),
                        array('album_id,famous,new,event_id','numerical','allowEmpty'=>true),
			array('name','length','max'=>256),
                        array('content,file','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,name,video_category_id,singer_category_id,album_id,singer_id,content,created, modified, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('Album'=>array(self::BELONGS_TO,'Album','album_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                            'id' => 'ID',
                            'name'=>'Tên video',
                            'file'=>'File',
                            'video_category_id'=>'Thể loại video',
                            'singer_category_id'=>'Thể loại nghệ sĩ',
                            'singer_id'=>'Nghễ sĩ biểu diễn',
                            'album_id'=>'Album',
                            'event_id'=>'Sự kiện',
                            'subject_id'=>'Chủ đề',
                            'content'=>'Thông tin video',
                            'status'=>'Trạng thái',
                            'created' => 'Created',
                            'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('video_category_id',$this->video_category_id,true);
                $criteria->compare('singer_id',$this->singer_id,true);
                $criteria->compare('singer_category_id',$this->singer_category_id,true);
                $criteria->compare('album_id',$this->album_id,true);
                $criteria->compare('subject_id',$this->subject_id,true);
                $criteria->compare('content',$this->content,true);
                $criteria->compare('status',$this->status,true);                
                $criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}      
        
        public function getVideoCat($cat_id){
            return VideoCategory::model()->findByPk($cat_id);
        }
        
        public function getVideoCatsLabel(){
            $list= getArray($this->video_category_id);
            $i=0;
            $result='';
            foreach($list as $k=>$v){
                $cat = $this->getVideoCat($v);
                $result .= $cat->name; $i++;
                if($i<count($list))
                    $result .=', ';
            }  
            return $result;
        }
        
        public function getSingerCat($cat_id){
            return SingerCategory::model()->findByPk($cat_id);
        }
        
        public function getSingerCatsLabel(){
            $list=  getArray($this->singer_category_id);
            $i=0;
            $result='';
            foreach($list as $k=>$v){
                $cat = $this->getSingerCat($v);
                $result .= $cat->name; $i++;
                if($i<count($list))
                    $result .=', ';
            }  
            return $result;
        }
        
        public function getSinger($id){ 
            if(intval($id))
               return Singer::model()->findByPk($id);
        }
        
        public function getSingersLabel(){ 
            $list=  getArray($this->singer_id);
            $i=0;
            $result='';
            foreach($list as $k=>$v){
                $cat = $this->getSinger($v);
                if($cat){
                    $result .= $cat->name; $i++;
                    if($i<count($list))
                        $result .=', ';
                }
            }  
            return $result;
        }
        
        public function getSubject($subject_id){
            return Subject::model()->findByPk($subject_id);
        }
        
        public function getSubjectsLabel(){
            $list=  getArray($this->subject_id);
            $i=0;
            $result='';
            foreach($list as $k=>$v){
                $cat = $this->getSubject($v);
                $result .= $cat->name; $i++;
                if($i<count($list))
                    $result .=', ';
            }  
            return $result;
        }
}