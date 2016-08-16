<?php
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
        public $albumcategorylist,$singerlist;
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,image,created, modified, status', 'required'),
                        array('status','numerical','integerOnly'=>true),
			array('name,image','length','max'=>256),
                        array('content,image','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,name,content,created, modified, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                            'id' => 'ID',
                            'name'=>'Tên sự kiện',
                            'image'=>'Ảnh đại diện',
                            'content'=>'Nội dung',
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
                $criteria->compare('content',$this->content,true);
                $criteria->compare('status',$this->status,true);                
                $criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}      
        
        public function getALbumCat($cat_id){
            return AlbumCategory::model()->findByPk($cat_id);
        }
        
        public function getALbumCatsLabel(){            
            $list=getArray($this->album_category_id);      
            $i=0;
            $result='';
            foreach($list as $k=>$v){
                $cat = $this->getALbumCat($v);
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
        
        // return sl video bai hat
        public function getCountVideo(){
            $count = Yii::app()->db->createCommand('select count(*) from videos where album_id="'.$this->id.'"')->queryScalar();
            return $count;
        }
}