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
 * @property integer $phone
 * @property string $birth_date
 * @property string $sex
 * @property string $images
 * @property string $created
 * @property string $modified
 * @property string $active_key
 * @property integer $status
 */
class Comment extends CActiveRecord
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
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content,created, status', 'required'),
			array('product_id,news_id,status', 'numerical', 'integerOnly'=>true),
			array(' email','length','max'=>50),
                        array(' name','length','max'=>100),
                        array('product_id,news_id','numerical','allowEmpty'=>true),
                        array('email,name','length','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, content, product_id, news_id,email,,created, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('Product'=>array(self::BELONGS_TO,'Product','product_id'),
                        'News'=>array(self::BELONGS_TO,'News','news_id')
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                            'id' => 'ID',
                            'name'=>'Tên',
                            'content'=>'Nội dung',
                            'product_id'=>'Mã thư mục sp',
                            'news_id'=>'Mã thư mục tin tức',
                            'email'=>'email',
                            'created' => 'Created',
                          
                            'status' => 'Trạng thái',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('news_id',$this->news_id,true);
		
		$criteria->compare('created',$this->created,true);
		
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
