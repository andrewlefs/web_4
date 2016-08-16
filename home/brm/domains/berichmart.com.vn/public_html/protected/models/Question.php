<?php
class Question extends CActiveRecord
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
		return 'question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id,member_id,title, content,status,view', 'required'),
			array('title', 'length', 'max'=>256),
                    array('created, modified,answer','length','allowEmpty'=>true),
				// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,category_id,member_id,title, content,answer', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()//câu lệnh liên kết của news vs category thông qua category_id
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('Category'=>array(self::BELONGS_TO,'Category','category_id'),
                    'Member'=>array(self::BELONGS_TO,'Member','member_id')
                    );
	}                     //bí danh                          tên mode

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array( //id,category_id,member_id,title, content
                        
                            'id' => 'ID',
                            'title' => 'Tiêu đề tin',
                            'content'=>'Nội dung câu hỏi',
                            'category_id' => 'Loại hình sản phẩm',
                            'created' => 'Created',
                            'modified' => 'Modified',
                            'status' => 'Trạng thái',
                            'answer' => 'Nội dung trả lời',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('dipslay',$this->dipslay);
		$criteria->compare('introduction',$this->introduction,true);
                $criteria->compare('content',$this->content,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('category_id ',$this->category_id ,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('view',$this->view,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('status',$this->status);
		
                $criteria->compare(' alias',$this-> alias,true);
		$criteria->compare('meta_key',$this->meta_key,true);
		$criteria->compare('meta_des',$this->meta_des,true);
		
		$criteria->compare('display',$this->display,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                  
		));
	}
}