<?php
class Singer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'singers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,birthday,place,created, modified, status', 'required'),
			array('name','length','max'=>256),
                        array('information,image','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,name,place,information,created, modified, status', 'safe', 'on'=>'search'),
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
                            'name'=>'Tên nghệ sĩ',
                            'image'=>'Ảnh đại diện',
                            'birthday'=>'Ngày sinh',
                            'place'=>'Nơi sống',
                            'information'=>'Thông tin',
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
		$criteria->compare('place',$this->place,true);
                $criteria->compare('information',$this->information,true);
                $criteria->compare('status',$this->status,true);                
                $criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getCountVideo(){
            $count = Yii::app()->db->createCommand('select count(*) from videos where singer_id like "%,'.$this->id.',%"')->queryScalar();
            return $count;
        }
        
        public function getCountAlbum(){
            $count = Yii::app()->db->createCommand('select count(*) from albums where singer_id like "%,'.$this->id.',%"')->queryScalar();
            return $count;
        }
}