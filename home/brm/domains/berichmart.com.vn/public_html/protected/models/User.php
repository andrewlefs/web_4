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
class User extends CActiveRecord
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, name, power,fullname, email, phone, birth_date, sex, created, modified, status', 'required'),
			array('power, phone, status', 'numerical', 'integerOnly'=>true),
			array('password, name, birth_date', 'length', 'max'=>200),
			array('email, active_key', 'length', 'max'=>50),
			array('sex', 'length', 'max'=>20),
			array('images', 'length', 'max'=>256),
                    array('content,active_key,images','length','allowEmpty'=>true),
                  /*  array    ('code','captcha',
                                    'allowEmpty'=>!CCaptcha::checkRequirements(),
                                    'message'    =>    'Mã Xác Nhận Nhập Không Đúng'
                                    ),*/
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, password, name, power, email, phone, birth_date, sex, images, created, modified, active_key, status', 'safe', 'on'=>'search'),
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
			'password' => 'Mật khẩu',
			'name' => 'Tên đăng nhập',
                        'fullname'=>'Họ và tên',
			'power' => 'Power',
			'email' => 'Email',
			'phone' => 'Số điện thoại',
			'birth_date' => 'Ngày sinh',
			'sex' => 'Giới tính',
			'images' => 'Hình ảnh',
			'created' => 'Created',
			'modified' => 'Modified',
			'active_key' => 'Active Key',
			'status' => 'Trạng thái',
                        'power'=>'Cấp độ',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('power',$this->power);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('active_key',$this->active_key,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}