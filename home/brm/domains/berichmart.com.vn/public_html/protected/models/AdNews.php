<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $password
 * @property string $name
 * @property integer $power
 * @property string $email
 * @property integer $display
 * @property string $birth_date
 * @property string $sex
 * @property string $images
 * @property string $created
 * @property string $modified
 * @property string $active_key
 * @property integer $status
 */
class AdNews extends CActiveRecord
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
		return 'ad_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id,price,type,title,introduction,image ,category_id, created, modified,expire, alias, status2', 'required'),
			array('member_id, category_id, view, status,city_id', 'numerical', 'integerOnly'=>true),
			array('title,status2, image, alias', 'length', 'max'=>256),
                        array('content','length','allowEmpty'=>true),
                        array('expire','date','format'=>'yyyy-M-d'),
                        array('status,view','numerical','allowEmpty'=>true),
				// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,member_id,title,introduction, content, image ,category_id ,view, created, modified, status, alias', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()//câu lệnh liên kết của news vs category thông qua category_id
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'Category'=>array(self::BELONGS_TO,'Category','category_id'),
                    'Member'=>array(self::BELONGS_TO,'Member','member_id'), 
                    'City'=>array(self::BELONGS_TO,'City','city_id'),
                    );
	}                     //bí danh                          tên mode

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                        
                            'id' => 'ID',
                            'Member_id' => 'Người đăng',
                            'title' => 'Tiêu đề tin',
                            'introduction'=>'Tóm tắt',
                            'content'=>'Nội dung',
                            'image' => 'Ảnh đại diện',
                            'category_id' => 'Danh mục',
                            'view' => 'Lượt xem',
                            'created' => 'Created',
                            'modified' => 'Modified',
                            'status' => 'Trạng thái',
                            'status2' => 'Trạng thái',
                            'alias' => 'Bí danh',
                            'price'=>'Giá',
                            'expire'=>'Ngày hết hạn',
                            'type'=>'Loại tin',
                            'city_id'=>'Nơi đăng',
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
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('introduction',$this->introduction,true);
                $criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('category_id ',$this->category_id ,true);
		$criteria->compare('view',$this->view,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('status',$this->status);
                $criteria->compare(' alias',$this-> alias,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                  
		));
	}
}